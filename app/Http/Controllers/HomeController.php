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
        $select = 'SELECT Z.odCas od, Z.doCas do, D.nazov Nazov, 
                          A.meno, D.typ Typ, E.Nazov Nazov_Expozicie
                    FROM Autor A 
                    INNER JOIN Dielo D ON A.IDAUTORA = D.IDAUTORA
                    INNER JOIN Zahrnuje Z ON Z.DIELO = D.IDDIELA 
                                             AND Z.doCas >= CURDATE()
                                             AND Z.odCas <= CURDATE()
                    INNER JOIN Expozicia E WHERE E.IDexpozicie IN 
                        (SELECT Za.expozicia
                         FROM ExpozicneMiesto EX, Zahrnuje Za
                         WHERE EX.IDmiesta = Za.expozicneMiesto
                         AND Za.dielo = D.IDdiela)
                    ORDER BY do';

        $table = DB::select($select);
        $header = ['Vystavované od', 'Vystavované do', 'Názov diela', 
                   'Autor', 'Typ diela', 'Expozícia'];

        return view("home")->with([
            'header' => $header,
            'table' => $table
        ]);
    }
}