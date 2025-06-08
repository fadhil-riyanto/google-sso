<?php

namespace App\Http\Controllers;

// use Google\Client; (unused)

use App\Models\GuestUser;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use GuzzleHttp\Exception\ClientException;

class GoogleAuthController extends Controller
{

    public function redirect(Request $req) {
        return Socialite::driver('google')->redirect();
    }

    public function handle_oauth_callback(Request $req)
    {
        try {
            $user = Socialite::driver('google')->user();
            $retq = $this->_handle_guest_user_record($user);
            return $this->_handle_session($req, $user->email);

            // dd($user);
        } catch (InvalidStateException) {
            return redirect("/login")->withErrors([
                "error" => "state invalid, please re-login"
            ]);
        } catch (ClientException $e) {
            return redirect("/login")->withErrors([
                "error" => "oops, bad request"
            ]);
        }
    }

    private function _handle_guest_user_record($user) {
        $retq = GuestUser::upsert([
            "name" => $user->name,
            'picture' => $user->avatar,
            'email' => $user->email,
            'password' => Hash::make("password"), // THIS is unused, for authenticatable class
            'token' => $user->token,
            'g_auth_expires_in' => $user->expiresIn

        ], ['email'], ['picture', 'token', 'g_auth_expires_in']);
        // dd($retq);
    }

    private function _handle_session(Request $req, $email) {
        $packed_arr = [
            "email" => $email,
            "password" => "password"
        ];

        if (Auth::guard("guest")->attempt($packed_arr)) {

            $retq = GuestUser::where("email", $packed_arr["email"])->first();
            $retq = Auth::guard("guest")->login($retq);

            return redirect('/dashboard/index');
        } else {
            dd("login failed");
        }

    }
}
