<?php

namespace App\Http\Controllers\waste_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserWastePaymentController extends Controller
{
    public function UserWastePayment()
    {
        return view("home.trash-page");
    }
}
