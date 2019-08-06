<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Answer;
use App\Survey;
use DB;
class DashboardController extends Controller
{
    public function index()
    {
		$usercount = User::count();
		$answercount = Answer::count();
		$surveycount = Survey::count();	

        return view('dashboard.test')->with('usercount', $usercount)->with('answercount', $answercount)->with('surveycount', $surveycount);
    }
    public function topuser()
    {
    $bestuser = Answer::OrderBy('created_at', 'DESC')->take(10)->get();

		return view('dashboard.top')->with('bestuser', $bestuser);
    }

}
