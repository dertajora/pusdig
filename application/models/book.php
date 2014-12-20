<?php

class Book extends Eloquent 
{
	public static $table = 'books';

	public static $rules = array(

	'nib' => 'required',
	'judul' => 'required|min:5|max:100',
	'pengarang' => 'required',
	'penerbit' => 'required',
	//'kelas' => 'required',
	//'ddc' => 'required',
	'type_id' => 'required'


	

	);

	public static function validate($data){

	return Validator::make($data, static::$rules);

	}
	
}