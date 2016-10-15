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
/** Test *****************************************************************/
Route::get( 'test', 'TestController@all_game');
Route::get( 'test/allgame', 'TestController@all_game');
Route::get( 'test/showgame/{gid}', 'TestController@show_game')
    ->where('gid', '[0-9]+');
Route::get( 'test/playgame/{pid}/{gid}', 'TestController@play_game_admin')
    ->where('pid', '[0-9]+')->where('gid', '[0-9]+');
Route::post( 'test/addconf/{pid}/{gid}', 'TestController@add_configuration' )
    ->where('pid', '[0-9]+')->where('gid', '[0-9]+');
Route::get( 'test/resetgame/{gid}', 'TestController@reset_game')
    ->where('gid', '[0-9]+');
Route::get( 'test/rules', 'TestController@rules');
/** **********************************************************************/

/** Guest ****************************************************************/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index'); // -> login si Guest

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
/** **********************************************************************/

/** Auth::Game ***********************************************************/
Route::get( 'allgame', 'GameController@all_game')
    ->middleware('auth');
    
Route::get( 'mygame', 'GameController@my_game')
    ->middleware('auth');

Route::get( 'playgame/{gid}', 'GameController@play_game')
    ->where('gid', '[0-9]+')->middleware('auth');

Route::post( 'addconf/{pid}/{gid}', 'GameController@add_configuration' )
    ->where('pid', '[0-9]+')->where('gid', '[0-9]+')->middleware('auth');

Route::get( 'showgame/{gid}', 'GameController@show_game')
    ->where('gid', '[0-9]+')->middleware('auth');
/** **********************************************************************/

/** Auth::Edit/Update ****************************************************/
Route::get('editteam', 'TeamController@showTeamForm')
    ->middleware('auth');
Route::post('editteam', 'TeamController@editTeam')
    ->middleware('auth');
/** **********************************************************************/

/* Auth::Authentification ************************************************/
Route::get('chpssd', 'Auth\ChangePassword@showPasswordForm' )
    ->middleware('auth');
Route::post('chpssd', 'Auth\ChangePassword@updatePassword' )
    ->middleware('auth');
/** **********************************************************************/

/** Backdoor *************************************************************/
Route::get('_snow/167ACE845', 'Auth\RegisterController@showRegistrationForm');
Route::post('_snow/167ACE845', 'Auth\RegisterController@register');
/** **********************************************************************/

/** Internal testing *****************************************************/
/* Route::get( 'listgame/{pid}', 'GameController@list_game') */
/*     ->where('pid', '[0-9]+'); */
/* Route::get( 'run/{gid}', 'GameController@run_first_period' ) */
/*     ->where('gid', '[0-9]+'); */
/* Route::get( 'resetgame/{pid}/{gid}', 'GameController@reset_game') */
/*     ->where('pid', '[0-9]+')->where('gid', '[0-9]+'); */
/** **********************************************************************/


// Authentication Routes...in /vendor/laravel/framework/src/Illuminate/Routing/
        /* $this->get('login', 'Auth\LoginController@showLoginForm')->name('login'); */
        /* $this->post('login', 'Auth\LoginController@login'); */
        /* $this->post('logout', 'Auth\LoginController@logout'); */

        /* // Registration Routes... */
        /* $this->get('register', 'Auth\RegisterController@showRegistrationForm'); */

        /* $this->post('register', 'Auth\RegisterController@register'); */

        /* // Password Reset Routes... */
        /* $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm'); */
        /* $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail'); */
        /* $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm'); */
        /* $this->post('password/reset', 'Auth\ResetPasswordController@reset'); */
//Auth::routes();





