<?php

class Create_Classifications_Table {    

	public function up()
    {
		Schema::create('classifications', function($table) {
			$table->increments('id');
			$table->string('rentang');
			$table->integer('kelas');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('classifications');

    }

}