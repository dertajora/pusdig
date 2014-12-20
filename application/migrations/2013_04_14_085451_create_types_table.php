<?php

class Create_Types_Table {    

	public function up()
    {
		Schema::create('types', function($table) {
			$table->increments('id');
			$table->string('jenis');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('types');

    }

}