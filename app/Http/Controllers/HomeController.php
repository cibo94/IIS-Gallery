<?php
/**
 * Created by PhpStorm.
 * User: onionka
 * Date: 11/24/15
 * Time: 12:04 PM
 */

namespace App\Http\Controllers;

use DB;
use Schema;

class HomeController extends Controller
{
    public function get()
    {

        $date = 
        // Select vsetky vystavovane diela
        $select = 'SELECT E.odCas od, E.doCas do, D.nazov Nazov, 
                          D.autor, D.typ Typ, E.Nazov Nazov_Expozicie
                    FROM Dielo D
                    INNER JOIN Zahrnuje Za ON Za.DIELO = D.IDdiela
                    INNER JOIN Expozicia E WHERE E.doCas >= CURDATE() AND
                                                 E.odCas <= CURDATE() AND
                                                 E.IDexpozicie IN 
                        (SELECT Za.expozicia
                         FROM ExpozicneMiesto EX, Zahrnuje Za
                         WHERE EX.IDmiesta = Za.expozicneMiesto
                         AND Za.dielo = D.IDdiela)
                    ORDER BY do';

        $table = DB::select($select);
        $header = ['from', 'to', 'art name', 'author', 'type', 'exposition'];

        return view("home")->with([
            'header' => $header,
            'table' => $table
        ]);
    }
}