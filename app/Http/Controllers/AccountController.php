<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class AccountController extends Controller
{
    public function show()
    {
        $sql = "SELECT odCas as 'From', doCas as 'To', d.nazov as 'Art Name',
                        ex.nazov as 'Exposition Name'
                    FROM Zakaznik as za
                        INNER JOIN Expozicia as ex
                            ON za.IDzakaznika = ex.IDzakaznika
                        INNER JOIN Zahrnuje as zahr
                            ON zahr.expozicia = ex.IDexpozicie
                        INNER JOIN Dielo as d
                            ON d.IDdiela = dielo
                    WHERE za.IDzakaznika = '". \Auth::user()->IDzakaznika ."'
                ORDER BY odCas";
        return view("user/account")->with([
            "table" => DB::select($sql),
            "header" => [
                'from', 'to', 'art name', 'exposition'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
