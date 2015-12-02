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

class ExpositionInsertController extends Controller {

    function __construct()
    {
        $this->middleware("user");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:40',
            'from' => 'required|date|date_format:d-m-Y',
            'to' => 'required|date|date_format:d-m-Y|after:from',
        ]);
    }

    function getExposition()
    {
        $sql= "SELECT odCas, doCas do, nazov
                    FROM Expozicia
                    WHERE IDusera = '". \Auth::user()->id ."'
                ORDER BY do";
        return view("user.exposition")
            ->with("table", DB::select($sql))
            ->with("header", ["from", "to", "name"])
            ->with("target", "/man_exposition/send");
    }

    function postSend(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $fromTime = \DateTime::createFromFormat('d-m-Y',$request->request->get("from"));
        $toTime = \DateTime::createFromFormat('d-m-Y', $request->request->get("to"));

        DB::table("Expozicia")->insert([
            "nazov" => $request->request->get("name"),
            "odCas" => $fromTime,
            "doCas" => $toTime,
            "IDusera" => \Auth::user()->id
        ]);

        return redirect("/man_exposition/exposition");

    }
};

