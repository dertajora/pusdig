<?php

class Borrow extends Eloquent 
{
	public static $table = 'borrows';
	public function member()
	{
		return $this->belongs_to('Member');
	}

	public function details()
	{
		return $this->has_many('Detail');
	}
}

