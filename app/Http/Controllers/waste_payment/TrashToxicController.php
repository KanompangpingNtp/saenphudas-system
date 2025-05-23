<?php

namespace App\Http\Controllers\waste_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrashToxicController extends Controller
{
    public function TrashToxic()
    {
        return view("home.trash-toxic-page");
    }
}
