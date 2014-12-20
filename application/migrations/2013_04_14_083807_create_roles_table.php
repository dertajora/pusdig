<?php

class Create_Roles_Table {    

	public function up()
    {
		Schema::create('roles', function($table) {
			$table->increments('id');
			$table->string('nama_jabatan');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('roles');

    }

}