<?php

class Classes_Controller extends Base_Controller {

	public $restful = true;  
    public function __construct(){
        $this->filter('before','auth');
    }  

	public function get_index()
    {

        
        $class =  Classes::order_by('id', 'asc')->paginate(20); //show 3 record in each page

        return View::make('class.index')

        ->with('title','Daftar User')

        ->with('class',$class);
    }    

	public function post_index()
    {

    }    
    public function post_add()
    {
        $cek = Input::get('kelas');
        $validasi = Classes::where_nama($cek)->count('id'); 
        if ( $validasi > 0){
            return Redirect::to_route('classes')
            ->with('cek_kelas',$cek);;
         } else {
        $kelas = new Classes;
        $kelas->nama = Input::get('kelas');
       
        $kelas->save();


        return Redirect::to_route('classes')

         ->with('status_message','Proses Penambahan Kelas Berhasil');
        }
    }    

	public function get_show()
    {

    }    

	public function get_edit($id)
    {
        $kelas = Classes::find($id);
        if(is_null($kelas)) {

            return Redirect::to('class');
        }
        return View::make('class.edit')->with('kelas',$kelas);
    }    
        
     public function post_update($id) {

        $kelas= Classes::find($id); 
        $cek = Input::get('nama');
        $validasi = Classes::where_nama($cek)->count('id'); 
        if ( $validasi > 0){
            return Redirect::to_route('classes')
            ->with('cek_kelas',$cek);;
        } else {   
        $kelas->nama = Input::get('nama');
        $kelas->save();
        return Redirect::to_route('classes')

         ->with('status_message','Proses ubah data kelas berhasil');


        }
        
    }

    public function get_delete($id) {

        $kelas = Classes::find($id);
        $kelas-> delete();
        
        return Redirect::to_route('classes')
        ->with('status_message','Proses Hapus Kelas Berhasil');    
    
    }

	public function get_new()
    {

    }    

	public function put_update()
    {

    }    

	public function delete_destroy()
    {

    }

}