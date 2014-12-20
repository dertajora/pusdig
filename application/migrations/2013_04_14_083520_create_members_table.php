<?php

class Create_Members_Table {    

	public function up()
    {
		Schema::create('members', function($table) {
			$table->increments('id');
			$table->string('nama');
			$table->boolean('kelamin');
			$table->date('tgl_lahir');
			$table->string('tempat_lahir');
			$table->string('alamat');
			$table->integer('kontak');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('members');

    }

}