<?php

namespace App\Http\Controllers;

use App\Models\GuestUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DebugController extends Controller
{
    public function debug_upsert()
    {
        // dd(User::class);
        $retq = GuestUser::upsert([
            "name" => "guest",
            'picture' => "gusestpic",
            'email' => "random@ran.co",
            'password' => "aaaa",
            'token' => "b",
            'g_auth_expires_in' => 1822

        ], ['email'], ['picture', 'token', 'g_auth_expires_in']);
        dd($retq);
    }

    public function debug_custom_guard()
    {
        $retq = Auth::guard("guest")->user();
        dd($retq);
    }

    public function debug_auth_guard(Request $req)
    {
        $packed_arr = [
            "email" => $req->email,
            "password" => "password"
        ];

        if (Auth::guard("guest")->attempt($packed_arr)) {
            // $req->session()->regenerate();
            $retq = GuestUser::where("email", $packed_arr["email"])->first();
            $retq = Auth::guard("guest")->login($retq);
            // dd($retq);
            return redirect('/debug/custom_guard');
        }
        // $retq = GuestUser::where("email", $req->email);
    }
}
