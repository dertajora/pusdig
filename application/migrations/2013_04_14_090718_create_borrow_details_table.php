<?php

class Create_Borrow_Details_Table {    

	public function up()
    {
		Schema::create('borrow_details', function($table) {
			$table->increments('id');
			$table->integer('borrow_id');
			$table->integer('book_id');
			$table->date('tgl_kembali');
			$table->integer('denda');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('details');

    }

}