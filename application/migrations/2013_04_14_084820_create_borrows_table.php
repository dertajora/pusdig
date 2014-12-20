<?php

class Create_Borrows_Table {    

	public function up()
    {
		Schema::create('borrows', function($table) {
			$table->increments('id');
			$table->integer('member_id');
			$table->date('tgl_pinjam');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('borrows');

    }

}