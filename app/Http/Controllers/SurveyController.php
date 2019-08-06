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

class SurveyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function home(Request $request) 
  {
    $surveys = Survey::get();
    return view('home', compact('surveys'));
  }

  # Show page to create new survey
  public function new_survey() 
  {
    return view('survey.new');
  }

  public function create(Request $request, Survey $survey) 
  {
    $arr = $request->all();
    // $request->all()['user_id'] = Auth::id();
    $arr['user_id'] = Auth::id();
    $surveyItem = $survey->create($arr);
    return Redirect::to("/survey/{$surveyItem->id}");
  }

  # retrieve detail page and add questions here
  public function detail_survey(Survey $survey) 
  {
    $survey->load('questions.user');
    return view('survey.detail', compact('survey'));
  }
  

  public function edit(Survey $survey) 
  {
    return view('survey.edit', compact('survey'));
  }

  # edit survey
  public function update(Request $request, Survey $survey) 
  {
    $survey->update($request->only(['title', 'description']));
    return redirect()->action('SurveyController@detail_survey', [$survey->id]);
  }

  # view survey publicly and complete survey
    public function view_survey(Survey $survey)
    {
             // get you logged in user
      $user_id = auth()->user()->id;
      $survey->option_name = unserialize($survey->option_name);
      $hasAnswer = \App\Answer::where(['user_id'=>$user_id , 'survey_id' => $survey->id])->exists();//check if user has answer
             //user has an answer to one of the survey questions. Alternatively, you can also check if all questions are answered, or if a specific question is answered by including question id as well in where
        if($hasAnswer){
        return view('survey.already');
      } else{
        return view('survey.view', compact('survey', 'answers'));
      }
    }


  # view submitted answers from current logged in user
  public function view_survey_answers(Survey $survey) 
  {
    $user_id = auth()->user()->id;
    $survey->load('user.questions.answers');
    // return view('survey.detail', compact('survey'));
    $countyes = Answer::where('survey_id','=',$survey->id)
                      ->where('answer','like','yes')
                      ->count();
    $countno = Answer::where('survey_id','=',$survey->id)
                      ->where('answer','like','no')
                      ->count();
    $countelse = Answer::where('survey_id','=',$survey->id)
                        ->where('answer','like','else')
                        ->count();

    $chart = new sondage;
    $chart2 = new sondage;
    $chart->labels(['Yes', 'no', 'else']);
    $dataset = $chart->dataset('', 'bar', array($countyes,$countno,$countelse));
    $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']));
    $dataset->color(collect(['#7d5fff','#32ff7e', '#ff4d4d']));
    
    $count1 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '01')
                    ->count();

    $count2 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '02')
                    ->count();
    $count3 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '03')
                    ->count();
    $count4 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '04')
                    ->count();
    $count5 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '05')
                    ->count();
    $count6 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '06')
                    ->count();
    $count7 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '07')
                    ->count();
    $count8 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '08')
                    ->count();   
    $count9 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '09')
                    ->count();  
    $count10 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '10')
                    ->count();   
    $count11 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '11')
                    ->count();  
    $count12 = Answer::where('user_id','=',$user_id)
                    ->whereMonth('created_at', '=', '12')
                    ->count(); 

    $chart2->labels(['Janvier', 'Fev', 'mars', 'avril', 'juin', 'juillet','aout','sept', 'octo','nov','dec']);
    $chart2->dataset('Annuel', 'line', [$count1,$count2,$count3,$count4,$count5,$count6,$count7,$count8,$count9,$count10,$count11,$count12])->options([
              'backgroundColor' => '#ff2261',
              'fill' => 'false',
              'color' => '#ff2261',
              'lineTension' => '0.1',
              'borderColor' => 'red', // The main line color
              'borderCapStyle' => 'square',
              ]);
    // return $survey;
    // return view('survey.detail', compact('survey', 'chart'));
    return view('answer.see', compact('survey', 'chart','chart2'));
  }

  // TODO: Make sure user deleting survey 
  // has authority to
  public function delete_survey(Survey $survey)
  {
    $survey->delete();
    return redirect('');
  }
  public function data_answer(Survey $survey)
  {
    $bestuser = User::withCount('answers as answer_count')
                      ->orderBy('answer_count', 'desc')
                      ->take(10)
                      ->pluck('answer_count', 'name');
   echo $bestuser;             
  }
}
