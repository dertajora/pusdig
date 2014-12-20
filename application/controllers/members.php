<?php

class Members_Controller extends Base_Controller {

	public $restful = true;   
    public function __construct(){
        $this->filter('before','auth');
    } 
    
	public function get_index()
    {
        $role = Auth::user()->role_id;
        if ($role == 3 ){
           return Redirect::to_route('restricted');
        }
        $members =  Member::order_by('id', 'asc')->paginate(25); //show 3 record in each page

        return View::make('member.index')

        ->with('members',$members);

        
    }    


	public function post_index()
    {

    }    

	public function get_show()
    {

    }    

	  

    public function get_update($id) {

        
    }
	public function get_new()
    {
            return View::make('member.new')
            ->with('title','Tambah Anggota Baru');

    }
    public function post_create(){

    //validate all input using the validate

    //static method under author class.

    //$validation = Member::validate(Input::all());

    //if the validation fails redirect user to

    //the insert new author page

   /* if($validation->fails()){
       // return View::make('member.new')->with_errors($validation)->with_input();
    return Redirect::to_route('new_member')->with_errors($validation)->with_input();

    }*/

    //else create create new author
    
    //else{
    $cek = Input::get('nis');
    $validasi = Member::where_id($cek)->count('id'); 
    if ( $validasi > 0){
         return Redirect::to_route('new_member')
         
         ->with('cek_member',$cek);
    } else {

    $member = new Member;
    $member->id = Input::get('nis');
    $member->nama = Input::get('nama');
    $member->class_id = Input::get('kelas');
    $member->kelamin = Input::get('kelamin');
    $member->angkatan = Input::get('angkatan');
    $member->tempat_lahir = Input::get('tempat_lahir');
    $member->tgl_lahir = Input::get('tgl_lahir');
    $member->alamat = Input::get('alamat');
    $member->status = Input::get('status');

    $member->save();

    return Redirect::to_route('new_member')

    ->with('status_message','Data anggota baru telah disimpan');
    }

    //}

    }    

    public function get_edit($id)
    {

        $member = Member::find($id);
        if(is_null($member)) {

            return Redirect::to('member');
        }
        return View::make('member.edit')->with('member',$member);
    }  

    public function get_cetak($id)
    {

        $member = Member::find($id);
        if(is_null($member)) {

            return Redirect::to('member');
        }

        $array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
        
        $tgl_lahir = $member->tgl_lahir;
        $pieces = explode("-", $tgl_lahir);
        
        $tanggal = $pieces[2];
        $tanggal_int = (int)$pieces[2]; 
        $bulan = $pieces[1];
        $bulan_int = (int)$bulan; 
        $tahun = $pieces[0];
        $bulanupdate = $array_bulan[$bulan_int];

        $tgl = date('d-m-Y');
        $pecah = explode("-", $tgl);
        
        $tanggal_skrng = $pecah[0];
        $tanggal_skrng_int = (int)$tanggal_skrng; 
        $bulan_skrng = $pecah[1];
        $bulan_int_skrng = (int)$bulan_skrng; 
        $tahun_skrng = $pecah[2];
        $bulanupdate_skrng = $array_bulan[$bulan_int_skrng];

        $tgl_baru = "$tanggal_int  $bulanupdate  $tahun ";

        $tgl_skrng = "$tanggal_skrng_int  $bulanupdate_skrng  $tahun_skrng ";
        
        return View::make('member.cetak')->with('member',$member)
        ->with('tgl_lahir',$tgl_baru)
        ->with('tgl_skrng',$tgl_skrng);
    }  

    public function get_history($id)
    {
        $hasils = DB::
        query('select member_id,borrows.id as id_pinjam,
               borrow_details.id as id_detail,book_id,
               tgl_pinjam,tgl_kembali, status,denda  from 
               borrow_details left join borrows on borrow_details.borrow_id = borrows.id
               where member_id="'.$id.'" ');
        $members =  Member::where_id($id)->order_by('nama', 'asc')->paginate(4); //show 3 record in each page

        return View::make('member.history')
        ->with('members',$members) 
        ->with('hasils',$hasils);
        
    }  

    public function post_search()
    {
     
        $keyword = Input::get('keyword');
       
        $members =  Member::where('nama','like','%'.$keyword.'%')
                ->or_where('id','like','%'.$keyword.'%')
                ->order_by('id', 'asc')->paginate(20);
        $count = Member::where('nama','like','%'.$keyword.'%')
                ->or_where('id','like','%'.$keyword.'%')
                ->count('id');
        return View::make('member.cari')
        ->with('members',$members)
         ->with('count',$count);
    }   

    public function post_update($id) {

        $member= Member::find($id);
       /* $validation = Member::validate(Input::all());
        
        if(is_null($member)) {

            return Redirect::to('members');
        }
        elseif ($validation->fails()) {
            return Redirect::to('members/edit/'.$id)->with_errors($validation)->with_input();
        }
       
        else{*/

        
        $member->nama = Input::get('nama');
        $member->class_id = Input::get('kelas');
        $member->angkatan = Input::get('angkatan');
        $member->kelamin = Input::get('kelamin');
        
        $member->tempat_lahir = Input::get('tempat_lahir');
        $member->tgl_lahir = Input::get('tgl_lahir');
        $member->alamat = Input::get('alamat');
        $member->status = 1;

        $member->save();
         return Redirect::to_route('members')

         ->with('status_message','Proses Update Data Anggota Berhasil');

  //  }
        
    }


    public function get_delete($id) {

        $member = Member::find($id);
        $member->delete();
        
        return Redirect::to_route('members')
         ->with('status_message','Proses Hapus Data Anggota Berhasil');    
    
    }

	public function put_update()
    {

    }    



	public function delete_destroy()
    {

    }

}