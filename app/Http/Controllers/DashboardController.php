<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //
        $stories = Story::where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('dashboard.index', [
            'stories' => $stories
        ]);
    }
}
