<?php

class Transactions_Controller extends Base_Controller {

	public $restful = true;  
    public function __construct(){
        $this->filter('before','auth');
    }  

	public function get_index()
    {
        /*$hasils = DB::
        query('select member_id,borrows.id as id_pinjam,
               borrow_details.id as id_detail,book_id,
               tgl_pinjam,tgl_kembali status,denda  from 
               borrow_details left join borrows on borrow_details.borrow_id = borrows.id
               order by id_pinjam desc');*/
        $role = Auth::user()->role_id;
        if ($role != 3 ){
            return Redirect::to_route('restricted');
        } 
        $hasils = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->order_by('borrow_details.tgl_pinjam','desc') 
            ->order_by('borrow_details.created_at','desc')    
            ->paginate('15');
        return View::make('transaction.index')->with('hasils',$hasils);
    }    

    public function get_pinjam()
    {
        
        return View::make('transaction.pinjam');
    } 

    public function get_kembali()
    {
        return View::make('transaction.kembali');
    } 

    public function post_cek()
    {
        //ini untuk menampilkan member 


        $cek = Input::get('id');

        $memberexist = DB::
        query('select id,nama from 
               members
               where id="'.$cek.'"');
        $cek_exist=count($memberexist);

        $memberbebas = DB::
        query('select id,nama from 
               members
               where id="'.$cek.'" && status !="Bebas"');
        $cek_bebas=count($memberbebas);
       
        if($cek_exist == 0){
            return Redirect::to_route('pinjam')
         
            ->with('cek_exist',$cek);
        }
        elseif ($cek_bebas == 0){
            return Redirect::to_route('pinjam')
         
            ->with('cek_bebas',$cek);
        } elseif ($cek_bebas != 0){
            
       
        
        $members =  Member::where_id($cek)->order_by('nama', 'asc')->paginate(4); //show 3 record in each page
        $null = '0000-00-00';
        $hasils = DB::
        query('select member_id,borrows.id as id_pinjam,
               borrow_details.id as id_detail,book_id,
               tgl_pinjam, tgl_kembali, status  from 
               borrow_details left join borrows on borrow_details.borrow_id = borrows.id
               where member_id="'.$cek.'" && tgl_kembali is null');
        //return dd($hasils);

        return View::make('transaction.pinjam_baru')

        ->with('title','Daftar Anggota')
        ->with('members',$members) 
        ->with('hasils',$hasils);
        }
    } 

    public function post_proses_pinjam(){
        $member = Input::get('member_id');

        $hasils = DB::
        query('select member_id,borrows.id as id_pinjam,
               borrow_details.id as id_detail  from 
               borrow_details left join borrows on borrow_details.borrow_id = borrows.id
               where member_id="'.$member.'" && tgl_kembali is null');
        $cek_pinjaman=count($hasils);
      
        if ($cek_pinjaman == 3){
             return Redirect::to_route('pinjam')
         
            ->with('gagal','Peminjaman gagal, anggota sudah mencapai batasan maksimal peminjaman buku ( 3 buku )');
        }

        $book1 = Input::get('buku1');
        $book2 = Input::get('buku2');
        $book3 = Input::get('buku3');
        $jumlah = 0;
        Member::find($member)->borrows()->insert(array(
        
        ));
        $most = Borrow::max('id');
        $today = date("Y-m-d"); 

        if ($book1 == ''){
            $jumlah = $jumlah+1;
            $status1 ='kosong';
        } elseif ($book1 != '') {
            
            $validasi = Book::where_id($book1)->count('id');
            if ( $validasi > 0){
                
            $validasi_hilang = DB::query('select book_id from borrow_details 
              left join borrows on borrow_details.borrow_id = borrows.id
              WHERE book_id="'.$book1.'" && status = "hilang" ');
            $count_hilang1=count($validasi_hilang);
            
            $validasi_pinjam = DB::query('select  book_id from borrow_details left join borrows on borrow_details.borrow_id = borrows.id 
                  WHERE book_id="'.$book1.'" && tgl_kembali is null  ');
            $count_pinjam1=count($validasi_pinjam);
            

            if ($count_hilang1 > 0 ){
                $jumlah = $jumlah+1;
                $status1 ='hilang';
            }elseif ($count_pinjam1 > 0){
                $jumlah = $jumlah+1;
               $status1 ='dipinjam';
            }elseif ($count_hilang1 ==0 && $count_pinjam1==0){
                $status1 ='sukses';
                Borrow::find($most)->details()->insert(array(
                'book_id' => $book1,
                'tgl_pinjam' => $today,
                'status' => null,
                
                )); 
            }else{
               $jumlah = $jumlah+1; 
            }
            

        }
        }

        if ($book2 == ''){
            $jumlah = $jumlah+1;
            $status2 ='kosong';
        } elseif ($book2 != '') {
            $validasi = Book::where_id($book2)->count('id');
            if ( $validasi > 0){
           $validasi_hilang = DB::query('select book_id from borrow_details 
              left join borrows on borrow_details.borrow_id = borrows.id
              WHERE book_id="'.$book2.'" && status = "hilang" ');
            $count_hilang2=count($validasi_hilang);
            
            $validasi_pinjam = DB::query('select  book_id from borrow_details left join borrows on borrow_details.borrow_id = borrows.id 
                  WHERE book_id="'.$book2.'" && tgl_kembali is null  ');
            $count_pinjam2=count($validasi_pinjam);
            

            if ($count_hilang2 > 0 ){
                $jumlah = $jumlah+1;
                $statu2s ='hilang';
            }elseif ($count_pinjam2 > 0){
                $jumlah = $jumlah+1;
               $status2 ='dipinjam';
            }elseif ($count_hilang2 ==0 && $count_pinjam2==0){
                $status2 ='sukses';
                Borrow::find($most)->details()->insert(array(
                'book_id' => $book2,
                'tgl_pinjam' => $today,
                'status' => null,
                
                )); 
            }else{
               $jumlah = $jumlah+1; 
            }
          
        }
        }

        if ($book3 == ''){
            $jumlah = $jumlah+1;
            $status3 ='kosong';
        } elseif ($book3 != ''){
            $validasi = Book::where_id($book3)->count('id');
            if ( $validasi > 0){
            $validasi_hilang = DB::query('select book_id from borrow_details 
              left join borrows on borrow_details.borrow_id = borrows.id
              WHERE book_id="'.$book3.'" && status = "hilang" ');
            $count_hilang3=count($validasi_hilang);
            
            $validasi_pinjam = DB::query('select  book_id from borrow_details left join borrows on borrow_details.borrow_id = borrows.id 
                  WHERE book_id="'.$book3.'" && tgl_kembali is null  ');
            $count_pinjam3=count($validasi_pinjam);
            

            if ($count_hilang3 > 0 ){
                $jumlah = $jumlah+1;
                $status3 ='hilang';
            }elseif ($count_pinjam3 > 0){
                $jumlah = $jumlah+1;
               $status3 ='dipinjam';
            }elseif ($count_hilang3 ==0 && $count_pinjam3==0){
                $status3 ='sukses';
                Borrow::find($most)->details()->insert(array(
                'book_id' => $book3,
                'tgl_pinjam' => $today,
                'status' => null,
                
                )); 
            }else{
               $jumlah = $jumlah+1; 
            }
            
        
            }
        }
        //return dd($book3);
        if ($status1 != 'sukses' && $status2 != 'sukses' && $status3 != 'sukses' ){
             return Redirect::to_route('pinjam')
         
            ->with('gagal','Peminjaman Gagal');
        }
        if ($status1 == 'sukses' && $status2 != 'sukses' && $status3 != 'sukses' ){
             return Redirect::to_route('pinjam')
         
            ->with('buku1','Peminjaman Gagal');
        }
        if ($status1 != 'sukses' && $status2 == 'sukses' && $status3 != 'sukses' ){
             return Redirect::to_route('pinjam')
         
            ->with('buku2','Peminjaman Gagal');
        }

        if ($status1 != 'sukses' && $status2 != 'sukses' && $status3 == 'sukses' ){
             return Redirect::to_route('pinjam')
         
            ->with('buku3','Peminjaman Gagal');
        }
        

        if ($book1 == '' && $book2 == '' && $book3 == '' ){
             return Redirect::to_route('pinjam')
         
            ->with('belum','Anda belum memasukkan buku');
        }
        return Redirect::to_route('pinjam')
         
            ->with('sukses','Peminjaman Berhasil');
        /*
        Member::find($member)->borrows()->insert(array(
        
        )); 

        $most = Borrow::max('id');


        for ($i=1; $i<=2; $i++){
        Borrow::find($most)->details()->insert(array(
        'book_id' => $book1,
        'status' => 'Kembali',
        'denda' => '0',
        )); 
        $book1=$book1+1;
        }   */

        //return dd($validasi);
    }
    

	public function post_cek_pinjaman()
    {
        $cek = Input::get('id');

        $memberexist = DB::
        query('select id,nama from 
               members
               where id="'.$cek.'"');
        $cek_exist=count($memberexist);

        $memberbebas = DB::
        query('select id,nama from 
               members
               where id="'.$cek.'" && status !="Bebas"');
        $cek_bebas=count($memberbebas);
       
        if($cek_exist == 0){
            return Redirect::to_route('kembali')
         
            ->with('cek_exist',$cek);
        }
        elseif ($cek_bebas == 0){
            return Redirect::to_route('kembali')
         
            ->with('cek_bebas',$cek);
        } elseif ($cek_bebas != 0){
        
        $members =  Member::where_id($cek)->order_by('nama', 'asc')->paginate(4); //show 3 record in each page

        $hasils = DB::
        query('select member_id,borrows.id as id_pinjam,
               borrow_details.id as id_detail,book_id,
               tgl_pinjam,tgl_kembali, status  from 
               borrow_details left join borrows on borrow_details.borrow_id = borrows.id
               where member_id="'.$cek.'" && tgl_kembali is null order by tgl_pinjam');


        return View::make('transaction.cek_pinjaman')
        ->with('members',$members)
        ->with('cek',$cek)
        ->with('hasils',$hasils);
        }
    }    

    public function get_return($id)
    {

        $detail= Detail::find($id);
        
        $today = date("Y-m-d"); 
        
        
        $detail->tgl_kembali = $today;
        
        $detail->save();
        $derta=100;

        
        $posts = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.id','=',$id)
            ->only('member_id');
        //return Redirect::to('transactions');
        //return View::make('transaction.cek_pinjamans');
        return Redirect::to_route('return_again')->with('id',$posts);
    }  

    public function get_return_again()
    {
        Session::reflash();
        $id = Session::get('id');
        
        $cek = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrows.member_id','=',$id)
            ->only('member_id');
            
        $members =  Member::where_id($cek)->order_by('nama', 'asc')->paginate(4); //show 3 record in each page

        $hasils = DB::
        query('select member_id,borrows.id as id_pinjam,
               borrow_details.id as id_detail,book_id,
               tgl_pinjam,tgl_kembali, status  from 
               borrow_details left join borrows on borrow_details.borrow_id = borrows.id
               where member_id="'.$cek.'" && tgl_kembali is null order by tgl_pinjam');

        
        return View::make('transaction.cek_pinjaman')
        ->with('members',$members)
        ->with('cek',$cek)
        ->with('hasils',$hasils);    
        
        
    }  

    public function get_extend($id)
    {
        $detail= Detail::find($id);//mengembalikan pinjaman
        $today = date("Y-m-d"); 
        $detail->tgl_kembali = $today;
        $detail->save();
        
        $peminjaman = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.id','=',$id)
            ->order_by('borrow_details.updated_at','desc')
            ->get();
        foreach ($peminjaman as $data) {
            $buku=$data->book_id;
            $id_pinjam =$data->borrow_id;
        }
       
        Borrow::find($id_pinjam)->details()->insert(array(
                'book_id' => $buku,
                'tgl_pinjam' => $today,
                'status' => 'Perpanjang',
                
                ));
       

        $posts = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.id','=',$id)
            ->only('member_id');
        //return Redirect::to('transactions');
        //return View::make('transaction.cek_pinjamans');
        return Redirect::to_route('return_again')->with('id',$posts);
        // return Redirect::to_route('transactions');
        //return View::make('transaction.pinjam');
    }  



    public function get_lost($id)
    {
       
        $detail= Detail::find($id);
       
        $today = date("Y-m-d"); 
        $detail->tgl_kembali=$today;
        $detail->status = 'Hilang';
        $detail->save();

        //$book_id = $detail->book_id;
        //$tanggal = date("Y-m-d H:i:s");
        //$book =  Book::find($book_id);
        //$book->status = 'Hilang';
        //$book->save();
        //$book = Book::where_nib($book_id);

        //$buku = DB::query('update books set status="Hilang", updated_at="'.$tanggal.'"  where id="'.$book_id.'" ');
        $posts = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.id','=',$id)
            ->only('member_id');
        //return Redirect::to('transactions');
        //return View::make('transaction.cek_pinjamans');
        return Redirect::to_route('return_again')->with('id',$posts);
    }  

    public function get_bebas_pustaka()
    {
        
        $members = Member::where_status('Bebas')->order_by('updated_at', 'desc')->paginate(10);
        return View::make('transaction.bebas_pustaka')->with('title','Daftar Anggota')
        ->with('members',$members);
    } 

    public function post_cek_bebas()
    {
        $cek = Input::get('id');

        $members =  Member::where_id($cek)->order_by('nama', 'asc')->paginate(4); //show 3 record in each page
        
        $memberexist = DB::
        query('select id,nama from 
               members
               where id="'.$cek.'"');
        $cek_exist=count($memberexist);

        $memberbebas = DB::
        query('select id,nama from 
               members
               where id="'.$cek.'" && status !="Bebas"');
        $cek_bebas=count($memberbebas);
        

        if($cek_exist == 0){
            return Redirect::to_route('bebas_pustaka')
         
            ->with('cek_exist',$cek);
        }
        elseif ($cek_bebas == 0){
            return Redirect::to_route('bebas_pustaka')
         
            ->with('cek_bebas',$cek);
        } elseif ($cek_bebas != 0){

        $hasils = DB::
        query('select member_id,borrows.id as id_pinjam,
               borrow_details.id as id_detail,book_id,
               tgl_pinjam,tgl_kembali, status  from 
               borrow_details left join borrows on borrow_details.borrow_id = borrows.id
               where member_id="'.$cek.'" && tgl_kembali is null order by tgl_pinjam');


        return View::make('transaction.cek_bebas')
        ->with('members',$members)
        ->with('hasils',$hasils);}
    }    

    public function get_proses_bebas($id)
    {
        $member= Member::find($id);
        $member->status = 'Bebas';
        $member->save();
        
        $members = Member::where_status('Bebas')->order_by('updated_at', 'desc')->paginate(10);
        return Redirect::to_route('bebas_pustaka')
        ->with('sukses',$id);
    }   

    public function get_cetak_bebas($id)
    {
        $array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
        

        $member = Member::find($id);
        if(is_null($member)) {

            return Redirect::to('member');
        }

        $tgl = date('d-m-Y');
        $pieces = explode("-", $tgl);
        
        $tanggal = $pieces[0];
        $tanggal_int = (int)$pieces[1]; 
        $bulan = $pieces[1];
        $bulan_int = (int)$bulan; 
        $tahun = $pieces[2];
        $bulanupdate = $array_bulan[$bulan_int];

        $tgl_baru = "$tanggal_int  $bulanupdate  $tahun ";

        return View::make('transaction.cetak_bebas')->with('member',$member)
        ->with('tgl_baru',$tgl_baru);
    }  


	public function get_show()
    {

    }    

	public function get_edit()
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