<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Domain;


class HomeController extends Controller
{
    public function home()
    {
	    $totalUsers = User::count();
	    $totalDomains = Domain::count();
        return view('dashboard', compact('totalUsers', 'totalDomains'));
    }
}
