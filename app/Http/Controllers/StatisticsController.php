<?php

namespace App\Http\Controllers;

use App\Models\Statistics;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $statistics = Statistics::orderByDesc('num_of_tasks')->get()->take(10);
        // dd($statistics);
        return view('statistics', ['statistics' => $statistics]);
    }
}
