<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home.index');
});

Route::post('/', function() {
  // return "posted";
  // dd($_POST);
  
  $url = Input::get('url');

  //validate the url
  $v = Url::validate(array('url' => $url));

  if ($v !== true) {
    return Redirect::to('/')->withErrors($v->errors());
  }

  $record = Url::whereUrl($url)->first();
  if($record) {
    return View::make('home.result')->with('shortened', $record->shortened);
  } else {
    $shortened = Url::get_unique_short_url();
    // dd($shortened);
    $row = Url::create(array(
      'url' => $url,
      'shortened' => $shortened
    ));

    if($row) {
      return View::make('home.result')->with('shortened', $shortened);
    }
  }
});

Route::get('{any}', function($shortened) {
  // return $shortened;
  $row = Url::whereShortened($shortened)->first();
  if(empty($row)) {
    return Redirect::to('/');
  }
  return Redirect::to($row->url);
});