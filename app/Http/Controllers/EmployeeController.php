<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view('index');
    }

    //
    // ──────────────────────────────────────────────────────────────────────────────────────────────────────────── I ──────────
    //   :::::: H A N D L E   I N S E R   E M P L O Y E E   A J A X   R E Q U E S T : :  :   :    :     :        :          :
    // ──────────────────────────────────────────────────────────────────────────────────────────────────────────────────────
    //

    public function  store(){
        print_r($_POST);
        print_r($_FILES);
    }
}
