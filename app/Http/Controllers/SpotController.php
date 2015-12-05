<?php
/**
 * Created by PhpStorm.
 * User: onionka
 * Date: 12/1/15
 * Time: 2:58 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Validator;


class SpotController extends Controller {

    function __construct()
    {
        $this->middleware("employee");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'spottype' => 'required|max: 20',
            'area' => 'required|numeric',
            'cost' => 'required|numeric',
            'room' => 'required|exists:Miestnost,IDmiestnosti',
            'responsibility' => 'exists:Zamestnanec,IDzamestnanca',
        ]);
    }

    function getDelete()
    {
        return view("actions.delete")
            ->with("table", DB::select(
                "SELECT IDmiesta id, typ, velkost, cena, IDmiestnosti, IDzamestnanca
                   FROM ExpozicneMiesto")
            )->with(
                "header", ["type", "size", "price", "room id", "responsibility"]
            )->with("target", "/man_spot/delete");
    }

    function postDelete(Request $request)
    {
        foreach ($request->request->keys() as $key)
            if ($request->request->get($key) == "delete") {
                DB::table("ExpozicneMiesto")->where(["IDmiesta" => $key])->delete();
            }
        return redirect('/man_spot/delete');
    }

    function getCreate()
    {
        $sql = "SELECT typ, velkost, cena, IDmiestnosti, IDzamestnanca
                FROM ExpozicneMiesto";
        $rooms = "SELECT IDmiestnosti id FROM Miestnost";
        $employees = "SELECT IDzamestnanca id, meno name, priezvisko surname FROM Zamestnanec";
        return view("actions.insert")
            ->with("table", DB::select($sql))
            ->with("rooms", DB::select($rooms))
            ->with("employees", DB::select($employees))
            ->with("header", ["spot type", "area", "cost", "room", "responsibility"])
            ->with("target", "/man_spot/create");
    }

    function postCreate(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $responsible = $request->request->get("responsibility");
        if($responsible == "")
            $responsible = null;

        $id = DB::table("ExpozicneMiesto")->insertGetId([
            "typ" => $request->request->get("spottype"),
            "velkost" => $request->request->get("area"),
            "cena" => $request->request->get("cost"),
            "IDmiestnosti" => $request->request->get("room"),
            "IDzamestnanca" => $responsible,
        ]);

        return redirect("/man_spot/update/".$id);
    }

    function getShow()
    {
        if (\Auth::check() and \Auth::user()->role == "employee")
        {
            $spots = DB::select("SELECT IDmiesta 'id', typ 'type', velkost 'size',
                                        cena 'cost', IDmiestnosti 'room'
                                   FROM ExpozicneMiesto WHERE IDzamestnanca = ". \Auth::user()->id);
            $table = DB::select("SELECT typ 'type', velkost 'size',
                                        cena 'cost', IDmiestnosti 'room'
                                   FROM ExpozicneMiesto WHERE IDzamestnanca = ". \Auth::user()->id);
            return view("selectspot")
                ->with("spots", $spots)
                ->with("table", $table)
                ->with("header", ["spot type", "area", "cost", "room id",])
                ->with("target", "/man_spot/show");
        }
        elseif (\Auth::check() and \Auth::user()->role == "admin"){
            $spots = DB::select("SELECT IDmiesta 'id', typ 'type', velkost 'size',
                                        cena 'cost', IDmiestnosti 'room'
                                   FROM ExpozicneMiesto");
            $table = DB::select("SELECT E.typ 'type', E.velkost 'size',
                                        E.cena 'cost', E.IDmiestnosti 'room', Z.meno, Z.priezvisko
                                 FROM ExpozicneMiesto E
                                 INNER JOIN Zamestnanec Z ON Z.IDzamestnanca = E.IDzamestnanca");
            return view("selectspot")
                ->with("spots", $spots)
                ->with("table", $table)
                ->with("header", ["spot type", "area", "cost", "room id", "employee name", "employee surname"])
                ->with("target", "/man_spot/show");
        }
        else
            redirect("/about");
    }

    function postShow(Request $request)
    {
        return redirect("/man_spot/update/".$request->request->get("id"));
    }

    function getUpdate($id)
    {
        $selected = DB::select("SELECT IDmiesta 'id', typ 'type', velkost 'size',
                                        cena 'cost', IDmiestnosti 'roomid', IDzamestnanca 'responsibility'
                                   FROM ExpozicneMiesto WHERE IDmiesta = '" . $id . "'");

        if ($selected == null) {
            return redirect("/man_spot/show");
        }

        $rooms = DB::select("SELECT IDmiestnosti 'id' FROM Miestnost");

        $table = DB::select("SELECT V.IDvybavenia 'id', V.nazov 'name', V.popis 'description', A.pocet 'count'
                             FROM Vybavenie V INNER JOIN Vybavuje A
                             WHERE V.IDvybavenia = A.IDvybavenia AND A.IDmiesta = '" . $id . "'");

        $equipments = DB::select("SELECT V.IDvybavenia 'id', V.nazov 'name'
                                  FROM Vybavenie V
                                  WHERE NOT EXISTS (
                                      SELECT * FROM Vybavuje X
                                               WHERE V.IDvybavenia = X.IDvybavenia AND
                                                     X.IDmiesta = '" . $id . "'
                                  )");

        if (\Auth::check() and \Auth::user()->role == "employee") {
            return view("updatespot")
                ->with("selected", $selected)
                ->with("rooms", $rooms)
                ->with("equipments", $equipments)
                ->with("table", $table)
                ->with("header", ["equipment name", "equipment description", "count"])
                ->with("target", "/man_spot/update/".$id);
        } elseif (\Auth::check() and \Auth::user()->role == "admin") {
            $employees = DB::select("SELECT Z.IDzamestnanca 'id', Z.meno 'name', Z.priezvisko 'surname'
                                     FROM Zamestnanec Z");

            return view("updatespot")
                ->with("selected", $selected)
                ->with("rooms", $rooms)
                ->with("employees", $employees)
                ->with("equipments", $equipments)
                ->with("table", $table)
                ->with("header", ["equipment name", "equipment description", "count"])
                ->with("target", "/man_spot/update/".$id);
        }
        else
            redirect("/about");
    }

    function postUpdate(Request $request)
    {
        if($request->request->get("requesttype") == 1)
        {
            $id = $id = $request->request->get("id");
            $validator = Validator::make($request->all(), [
                'size' => 'numeric',
                'cost' => 'numeric',
            ]);

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            if (\Auth::check() and \Auth::user()->role == "admin")
            {
                $responsible = $request->request->get("employee");
                if ($responsible == "empty")
                    $responsible = null;

                DB::table("ExpozicneMiesto")
                    ->where("IDmiesta", $id)
                    ->update([
                        "typ" => $request->request->get("type"),
                        "velkost" => $request->request->get("size"),
                        "cena" => $request->request->get("cost"),
                        "IDmiestnosti" => $request->request->get("room"),
                        "IDzamestnanca" => $responsible,
                    ]);
            }
            elseif (\Auth::check() and \Auth::user()->role == "employee")
            {
                DB::table("ExpozicneMiesto")
                    ->where("IDmiesta", $id)
                    ->update([
                        "typ" => $request->request->get("type"),
                        "velkost" => $request->request->get("size"),
                        "cena" => $request->request->get("cost"),
                        "IDmiestnosti" => $request->request->get("room"),
                    ]);
            }
        }
        elseif($request->request->get("requesttype") == 2)
        {
            $id = $request->request->get("id");
            $validator = Validator::make($request->all(), [
                'count' => 'numeric',
            ]);

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            DB::table("Vybavuje")->insert([
                "IDvybavenia" => $request->request->get("equipment"),
                "IDmiesta" => $id,
                "pocet" => $request->request->get("count"),
            ]);
        }
        else
        {
            $id = $request->request->get("returnvalue");
            foreach ($request->request->keys() as $key)
                if ($request->request->get($key) == "delete")
                {
                    DB::table("Vybavuje")
                        ->where(["IDvybavenia" => $key])
                        ->where(["IDmiesta" => $id])
                        ->delete();
                }
        }

        return redirect("/man_spot/update/".$id);
    }
};