<?php

class User extends Eloquent 
{
	public static $table = 'users';

	public static $rules = array(

	'nama' => 'required|min:6|max:40',
	'username' => 'required|min:6|max:15',
	'password' => 'required|min:6',
	//'tempat_lahir' => 'required|min:5',
	'role_id' => 'required'

	);



	public static function validate($data){

	return Validator::make($data, static::$rules);

	}
}