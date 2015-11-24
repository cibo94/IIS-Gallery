<?php
/**
 * Created by PhpStorm.
 * User: onionka
 * Date: 11/24/15
 * Time: 12:04 PM
 */

namespace App\Http\Controllers;



class HomeController extends Controller
{
    public function get()
    {
        return view("home");
    }
}