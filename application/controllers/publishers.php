<?php

class Publishers_Controller extends Base_Controller {

	public $restful = true;   
    public function __construct(){
        $this->filter('before','auth');
    } 

	public function get_index()
    {
        $publishers =  Publisher::order_by('id', 'asc')->paginate(15); //show 3 record in each page
        return View::make('publisher.index')
        ->with('title','Daftar User')
        ->with('publishers',$publishers);
    }    
    public function post_add()
    {
        $cek = Input::get('penerbit');
        $validasi = Publisher::where_nama($cek)->count('id'); 
        if ( $validasi > 0){
            return Redirect::to_route('publishers')
            ->with('cek_penerbit',$cek);;
         } else {
        $publisher = new Publisher;
        $publisher->nama = Input::get('penerbit');
       
        $publisher->save();


        return Redirect::to_route('publishers')

         ->with('status_message','Proses penambahan penerbit berhasil');
        }
    }  
    public function get_edit($id)
    {
        $publisher = Publisher::find($id);
        if(is_null($publisher)) {

            return Redirect::to('publisher');
        }
        return View::make('publisher.edit')->with('publisher',$publisher);
    }  

    public function post_update($id) {

        $publisher= Publisher::find($id);

        $cek = Input::get('penerbit');
        $validasi = Publisher::where_nama($cek)->count('id'); 
        if ( $validasi > 0){
            return Redirect::to_route('publishers')
            ->with('cek_kelas_buku',$cek);;
         } else {
        $publisher->nama = Input::get('penerbit');
        $publisher->save();
        return Redirect::to_route('publishers')

         ->with('status_message','Proses ubah data penerbit berhasil');
        }
    }

    public function get_delete($id) {

        $publisher = Publisher::find($id);
        $publisher-> delete();
        
        return Redirect::to_route('publishers')
        ->with('status_message','Proses hapus data penerbit berhasil');    
    
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