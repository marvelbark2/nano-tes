<?php
Route::get('/', 'SurveyController@home');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/top', 'DashboardController@topuser');
Route::get('/index', 'SurveyController@home');
Route::get('/survey/answers/chartPdf', 'ChartController@index');

Route::get('/survey/new', 'SurveyController@new_survey')->name('new.survey');
Route::get('/survey/{survey}', 'SurveyController@detail_survey')->name('detail.survey');
Route::group(["middleware" => "App\Http\Middleware\HistoryBack"], function()
{
    Route::get('/survey/view/{survey}', 'SurveyController@view_survey')->name('view.survey');
    Route::get('/survey/answers/{survey}', 'SurveyController@view_survey_answers')->name('view.survey.answers');
});
Route::get('/survey/{survey}/delete', 'SurveyController@delete_survey')->name('delete.survey');

Route::get('/survey/{survey}/edit', 'SurveyController@edit')->name('edit.survey');
Route::get('/survey/{survey}/chart', 'SurveyController@data_answer')->name('chart.survey');
Route::patch('/survey/{survey}/update', 'SurveyController@update')->name('update.survey');

Route::post('/survey/view/{survey}/completed', 'AnswerController@store')->name('complete.survey');
Route::post('/survey/create', 'SurveyController@create')->name('create.survey');

// Questions related
Route::post('/survey/{survey}/questions', 'QuestionController@store')->name('store.question');

Route::get('/question/{question}/edit', 'QuestionController@edit')->name('edit.question');
Route::patch('/question/{question}/update', 'QuestionController@update')->name('update.question');
Route::get('/logout', 'Auth\LoginController@logout');
Route::auth();Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

