<?php

class Create_Publishers_Table {    

	public function up()
    {
		Schema::create('publishers', function($table) {
			$table->increments('id');
			$table->string('nama');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('publishers');

    }

}