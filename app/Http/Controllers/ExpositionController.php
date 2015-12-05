<?php
/**
 * Created by PhpStorm.
 * User: xcibul10
 * Date: 12/1/15
 * Time: 2:58 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Validator;

class ExpositionController extends Controller {

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
            ->with("target", "/man_exposition/create");
    }

    function getShow()
    {
        $expositions = DB::select("SELECT IDexpozicie 'id', nazov 'name'
                                  FROM Expozicia
                                  WHERE IDusera = '". \Auth::user()->id ."'");
        $table = DB::select("SELECT nazov, odCas, doCas
                                  FROM Expozicia
                                  WHERE IDusera = '". \Auth::user()->id ."'");
        return view("user.selectexp")
            ->with("expositions", $expositions)
            ->with("table", $table)
            ->with("header", ["exposition", "from", "until"])
            ->with("target", "/man_exposition/show");;
    }


    function getUpdate($id)
    {
        $exposition = DB::select("SELECT IDexpozicie id, odCas, doCas, nazov
                                  FROM Expozicia
                                  WHERE IDexpozicie = '". $id ."'
                                        AND IDusera = '". \Auth::user()->id ."'");
        if($exposition == null) {
            return redirect("/man_exposition/show");
        }


        $spots = DB::select("SELECT M.IDmiesta 'id', M.typ 'type', M.velkost 'size', M.cena 'cost'
                             FROM ExpozicneMiesto M
                             WHERE NOT EXISTS (
                                SELECT Z.expozicneMiesto
                                FROM Zahrnuje Z
                                INNER JOIN Expozicia E
                                WHERE M.IDmiesta = Z.expozicneMiesto AND
                                      Z.expozicia = E.IDexpozicie AND
                                      (
                                            (E.odCas <= '" . $exposition[0]->odCas . "' AND
                                            E.doCas >= '" . $exposition[0]->odCas . "')
                                          OR
                                            (E.odCas <= '" . $exposition[0]->doCas . "' AND
                                            E.doCas >= '" . $exposition[0]->doCas . "')
                                      ))");

        $artworks = DB::select("SELECT D.IDdiela 'id', D.nazov 'name', D.autor 'author', D.typ 'type'
                                FROM Dielo D
                                WHERE D.IDusera = '". \Auth::user()->id ."' AND
                                  NOT EXISTS (
                                    SELECT Z.dielo
                                    FROM Zahrnuje Z
                                    INNER JOIN Expozicia E
                                        WHERE Z.expozicia = E.IDexpozicie AND Z.dielo = D.IDdiela
                                          AND
                                            ((E.odCas <= '" . $exposition[0]->odCas . "'
                                                AND E.doCas >= '" . $exposition[0]->odCas . "')
                                              OR
                                            (E.odCas <= '" . $exposition[0]->doCas . "'
                                                AND E.doCas >= '" . $exposition[0]->doCas . "')))");

        $table = DB::select("SELECT D.nazov, D.autor, EM.cena
                             FROM Dielo D
                             INNER JOIN Zahrnuje Za ON Za.dielo = D.IDdiela AND Za.expozicia = '". $id ."'
                             INNER JOIN ExpozicneMiesto EM ON EM.IDmiesta = Za.expozicneMiesto");

        return view("user.updateexp")
            ->with("exposition", $exposition)
            ->with("artworks", $artworks)
            ->with("spots", $spots)
            ->with("table", $table)
            ->with("header", ["name", "author", "cost"])
            ->with("target", "/man_exposition/update/".$id);
    }

    function getDelete()
    {
        return view("actions.delete")
            ->with("table", DB::select(
                "SELECT IDexpozicie id, nazov, odCas, doCas
                    FROM Expozicia WHERE IDusera = " . \Auth::user()->id
            ))->with(
                "header", ["exposition", "from", "until"]
            )->with("target", "/man_exposition/delete");
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

        DB::table("Zahrnuje")->insert([
            "expozicia" => $request->request->get("id"),
            "expozicneMiesto" => $request->request->get("spot"),
            "dielo" => $request->request->get("artwork"),
        ]);

        return redirect("/man_exposition/update/".$request->request->get("id"));
    }

    function postCreate(Request $request)
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

    function postShow(Request $request)
    {
        return redirect("/man_exposition/update/".$request->request->get("id"));
    }
};

