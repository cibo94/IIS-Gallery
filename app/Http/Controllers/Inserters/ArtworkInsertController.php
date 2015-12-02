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


class ArtworkInsertController extends Controller {

    function __construct()
    {
        $this->middleware("user");
    }

    function getArtwork()
    {
        $sql = "SELECT nazov, autor, typ
                    FROM Dielo
                        WHERE Dielo.IDusera = '". \Auth::user()->id ."'";
        return view("user.artwork")
            ->with("table", DB::select($sql))
            ->with("header", ["artwork", "author", "type"])
            ->with("target", "/man_artwork/send");
    }

    function postSend(Request $request)
    {
        DB::table("Dielo")->insert([
            "nazov" => $request->request->get("artwork"),
            "autor" => $request->request->get("author"),
            "typ" => $request->request->get("type"),
            "IDusera" => \Auth::user()->id
        ]);
        return redirect("/man_artwork/artwork");
    }
};