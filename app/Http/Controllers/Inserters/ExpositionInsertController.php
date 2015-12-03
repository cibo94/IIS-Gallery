<?php
/**
 * Created by PhpStorm.
 * User: xcibul10
 * Date: 12/1/15
 * Time: 2:58 PM
 */

namespace App\Http\Controllers\Inserters;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Validator;

class ExpositionInsertController extends Controller {

    function __construct()
    {
        $this->middleware("user");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:40',
            'from' => 'required|date|date_format:d-m-Y',
            'to' => 'required|date|date_format:d-m-Y|after:from',
        ]);
    }

    function getCreate()
    {
        $sql= "SELECT odCas, doCas do, nazov
                    FROM Expozicia
                    WHERE IDusera = '". \Auth::user()->id ."'
                ORDER BY do";
        return view("user.exposition")
            ->with("table", DB::select($sql))
            ->with("header", ["from", "to", "name"])
            ->with("target", "/man_exposition/insert");
    }

    function getShow()
    {
        return view("user.selectexp");
    }

    function getUpdate($id)
    {
        $exposition = DB::select("SELECT odCas, doCas, nazov
                                  FROM Expozicia
                                  WHERE IDexpozicie = '". $id ."'
                                        AND IDusera = '". \Auth::user()->id ."'");
        if($exposition == null)
            return view("user.selectexp");

        $spots = DB::select("SELECT M1.IDmiesta, M1.typ, M1.velkost, M1.cena
                             FROM ExpozicneMiesto M1
                             WHERE NOT EXISTS (
                                SELECT M2.IDmiesta
                                FROM ExpozicneMiesto M2
                                INNER JOIN Zahrnuje Za ON Za.expozicneMiesto = M2.IDmiesta
                                INNER JOIN Expozicia Ex WHERE M2.IDmiesta = M1.IDmiesta AND
                                                              (Ex.odCas < '" . $exposition[0]->odCas . "'
                                                              AND Ex.doCas >= '" . $exposition[0]->odCas . "')
                                                              OR
                                                              (Ex.odCas <= '" . $exposition[0]->doCas . "'
                                                              AND Ex.doCas > '" . $exposition[0]->doCas . "')
                  )");

        $artworks = DB::select("SELECT D1.IDdiela, D1.nazov, D1.autor, D1.typ
                                FROM Dielo D1
                                WHERE NOT EXISTS (
                                    SELECT D2.IDdiela
                                    FROM Dielo D2
                                    INNER JOIN Zahrnuje Za ON Za.dielo = D2.IDdiela
                                    INNER JOIN Expozicia Ex WHERE D2.IDdiela = D1.IDdiela AND
                                                                  (Ex.odCas < '" . $exposition[0]->odCas . "'
                                                                  AND Ex.doCas >= '" . $exposition[0]->odCas . "')
                                                                  OR
                                                                  (Ex.odCas <= '" . $exposition[0]->doCas . "'
                                                                  AND Ex.doCas > '" . $exposition[0]->doCas . "')
                  )");

        return view("user.updateexp")
            ->with("exposition", $exposition)
            ->with("artworks", $artworks)
            ->with("spots", $spots);
    }

    function getDelete()
    {
        return view("admin.delete")
            ->with("table", DB::select(
                "SELECT id, name, email, password, rc, meno, priezvisko, telefon, role
                    FROM users INNER JOIN Zamestnanec
                        WHERE users.id = Zamestnanec.IDzamestnanca"
            ))->with(
                "header", ["name", "email", "password", "birthno", "firstname", "lastname", "phone", "role"]
            )->with("target", "/man_employee/delete");
    }

    function postDelete(Request $request)
    {
        foreach ($request->request->keys() as $key)
            if ($request->request->get($key) == "delete")
            {
                DB::table("Expozicia")->where(["IDexpozicie" => $key])->delete();
            }
        return redirect("/man_exposition/delete");
    }

    function postUpdate(Request $request)
    {
        // TODO: implement
        return redirect("/man_exposition/update/".$request->request->get("id"));
    }

    function postInsert(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $fromTime = \DateTime::createFromFormat('d-m-Y',$request->request->get("from"));
        $toTime = \DateTime::createFromFormat('d-m-Y', $request->request->get("to"));

        $id = DB::table("Expozicia")->insertGetId([
            "nazov" => $request->request->get("name"),
            "odCas" => $fromTime,
            "doCas" => $toTime,
            "IDusera" => \Auth::user()->id
        ]);

        return redirect("/man_exposition/update/".$id);
    }
};

