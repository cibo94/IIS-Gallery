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
        $this->middleware("admin");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'identificator' => 'required|alpha_num|unique:Miestnost,IDmiestnosti',
            'area' => 'required|numeric',
        ]);
    }

    function getRoom()
    {
        $sql = "SELECT IDmiestnosti id, plocha
                    FROM Miestnost";
        return view("admin.room")
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