<?php

class Create_Class_Details {    

	public function up()
    {
		Schema::create('class_details', function($table) {
			$table->increments('id');
			$table->integer('book_id');
			$table->string('ddc');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('details');

    }

}