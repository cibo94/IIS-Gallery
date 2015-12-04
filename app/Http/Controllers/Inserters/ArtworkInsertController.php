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


class ArtworkInsertController extends Controller {

    function __construct()
    {
        $this->middleware("user");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'artwork' => 'required|max:30',
            'artworktype' => 'required|max:20',
            'author' => 'max:40',
        ]);
    }


    function getUpdate()
    {
        return view("actions.update")
            ->with("table", DB::select(
                "SELECT IDdiela id, nazov, autor, typ 'arttype'
                    FROM Dielo WHERE Dielo.IDusera =" . \Auth::user()->id
            ))->with(
                "header", ["artwork", "author", "type"]
            )->with("target", "/man_artwork/update");
    }

    function postUpdate(Request $request)
    {
        foreach ($request->request->all() as $key => $value) {
            if ($value == "")
                continue;
            $split = explode('-', $key);
            if (count($split) == 2) {
                $validator = Validator::make([$split[1] => $value], [
                    'nazov' => 'max:30',
                    'arttype' => 'max:20',
                    'autor' => 'max:40',
                ]);

                if ($validator->fails())
                    $this->throwValidationException($request, $validator);

                if (in_array($split[1], ["nazov", "autor", "arttype"])) {
                    if($split[1] == "arttype")
                        $split[1] = "typ";
                    DB::table("Dielo")
                        ->where(["IDdiela" => $split[0]])
                        ->update([$split[1] => $value]);
                }
            }
        }
        return redirect("/man_artwork/update");
    }

    function getCreate()
    {
        $sql = "SELECT nazov, autor, typ
                    FROM Dielo
                        WHERE Dielo.IDusera = '". \Auth::user()->id ."'";
        return view("user.create")
            ->with("table", DB::select($sql))
            ->with("header", ["artwork", "author", "artwork type"])
            ->with("target", "/man_artwork/send");
    }

    function getDelete()
    {
        return view("actions.delete")
            ->with("table", DB::select(
                "SELECT IDdiela id, nazov, autor, typ arttype
                    FROM Dielo WHERE Dielo.IDusera =" . \Auth::user()->id
            ))->with(
                "header", ["nazov", "autor", "typ"]
            )->with("target", "/man_artwork/delete");
    }

    function postDelete(Request $request)
    {
        foreach ($request->request->keys() as $key)
            if ($request->request->get($key) == "delete") {
                DB::table("Dielo")->where(["IDdiela" => $key])->delete();
            }
        return redirect('/man_artwork/delete');
    }

    function postSend(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        DB::table("Dielo")->insert([
            "nazov" => $request->request->get("artwork"),
            "autor" => $request->request->get("author"),
            "typ" => $request->request->get("artworktype"),
            "IDusera" => \Auth::user()->id
        ]);
        return redirect("/man_artwork/create");
    }
};