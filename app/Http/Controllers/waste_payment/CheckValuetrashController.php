<?php

namespace App\Http\Controllers\waste_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckValuetrashController extends Controller
{
    public function CheckValuetrash()
    {
        return view("home.check-valuetrash-page");
    }
}
