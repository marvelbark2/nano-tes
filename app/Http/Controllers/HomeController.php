<?php

namespace App\Http\Controllers;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usercount = \App\User::count();
        $votecount = \App\Answer::count();
        $topusers = \App\User::orderBy('reputation','DESC')->paginate(10);
        $topsurvey = \App\Answer::withCount('survey as survey_count')
                                ->orderBy('survey_count', 'DESC')
                                ->get();
        //echo $topsurvey;
       //foreach ($topsurvey->id as $topsurvey_id){ 
                                    
        return view('dashboard')->with('usercount', $usercount)->with('votecount', $votecount)->with('topusers', $topusers)->with('topsurvey', $topsurvey);
    }
}
