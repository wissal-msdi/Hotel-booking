<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

    }
}

