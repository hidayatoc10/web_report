<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    public function dashboard_wali_murid()
    {
        return view("wali_kelas.dashboard_wali_murid");
    }
}
