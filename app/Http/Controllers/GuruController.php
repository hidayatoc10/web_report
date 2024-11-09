<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function dashboard_guru()
    {
        return view("guru.dashboard_guru");
    }
}
