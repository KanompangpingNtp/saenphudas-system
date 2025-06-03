<?php

namespace App\Http\Controllers\waste_payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WasteManagement;

class TrashToxicController extends Controller
{
    public function TrashToxic()
    {
        // $user = Auth::user();
        // $movingPoints = WasteManagement::where('users_id', $user->id)
        //     ->whereNotNull('lat')
        //     ->whereNotNull('lng')
        //     ->get(['id', 'lat', 'lng']);

        // dd($movingPoints);

        // return view("home.trash-toxic-page", compact('user', 'movingPoints'));

        return view("home.trash-toxic-page");
    }
}
