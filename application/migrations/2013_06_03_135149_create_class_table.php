<?php

class Create_Class_Table {    

	public function up()
    {
		Schema::create('class', function($table) {
			$table->increments('id');
			$table->string('nama');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('class');

    }

}