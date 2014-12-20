<?php

class Member extends Eloquent 
{
	

public static $table = 'members';

public function borrows()
	{
		return $this->has_many('Borrow');
	}

/*
public static $rules = array(

'nama' => 'required',
'kelamin' => 'required',
'tgl_lahir' => 'required',
'tempat_lahir' => 'required',
'alamat' => 'required',

);



public static function validate($data){

return Validator::make($data, static::$rules);

}*/


}