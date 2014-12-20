<?php

class Create_Guests_Table {    

	public function up()
    {
		Schema::create('guests', function($table) {
			$table->increments('id');
			$table->integer('member_nis');
			$table->integer('tujuan');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('guests');

    }

}