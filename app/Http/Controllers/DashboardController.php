<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sosmed = Sosmed::with(['statistiks' => function ($query) {
            $query->latest('periode');
        }])->get();

        return view('pages.dashboard.index', compact('sosmed'));
    }
}
