<?php

class Create_Borrow_Completion_Table {    

	public function up()
    {
		Schema::create('borrow_completions', function($table) {
			$table->increments('id');
			$table->integer('member_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('completion');

    }

}