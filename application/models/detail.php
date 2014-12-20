<?php

class Detail extends Eloquent 
{
	public static $table = 'borrow_details';

	public function borrow()
	{
		return $this->belongs_to('Borrow');
	}
}

