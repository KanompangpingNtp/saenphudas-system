<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\WasteAddress;
use App\Models\UserAddressLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function LoginPage()
    {
        return view('auth.login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            if (Auth::user()->level === '1') {
                return redirect()->route('AdminIndex');
            } elseif (Auth::user()->level === '2') {
                return redirect()->route('Home');
            } elseif (in_array(Auth::user()->level, ['3', '4'])) {
                return redirect()->route('AdminWastePayment');
            }
        }

        return back()->withErrors([
            'email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
        ]);
    }

    public function RegisterPage()
    {
        return view('auth.register');
    }

    public function Register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:9|confirmed',
            'salutation' => 'required|string',
            'age' => 'nullable|integer',
            'phone' => 'required|string',
            'house_number' => 'required|string',
            'village' => 'required|string',
            'subdistrict' => 'required|string',
            'district' => 'required|string',
            'province' => 'required|string',
        ]);

        $wasteAddress = WasteAddress::where('name', $request->house_number)->first();
        $isOldUser = $wasteAddress !== null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => '2',
            'user_old' => $isOldUser ? 2 : 1,
        ]);

        UserDetail::create([
            'users_id' => $user->id,
            'salutation' => $request->salutation,
            'age' => $request->age,
            'phone' => $request->phone,
            'house_number' => $request->house_number,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict,
            'district' => $request->district,
            'province' => $request->province,
        ]);

        if ($isOldUser) {
            UserAddressLog::create([
                'user_id' => $user->id,
                'address_id' => $wasteAddress->id,
            ]);
        }

        return redirect()->route('LoginPage')->with('success', 'ลงทะเบียนเรียบร้อยแล้ว กรุณาเข้าสู่ระบบ');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('Home');
    }
}
