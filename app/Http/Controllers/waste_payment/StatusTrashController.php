<?php

namespace App\Http\Controllers\waste_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusTrashController extends Controller
{
    public function StatusTrash()
    {
        return view("home.status-trash-page");
    }
}
