<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/** Game */
Route::get( 'allgame', 'GameController@all_game')
    ->middleware('auth');
    
Route::get( 'listgame/{pid}', 'GameController@list_game')
    ->where('pid', '[0-9]+');

/* Route::get( 'playgame/{pid}/{gid}', 'GameController@play_game') */
/*     ->where('pid', '[0-9]+')->where('gid', '[0-9]+'); */
Route::get( 'playgame/{gid}', 'GameController@play_game')
    ->where('gid', '[0-9]+')->middleware('auth');

Route::post( 'addconf/{pid}/{gid}', 'GameController@add_configuration' )
    ->where('pid', '[0-9]+')->where('gid', '[0-9]+');

Route::get( 'run/{gid}', 'GameController@run_first_period' )
    ->where('gid', '[0-9]+');

//Route::get( 'showgame/{pid}/{gid}', 'GameController@show_game_admin')
//    ->where('pid', '[0-9]+')->where('gid', '[0-9]+');
Route::get( 'showgame/{gid}', 'GameController@show_game')
    ->where('gid', '[0-9]+')->middleware('auth');

Route::get( 'resetgame/{pid}/{gid}', 'GameController@reset_game')
    ->where('pid', '[0-9]+')->where('gid', '[0-9]+');

/* Route::get( 'game/{ng}', function ($ng) { */
/*     return view( 'game' , ['numero' => $ng ]); */
/* })->where('ng', '[0-9]+'); */

/* Route::get('{n}', function($n) { */
/*     return view('vue1')->with( 'numero', $n); */
/* })->where('n', '[0-9]+'); */

/* /\** Configuration *\/ */
/* // TODO only test : display Configuration no 1 */
/* Route::get('conf/{cid}', function($cid) { */
/*     $conf = App\Configuration::findOrfail( $cid); */
/*     return view('configuration',['conf'=>$conf, 'zoneC'=>$conf->getZoneC(), 'zoneG'=>$conf->getZoneG()] ); */
/*     //return $conf->getZoneC(); */
/* })->where('cid', '[0-9]+'); */

/* Route::get('conf/{cid}/edit', function($cid) { */
/*     $conf = App\Configuration::findOrfail( $cid); */
/*     return view('configuration_edit',['conf'=>$conf, 'zoneC'=>$conf->getZoneC(), 'zoneG'=>$conf->getZoneG()] ); */
/* })->where('cid', '[0-9]+'); */

/* Route::put('conf/{cid}', ['as' => 'conf.update', function($cid) { */
/*         // TODO voir put or post */
/*         // TODO comment recuperer la request ? */
/*         //  public function update(Request $request, $id) */
/*         $conf = App\Configuration::findOrfail( $cid); */
/*         $zoneC = $conf->getZoneC(); */
/*     }])->where('cid', '[0-9]+'); */

/** Zones */
// TODO enleve qq routes
//Route::resource('zone', 'ZoneController');

// Authentication Routes...in /vendor/laravel/framework/src/Illuminate/Routing/
        /* $this->get('login', 'Auth\LoginController@showLoginForm')->name('login'); */
        /* $this->post('login', 'Auth\LoginController@login'); */
        /* $this->post('logout', 'Auth\LoginController@logout'); */

        /* // Registration Routes... */
        /* $this->get('register', 'Auth\RegisterController@showRegistrationForm'); */

        /* $this->post('register', 'Auth\RegisterController@register'); */
Route::get('_snow/167ACE845', 'Auth\RegisterController@showRegistrationForm');
Route::post('_snow/167ACE845', 'Auth\RegisterController@register');
        /* // Password Reset Routes... */
        /* $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm'); */
        /* $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail'); */
        /* $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm'); */
        /* $this->post('password/reset', 'Auth\ResetPasswordController@reset'); */
Auth::routes();

Route::get('editteam', 'TeamController@showTeamForm')
    ->middleware('auth');
Route::post('editteam', 'TeamController@editTeam')
    ->middleware('auth');

Route::get('/home', 'HomeController@index');

