<?php
/**
 * Created by PhpStorm.
 * User: onionka
 * Date: 12/1/15
 * Time: 2:58 PM
 */

namespace App\Http\Controllers\Inserters;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Validator;


class RoomInsertController extends Controller {

    function __construct()
    {
        $this->middleware("employee");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'identificator' => 'required|alpha_num|unique:Miestnost,IDmiestnosti',
            'area' => 'required|numeric',
        ]);
    }

    function getDelete()
    {
        return view("actions.delete")
            ->with("table", DB::select(
                "SELECT IDmiestnosti id, IDmiestnosti 'area id', plocha area
                     FROM Miestnost"
            ))->with(
                "header", ["area id", "area"]
            )->with("target", "/man_room/delete");
    }

    function postDelete(Request $request)
    {
        foreach ($request->request->keys() as $key)
            if ($request->request->get($key) == "delete")
            {
                DB::table("Miestnost")->where(["IDmiestnosti" => $key])->delete();
            }
        return redirect("/man_room/delete");
    }

    function getRoom()
    {
        $sql = "SELECT IDmiestnosti id, plocha
                    FROM Miestnost";
        return view("actions.insert")
            ->with("table", DB::select($sql))
            ->with("header", ["identificator", "area"])
            ->with("target", "/man_room/send");
    }

    function postSend(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        DB::table("Miestnost")->insert([
            "IDmiestnosti" => $request->request->get("identificator"),
            "plocha" => $request->request->get("area"),
        ]);

        return redirect("/man_room/room");
    }
};