<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExhibitionController extends Controller
{

    public function getGuests()
    {
        if (\Auth::check())
            return redirect("/user/exhibition");
        return view("exhibition");
    }

    public function getUsers()
    {
        if (! \Auth::check())
            return view("exhibition");
        if (\Auth::check() and \Auth::user()->role == "admin")
            return redirect("/admin/exhibition");
        return view("user/exhibition");
    }

    public function getAdmins()
    {
        if (\Auth::check() and \Auth::user()->role == "admin")
            return view("admin/exhibition");
        if (! \Auth::check())
            return view("exhibition");
        else
            return view("user/exhibition");
    }
}
