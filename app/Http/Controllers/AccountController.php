<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
    public function show()
    {
        $sql = "SELECT odCas as 'From', doCas as 'To', d.nazov as 'Art Name',
                        ex.nazov as 'Exposition Name'
                    FROM users as za
                        INNER JOIN Expozicia as ex
                            ON za.id = ex.IDusera
                        INNER JOIN Zahrnuje as zahr
                            ON zahr.expozicia = ex.IDexpozicie
                        INNER JOIN Dielo as d
                            ON d.IDdiela = dielo
                    WHERE za.id = '". \Auth::user()->fkid ."'
                ORDER BY odCas";
        return view("user/account")->with([
            "table" => DB::select($sql),
            "header" => [
                'from', 'to', 'art name', 'exposition'
            ]
        ]);
    }
}
