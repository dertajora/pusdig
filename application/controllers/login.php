<?php

class Login_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		return View::make('login.login');	
	}

	public function action_login()
    {
        return View::make('home.login');
    }

    public function post_login()
    {
    	$username = Input::get('username');
    	$password = Input::get('password');

    	$credentials = array(
    		'username' => $username,
    		'password' => $password
    		);

    	if (Auth::attempt($credentials)){

    		$user = Auth::user();
    		$pengguna = $user->username;
    		return Redirect::to_route('index');
    	}
    	return Redirect::to_route('login')->with('login_message',true);
     	//return Redirect::to_route('index');
    }   

    public function get_logout()
    {
    	Auth::logout();
     	return Redirect::to_route('login');
    }   
}