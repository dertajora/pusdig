<?php

class Books_Controller extends Base_Controller {

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
        $books =  Book::order_by('id', 'asc')->paginate(25); //show 3 record in each page

        return View::make('book.index')
        ->with('books',$books);
    }   

    public function get_katalog()
    {
        return View::make('book.katalog');
    }

    public function get_new()
    {
        return View::make('book.new');
    }    
    
    public function post_create() {
        

    /*$validation = Book::validate(Input::all());

    

    if($validation->fails()){
       
    return Redirect::to_route('new_book')->with_errors($validation)->with_input();

    }

    //else create create new author

    else{*/
    $jumlah = Input::get('jumlah');
    $nib = Input::get('id');

    
    
    for ($i=1; $i<=$jumlah; $i++){
    $validasi = Book::where_id($nib)->count('id');     
    if ( $validasi > 0){
         return Redirect::to_route('new_book')
         ->with('cek_buku',$nib);
    } 
    $nib = $nib+1;
    }

    $penerbit = Input::get('penerbit');

    if($penerbit=='baru'){
    $publisher = new Publisher;
    $publisher->nama = Input::get('penerbitbaru');
       
    $publisher->save();
    }

    $most_publisher = Publisher::max('id');

    $id_buku = Input::get('id');
    for ($i=1; $i<=$jumlah; $i++){
    $book = new Book;
    $book->id = $id_buku; 
    $book->judul = Input::get('judul');
    $book->tgl_terima = Input::get('tgl_terima');
    $book->pengarang = Input::get('pengarang');
    if ($penerbit=='baru'){
        $book->publisher_id = $most_publisher;
    }elseif ($penerbit!='baru'){
        $book->publisher_id = Input::get('penerbit');
    }
    $book->type_id = Input::get('type_id'); 
    $validation = $book->type_id;
    if ($validation != 1){
        $book->kelas = Input::get('kelas');
        $book->ddc = Input::get('ddc');
    }elseif ($validation == 1){
        $book->kelas = 0;
        $book->ddc = 0;
    }
    $book->sumber = Input::get('sumber');
    $book->jml_halaman = Input::get('halaman');
    $book->ukuran = Input::get('ukuran');
   
    $book->save();
    $id_buku = $id_buku+1;
    }
           

    return Redirect::to_route('new_book')

    ->with('status_message','Data buku telah berhasil dibuat');

                
            
    }


    public function get_edit($id)
    {

        $book = Book::find($id);
        if(is_null($book)) {

            return Redirect::to('books');
        }
        return View::make('book.edit')->with('book',$book);
    }  

    public function post_update($id) {

        $penerbit = Input::get('penerbit');

        if($penerbit=='baru'){
        $publisher = new Publisher;
        $publisher->nama = Input::get('penerbitbaru');
           
        $publisher->save();
        }

        $most_publisher = Publisher::max('id');
        $book= Book::find($id);
        $validation = Book::validate(Input::all());
        
        
        $book->judul = Input::get('judul');
        $book->tgl_terima = Input::get('tgl_terima');
        $book->pengarang = Input::get('pengarang');
        if ($penerbit=='baru'){
            $book->publisher_id = $most_publisher;
        }elseif ($penerbit!='baru'){
            $book->publisher_id = Input::get('penerbit');
        }
        $book->kelas = Input::get('kelas');
        $book->ddc = Input::get('ddc');
        $book->sumber = Input::get('sumber');
        $book->jml_halaman = Input::get('halaman');
        $book->ukuran = Input::get('ukuran');
        $book->type_id = Input::get('type_id');
       

        $book->save();
         return Redirect::to_route('books')

         ->with('status_message','Data buku telah berhasil diubah');
    }

    public function get_cetak_label($id)
    {

        $book = Book::find($id);
        if(is_null($book)) {

            return Redirect::to('book');
        }
        $kategori = $book->type_id;
        if ($kategori == 1){
            $ddc = 0;
        } else {
            $ddc = $book->ddc;
        }

        if ($kategori == 1){
            $jenis = 'Fks' ;
        } elseif ($kategori == 2) {
            $jenis = 'NFks';
        } elseif ($kategori == 3) {
            $jenis = 'Ref';
        } elseif ($kategori == 4) {
            $jenis = 'Guru';
        } elseif ($kategori == 5) {
            $jenis = 'Pel';
        }
        
        $nib = $book->id;
        $judul = DB::table('books')->where('id','=',$nib)->only('judul');
        $rak = substr($judul, 0,1);
        

        $pengarang = $book->pengarang;
        $pieces = explode(" ", $pengarang);
        
        $hitungkata = str_word_count($pengarang,0); //menghitung jumlah kata nama pengarang
        if ($hitungkata == 1){ //ketika pengarang cuman 1 kata dia menggunakan kata itu
            
            $nama = $pieces[0];
            $akronim = substr($nama,0,3);
        } elseif($hitungkata > 1){ //ketika pengarang lebih dari 1 kata, dia menggunakan kata ke dua diambil 3 karakter
            $nama = $pieces[1];
            $akronim = substr($nama, 0,3);
        }

        if ($ddc == 0){
            $akronim = "$rak / $akronim / $jenis ";
        } elseif ($ddc != null) {
            $akronim = "$ddc / $akronim / $jenis";
        }      
        
        return View::make('book.cetak_label')->with('akronim',$akronim)
        ->with('nib',$nib);
    }

    public function get_history($id)
    {
        $hasils = DB::
        query('select member_id,borrows.id as id_pinjam,
               borrow_details.id as id_detail,book_id,
               tgl_pinjam,tgl_kembali, status,denda  from 
               borrow_details left join borrows on borrow_details.borrow_id = borrows.id
               where book_id="'.$id.'" ');
        $books =  Book::where_id($id)->order_by('id', 'asc')->paginate(4); 
        
        return View::make('book.history')
        ->with('hasils',$hasils)
        ->with('books',$books);
        
    }

    public function get_delete($id) {

        $book = Book::find($id);
        $book->delete();
        
        return Redirect::to_route('books')
        ->with('status_message','Data telah berhasil dihapus');;    
    
    }

	public function post_index()
    {
        
    }    
    public function post_cari()
    {
     
        $keyword = Input::get('keyword');
        $kategori = Input::get('key');
        $halaman = Input::get('jumlah');

        if( $kategori == 'judul' ){
            $books =  Book::where('judul','like','%'.$keyword.'%')->order_by('id', 'asc')->paginate($halaman);
            $jumlah =  Book::where('judul','like','%'.$keyword.'%')->order_by('id', 'asc')->count('id');
        }
        elseif ( $kategori == 'pengarang' ){
            $books =  Book::where('pengarang','like','%'.$keyword.'%')->order_by('id', 'asc')->paginate($halaman);
            $jumlah =  Book::where('pengarang','like','%'.$keyword.'%')->order_by('id', 'asc')->count('id');
        }
        elseif ( $kategori == 'nib' ){
            $books =  Book::where('id','like','%'.$keyword.'%')->order_by('id', 'asc')->paginate($halaman);
            $jumlah =  Book::where('id','like','%'.$keyword.'%')->order_by('id', 'asc')->count('id');
        }
        elseif ( $kategori == 'penerbit' ){
            $id_penerbit = Publisher::where('nama','like','%'.$keyword.'%')->only('id');
            $books =  Book::where('publisher_id','=',$id_penerbit)->order_by('id', 'asc')->paginate($halaman);
            $jumlah =  Book::where('publisher_id','=',$id_penerbit)->order_by('id', 'asc')->count('id');
        }
        else {
            $books =  Book::where('kelas','like','%'.$keyword.'%')->order_by('id', 'asc')->paginate($halaman);
            $jumlah =  Book::where('kelas','like','%'.$keyword.'%')->order_by('id', 'asc')->count('id');
        }


        return View::make('book.cari')
        ->with('jumlah',$jumlah)
        ->with('books',$books);
    }   

	public function get_show()
    {
        return View::make('book.show');
    }    

	public function put_update()
    {

    }    

	public function delete_destroy()
    {

    }

}