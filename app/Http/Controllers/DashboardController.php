<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Domain;

class DashboardController extends Controller
{

    public function index()
    {
        $totalUsers = User::count();
        $totalDomains = Domain::count();

        $domains = Domain::all();
        $recentDomains = Domain::latest()->take(5)->get();
    
        return view('dashboard.index', compact('totalUsers', 'totalDomains', 'domains', 'recentDomains'));
    }	
}

?>
