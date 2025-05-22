<?php

namespace App\Http\Controllers\waste_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminWastePaymentController extends Controller
{
    //
    public function AdminWastePayment()
    {
        return view("waste-payment.index");
    }
}
