<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Home()
    {
        return view("home.first-page");
    }

      public function Eservice()
    {
        return view("home.second-page");
    }
}
