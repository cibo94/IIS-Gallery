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


class EquipmentInsertController extends Controller {

    function __construct()
    {
        $this->middleware("admin");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:40',
            'description' => 'max:255',
        ]);
    }

    function getCreate()
    {
        $sql = "SELECT nazov, popis
                    FROM Vybavenie";
        return view("actions.insert")
            ->with("table", DB::select($sql))
            ->with("header", ["name", "description"])
            ->with("target", "/man_equipment/create");
    }

    function postCreate(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        DB::table("Vybavenie")->insert([
            "nazov" => $request->request->get("name"),
            "popis" => $request->request->get("description"),
        ]);

        return redirect("/man_equipment/create");
    }

    function getDelete()
    {
        return view("actions.delete")
            ->with("table", DB::select(
                "SELECT IDvybavenia id, nazov, popis FROM Vybavenie"
            ))->with(
                "header", ["name", "description"]
            )->with("target", "/man_equipment/delete");
    }

    function postDelete(Request $request)
    {
        foreach ($request->request->keys() as $key)
            if ($request->request->get($key) == "delete") {
                DB::table("Vybavenie")->where(["IDvybavenia" => $key])->delete();
            }
        return redirect('/man_equipment/delete');
    }

    function getUpdate()
    {
        return view("actions.update")
            ->with("table", DB::select(
                "SELECT IDvybavenia id, nazov, popis FROM Vybavenie"
            ))->with(
                "header", ["name", "description"]
            )->with("target", "/man_equipment/update");
    }

    function postUpdate(Request $request)
    {
        foreach ($request->request->all() as $key => $value) {
            if ($value == "")
                continue;
            $split = explode('-', $key);
            if (count($split) == 2) {
                $validator = Validator::make([$split[1] => $value], [
                    'name' => 'max:40',
                    'description' => 'max:255',
                ]);

                if ($validator->fails())
                    $this->throwValidationException($request, $validator);

                DB::table("Vybavenie")
                    ->where(["IDvybavenia" => $split[0]])
                    ->update([$split[1] => $value]);
            }
        }
        return redirect("/man_equipment/update");
    }
};