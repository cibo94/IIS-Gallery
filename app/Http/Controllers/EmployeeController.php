<?php
/**
 * Created by PhpStorm.
 * User: xcibul10
 * Date: 12/1/15
 * Time: 2:58 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;


class EmployeeController extends Controller
{

    function __construct()
    {
        $this->middleware("admin");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'required|min:6|max:60',
            'email' => 'required|email|unique:users,email|max:255',
            'birthno' => 'required|unique:Zamestnanec,rc|max:10',
            'firstname' => 'required|max:20',
            'lastname' => 'required|max:20',
            'phone' => 'max:16',
            'role' => 'required|in:employee,admin'
        ]);
    }

    function getUpdate()
    {
        return view("actions.update")
            ->with("table", DB::select(
                "SELECT id, name, email, password, rc, meno, priezvisko, telefon, role
                    FROM users INNER JOIN Zamestnanec
                        WHERE users.id = Zamestnanec.IDzamestnanca"
            ))->with(
                "header", ["name", "email", "password", "birthno", "firstname", "lastname", "phone", "role"]
            )->with("target", "/man_employee/update");
    }

    function postUpdate(Request $request)
    {
        foreach ($request->request->all() as $key => $value) {
            if ($value == "")
                continue;
            $split = explode('-', $key);
            if (count($split) == 2) {
                $validator = Validator::make([$split[1] => $value], [
                    'name' => 'max:255',
                    'password' => 'min:6|max:60',
                    'email' => 'email|unique:users,email|max:255',
                    'rc' => 'unique:Zamestnanec,rc|max:10',
                    'meno' => 'max:20',
                    'priezvisko' => 'max:20',
                    'telefon' => 'max:16',
                    'role' => 'in:employee,admin'
                ]);

                if ($validator->fails())
                    $this->throwValidationException($request, $validator);

                if ($split[1] == "password") {
                    DB::table("users")
                        ->where(["id" => $split[0]])
                        ->update([$split[1] => bcrypt($value)]);
                } elseif (in_array($split[1], ["id", "name", "email", "role"])) {
                    DB::table("users")
                        ->where(["id" => $split[0]])
                        ->update([$split[1] => $value]);
                } elseif (in_array($split[1], ["rc", "meno", "priezvisko", "telefon"])) {
                    DB::table("Zamestnanec")
                        ->where(["IDzamestnanca" => $split[0]])
                        ->update([$split[1] => $value]);
                }
            }
        }
        return redirect("/man_employee/update");
    }

    function getCreate()
    {
        return view("actions.insert")
            ->with("table", DB::select(
                "SELECT name, email, password, rc, meno, priezvisko, telefon, role
                    FROM users INNER JOIN Zamestnanec
                        WHERE users.id = Zamestnanec.IDzamestnanca"
            ))->with(
                "header", ["username", "email", "password", "birthno", "firstname", "lastname", "phone", "role"]
            )->with("target", "/man_employee/create");
    }

    function postCreate(Request $request)
    {
        $request->request->add(["name" => $request->request->get("username")]);
        $request->request->remove("username");
        $user_tags = [
            'name' => $request->request->get("name"),
            'email' => $request->request->get("email"),
            'password' => bcrypt($request->request->get("password"))
        ];

        if ($request->request->get("role") == "")
            $request->request->set("role", "employee");

        $validator = $this->validator($request->request->all());
        if ($validator->fails())
            $this->throwValidationException($request, $validator);

        $user = User::create($user_tags);

        $zam_tags = [
            "IDzamestnanca" => $user->id,
            "rc" => $request->request->get("birthno"),
            "meno" => $request->request->get("firstname"),
            "priezvisko" => $request->request->get("lastname"),
            "telefon" => $request->request->get("phone")
        ];

        DB::table("users")->where(["id" => $user->id])->update(["role" => $request->request->get("role")]);
        DB::table("Zamestnanec")->insert($zam_tags);
        return redirect("/man_employee/create");
    }

    function getDelete()
    {
        return view("actions.delete")
            ->with("table", DB::select(
                "SELECT id, name username, email, password, rc, meno, priezvisko, telefon, role
                    FROM users INNER JOIN Zamestnanec
                        WHERE users.id = Zamestnanec.IDzamestnanca"
            ))->with(
                "header", ["username", "email", "password", "birthno", "firstname", "lastname", "phone", "role"]
            )->with("target", "/man_employee/delete");
    }

    function postDelete(Request $request)
    {
        foreach ($request->request->keys() as $key)
            if ($request->request->get($key) == "delete") {
                DB::table("users")->where(["id" => $key])->delete();
            }
        return redirect('/man_employee/delete');
    }
}

;