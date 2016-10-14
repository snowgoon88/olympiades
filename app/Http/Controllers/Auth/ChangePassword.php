<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChangePassword extends Controller
{
    /**
     * Show the form to change password
     *
     * @return \Illuminate\Http\Response
     */
    public function showPasswordForm()
    {
        return view('auth.password_change');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|max:255',
            'new_password' => 'required|min:6|max:255|confirmed',
        ]);

        $credentials = $request->only('password');
        $credentials['login'] = Auth::user()->login;
        print_r($credentials);
        $recognized = Auth::guard()->attempt($credentials);
        if( $recognized == False ) {
            return redirect()->back()
                             ->withErrors(['password' => 'Mauvais mot de passe']);
        }
        // Change Password
        // print( "NEW=".$request->all()['new_password'] );
        $user = Auth::user(); 
        $user->password = bcrypt($request->all()['new_password']);
        $user->save();

        return redirect('/home');
    }
}
