<?php

namespace App\Http\Controllers;

use Auth;
use App\Survey;
use App\Answer;
use App\User;
use DB;
use App\Charts\sondage;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ChartController extends Controller
{
    public function index()
    {
        $pdf = \PDF::loadView('answer.chartjs');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->download('chart.pdf');
    }
}
