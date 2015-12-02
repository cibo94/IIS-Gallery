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


class EmployeeInsertController extends Controller {

    function __construct()
    {
        $this->middleware("admin");
    }

    function getEmployee()
    {
        return view("admin.insert")
            ->with("table", DB::select(
                "SELECT name, email, password, rc, meno, priezvisko, telefon, role
                    FROM users INNER JOIN Zamestnanec
                        WHERE users.id = Zamestnanec.IDzamestnanca"))
            ->with("header", ["name", "email", "password", "birthno", "firstname", "lastname", "phone", "role"])
            ->with("target", "/man_employee/send");
    }

    function postSend(Request $request)
    {
        $user = User::create([
            'name' => $request->request->get("name"),
            'email' => $request->request->get("email"),
            'password' => bcrypt($request->request->get("password"))
        ]);
        DB::table("users")->where(["id" => $user->id])->update(["role" => "employee"]);
        DB::table("Zamestnanec")->insert([
            "IDzamestnanca" => $user->id,
            "rc" => $request->request->get("birthno"),
            "meno" => $request->request->get("firstname"),
            "priezvisko" => $request->request->get("lastname"),
            "telefon" => $request->request->get("phone")
        ]);
        return redirect("/man_employee/employee");
    }
};