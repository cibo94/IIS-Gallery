<?php
/**
 * Created by PhpStorm.
 * User: onionka
 * Date: 12/1/15
 * Time: 2:58 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;


class PaymentController extends Controller {

    function __construct()
    {
        $this->middleware("user");
    }

    function getPay()
    {
        if (\Auth::check() and \Auth::user()->role == "admin")
        {
            $payed = "SELECT suma, datum, status
                      FROM Poplatok WHERE status = 1";
            $unpayed = "SELECT suma, datum, status
                       FROM Poplatok WHERE status = 0";

            return view("admin.payment")
                ->with("payed", DB::select($payed))
                ->with("unpayed", DB::select($unpayed))
                ->with("header", ["amount", "due date", "status"]);
        }
        elseif (\Auth::check() and \Auth::user()->role == "user")
        {
            $sql = "SELECT IDpoplatku id, suma, datum, status
                    FROM Poplatok WHERE IDusera = '" . \Auth::user()->id . "'
                                    AND status = 0";
            return view("user.payment")
                ->with("table", DB::select($sql))
                ->with("header", ["amount", "due date", "status"])
                ->with("target", "/man_payment/pay");
        }
        else
            return redirect("/about");
    }

    function postPay(Request $request)
    {
        foreach ($request->request->keys() as $key)
            if ($request->request->get($key) == "pay")
            {
                DB::table("Poplatok")->where(["IDpoplatku" => $key])->update(["status" => 1]);
            }
        return redirect("/man_payment/pay");
    }

};