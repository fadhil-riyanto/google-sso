<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $retq = Auth::guard("guest")->user();
        return view("dashboard/index", [
            "name" => $retq["name"],
            "picture" => $retq["picture"]
        ]);
    }
}
