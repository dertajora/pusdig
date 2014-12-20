<?php

class Create_Books_Table {    

	public function up()
    {
		Schema::create('books', function($table) {
			$table->increments('id');
			$table->string('judul');
			$table->date('tgl_terima');
			$table->string('pengarang');
			$table->string('penerbit');
			$table->string('sumber');
			$table->integer('jml_halaman');
			$table->string('ukuran');
			$table->integer('type_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('books');

    }

}