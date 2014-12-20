<?php

class Classifications_Controller extends Base_Controller {

	public $restful = true;    
    public function __construct(){
        $this->filter('before','auth');
    }

	public function get_index()
    {
        $kelas =  Classification::order_by('id', 'asc')->paginate(10); //show 3 record in each page
        return View::make('classification.index')
        ->with('kelas',$kelas);
    }    
    public function post_add()
    {
        $cek = Input::get('kelas');
        $validasi = Classification::where_kelas($cek)->count('id'); 
        if ( $validasi > 0){
            return Redirect::to_route('classifications')
            ->with('cek_kelas_buku',$cek);;
         } else {
        $kelas = new Classification;
        $kelas->rentang = Input::get('rentang');
        $kelas->kelas = Input::get('kelas');
       
        $kelas->save();
        return Redirect::to_route('classifications')
         ->with('status_message','Proses penambahan kelas buku berhasil');
        }
    }  
    public function get_edit($id)
    {
        $kelas = Classification::find($id);
        if(is_null($kelas)) {
            return Redirect::to('classification');
        }
        return View::make('classification.edit')->with('kelas',$kelas);
    }  

    public function post_update($id) {

        $kelas= Classification::find($id);

        $cek = Input::get('kelas');
        $validasi = Classification::where_kelas($cek)->count('id'); 
        if ( $validasi > 0){
            return Redirect::to_route('classifications')
            ->with('cek_kelas_buku',$cek);;
         } else {
        $kelas->rentang = Input::get('rentang');
        $kelas->kelas = Input::get('kelas');
        $kelas->save();
        return Redirect::to_route('classifications')

         ->with('status_message','Proses ubah data kelas buku berhasil');
        }
    }

    public function get_delete($id) {

        $kelas = Classification::find($id);
        $kelas-> delete();
        
        return Redirect::to_route('classifications')
        ->with('status_message','Proses hapus data kelas berhasil');    
    
    }   

	public function post_index()
    {

    }    

	public function get_show()
    {

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