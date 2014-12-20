<?php

class Reports_Controller extends Base_Controller {

	public $restful = true;    
    public function __construct(){
        $this->filter('before','auth');
    }

    public function get_report_lost()
    {
        
        
        $peminjaman_hilang = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->join('books','borrow_details.book_id','=','books.id')
            ->join('publishers','publishers.id','=','books.publisher_id')

            ->where('borrow_details.status','=','Hilang')
            ->order_by('borrow_details.updated_at','desc')
            
            ->paginate('20');

        return View::make('report.report_lost')
        ->with('books',$peminjaman_hilang);
    } 

    public function post_riwayat_buku()
    {
        $nib = Input::get('buku');
        $bookexist = DB::
        query('select id from 
               books
               where id="'.$nib.'"');
        $cek_exist=count($bookexist);
        
        if($cek_exist == 0){
            return Redirect::to_route('riwayat_buku')
         
            ->with('cek_exist',$nib);
        }


        $riwayat = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.book_id','=',$nib)
            ->order_by('borrow_details.tgl_pinjam','desc')
            ->order_by('borrow_details.updated_at','desc')   
            ->paginate(20);
        $jumlah = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.book_id','=',$nib)
            ->order_by('borrow_details.tgl_pinjam')   
            ->count();    
        $books =  Book::where_id($nib)->order_by('id', 'asc')->paginate(4); 
          
           
        //return dd($books);
        return View::make('report.book_trace')
        ->with('books',$riwayat)
        ->with('datas',$books)
        ->with('jumlah',$jumlah);
    } 

    public function post_riwayat_anggota()
    {
        
        $nis = Input::get('nis');
        $memberexist = DB::
        query('select id from 
               members
               where id="'.$nis.'"');
        $cek_exist=count($memberexist);
        
        if($cek_exist == 0){
            return Redirect::to_route('riwayat_anggota')
         
            ->with('cek_exist',$nis);
        }

        
        $riwayat = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrows.member_id','=',$nis)
            ->order_by('borrow_details.tgl_pinjam','desc')     
            ->paginate('20');
        $jumlah = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrows.member_id','=',$nis)
            ->order_by('borrow_details.tgl_pinjam')   
            ->count();    
        $members =  Member::where_id($nis)->order_by('id', 'asc')->paginate(4); 
          
           
        //return dd($books);
        return View::make('report.member_trace')
        ->with('borrows',$riwayat)
        ->with('datas',$members)
        ->with('jumlah',$jumlah);
    } 


    public function get_new_entry()
    {  $bulan = date("Y-m-"); 
       $pieces = explode("-", $bulan);
       $bulanbaru = (int)$pieces[1]; 
       $tahun = $pieces[0];
       $array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
        
       $tahun = $pieces[0];
       $bulanupdate = $array_bulan[$bulanbaru];
 
       $tgl_baru = "$bulanupdate  $tahun "; 
       
       //$tanggal = '-'.$bulan.'-';
       $books =  Book::where('tgl_terima','like','%'.$bulan.'%')->order_by('tgl_terima', 'desc')->paginate(20);
       //$books =  Book::where order_by('created_at', 'desc')->paginate(10); //show 3 record in each page

        return View::make('report.new_entry')

        ->with('title','Daftar Buku')
        ->with('tgl_baru',$tgl_baru)
        ->with('books',$books);
    } 
    
    public function get_denda()
    {
         function dateDiff($start, $end) {
         $start_ts = strtotime($start);
          $end_ts = strtotime($end);
          $diff = $end_ts - $start_ts;
          return round($diff / 86400);
          }

       //untuk mengambil bulan pada saat itu
        $bulan = date('Y-m'); 
        
        $bulanfix = 0;
        //$hasils =  Detail::where('tgl_kembali','like','%'.$bulan.'%')->get();
        $hasils = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.tgl_kembali', 'LIKE', '%'.$bulan.'%')
            ->order_by('borrow_details.updated_at','desc')     
            ->get();

        
        
        $bulans =  Detail::where('tgl_kembali','like','%'.$bulan.'%')->get();
        $dendabulanan = 0;
        $adadenda = 0;
        foreach($bulans as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }elseif($telat >0){
            $adadenda=$adadenda+1;    
            $dendasementara = $telat * 100;
            $dendabulanan = $dendabulanan + $dendasementara;
            }
        }
        //return dd($dendabulanan);
        //if ($dendabulanan == null ){
          //  $dendabulanan = 0;
        //} 
        //$dendafix = $dendabulanan;   
        return View::make('report.denda')
        ->with('hasils',$hasils)
        ->with('bulanfix',$bulanfix)
        ->with('dendabulanan',$dendabulanan)
        ->with('cek_denda',$adadenda);
    } 

    public function post_denda()
    {
        function dateDiff($start, $end) {
         $start_ts = strtotime($start);
          $end_ts = strtotime($end);
          $diff = $end_ts - $start_ts;
          return round($diff / 86400);
          }
        $inputbulan = Input::get('bulan');
        $pieces = explode("-", $inputbulan);
        $bulan = (int)$pieces[1]; 

        //untuk menampilkan peminjaman berdenda bulan  ini 
        $hasils = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.tgl_kembali', 'LIKE', '%'.$inputbulan.'%')
            ->order_by('borrow_details.updated_at','desc')     
            ->get();
        //untuk menghitung jumlah total peminjaman berdenda dan jumlah denda pada bulan  ini 
        $bulans =  Detail::where('tgl_kembali','like','%'.$inputbulan.'%')->get();
        $dendabulanan = 0;
        $adadenda = 0;
        foreach($bulans as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }elseif($telat >0){
            $adadenda=$adadenda+1;    
            $dendasementara = $telat * 100;
            $dendabulanan = $dendabulanan + $dendasementara;
            }
        }   
        //return dd($adadenda);   
        //if ($dendabulanan == null ){
          //  $dendabulanan = 0;
        //}     

        return View::make('report.denda')
        ->with('hasils',$hasils)
        ->with('bulanfix',$bulan)
        ->with('dendabulanan',$dendabulanan)
        ->with('cek_denda',$adadenda);
    }

    public function get_aktivitas()
    {
        $role = Auth::user()->role_id;
        if ($role != 2 ){
            return Redirect::to_route('restricted');
        }
        $inputbulan = date('Y-m'); 
        
        $bulan = 0;

        $hasils = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.tgl_pinjam', 'LIKE', '%'.$inputbulan.'%')
            ->order_by('borrow_details.updated_at','desc')     
            ->paginate();
        $total = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.tgl_pinjam', 'LIKE', '%'.$inputbulan.'%') 
            ->count();   

        return View::make('report.aktivitas')
        ->with('hasils',$hasils)
        ->with('bulanfix',$bulan)
        ->with('total',$total);
    } 

    public function post_aktivitas()
    {
        //$bulan = date('Y-m'); 
        $inputbulan = Input::get('bulan');
        $pieces = explode("-", $inputbulan);
        $bulan = (int)$pieces[1]; 

        $hasils = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.tgl_pinjam', 'LIKE', '%'.$inputbulan.'%')
            ->order_by('borrow_details.updated_at','desc')     
            ->paginate();
        //untuk menghitung jumlah peminjaman berdenda   
        $total = DB::table('borrows')
            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
            ->where('borrow_details.tgl_pinjam', 'LIKE', '%'.$inputbulan.'%') 
            ->count();    
        //return dd($adadenda);   
        

        return View::make('report.aktivitas')
        ->with('hasils',$hasils)
        ->with('bulanfix',$bulan)
        ->with('total',$total);
    } 

    public function get_riwayat_buku()
    {
        
        return View::make('report.riwayat_buku');
    } 

     public function get_riwayat_anggota()
    {
        
        return View::make('report.riwayat_anggota');
    } 

     public function get_graph_denda()
    {
        $denda = Detail::sum('denda');
          
        return View::make('report.graph_denda')->with('denda',$denda);;
    } 

    public function get_graph_book()
    {


        $fiksi = Book::where_type_id(1)->count('id');
        $nonfiksi = Book::where_type_id(2)->count('id');
        $referensi = Book::where_type_id(3)->count('id');
        $guru = Book::where_type_id(4)->count('id');
        $pelajaran = Book::where_type_id(5)->count('id');
        $total = Book::count('id');
        return View::make('report.graph_book')
        ->with('fiksi',$fiksi)
        ->with('nonfiksi',$nonfiksi)
        ->with('referensi',$referensi)
        ->with('guru',$guru)
        ->with('pelajaran',$pelajaran)
        ->with('total',$total);

        
    } 
    public function get_graph_borrow()
    {
        //untuk mencari tahun saat itu
        $tahun = date("Y"); 

        //untuk mendefinisikan tiap tiap bulan
        $satu     = "$tahun-01-";
        $dua      = "$tahun-02-";
        $tiga     = "$tahun-03-";
        $empat    = "$tahun-04-";
        $lima     = "$tahun-05-";
        $enam     = "$tahun-06-";   
        $tujuh    = "$tahun-07-";
        $delapan  = "$tahun-08-";
        $sembilan = "$tahun-09-";
        $sepuluh  = "$tahun-10-";
        $sebelas  = "$tahun-11-";
        $duabelas = "$tahun-12-";


        //untuk mendefinisikan peminjaman masing-masing bulan
        $januari =  Detail::where('tgl_pinjam','like','%'.$satu.'%')->count('id');
        $februari =  Detail::where('tgl_pinjam','like','%'.$dua.'%')->count('id');
        $maret =  Detail::where('tgl_pinjam','like','%'.$tiga.'%')->count('id');
        $april =  Detail::where('tgl_pinjam','like','%'.$empat.'%')->count('id');
        $mei =  Detail::where('tgl_pinjam','like','%'.$lima.'%')->count('id');
        $juni =  Detail::where('tgl_pinjam','like','%'.$enam.'%')->count('id');
        $juli =  Detail::where('tgl_pinjam','like','%'.$tujuh.'%')->count('id');
        $agustus =  Detail::where('tgl_pinjam','like','%'.$delapan.'%')->count('id');
        $september =  Detail::where('tgl_pinjam','like','%'.$sembilan.'%')->count('id');
        $oktober =  Detail::where('tgl_pinjam','like','%'.$sepuluh.'%')->count('id');
        $november =  Detail::where('tgl_pinjam','like','%'.$sebelas.'%')->count('id');
        $desember =  Detail::where('tgl_pinjam','like','%'.$duabelas.'%')->count('id');
        $total = Detail::where('tgl_pinjam','like','%'.$tahun.'%')->count('id');

        //untuk mengirim variabel variabel dibawahnya ke halaman graph_borrow di folder report
        return View::make('report.graph_borrow')
        
        ->with('total',$total) // variabel total peminjaman tahun itu
       
        ->with('januari',$januari) //variabel peminjaman tiap bulan yang dikirim
        ->with('februari',$februari)
        ->with('maret',$maret)
        ->with('april',$april)
        ->with('mei',$mei)
        ->with('juni',$juni)   
        ->with('juli',$juli)
        ->with('agustus',$agustus)
        ->with('september',$september)
        ->with('oktober',$oktober)
        ->with('november',$november)
        ->with('desember',$desember)
        ->with('tahun',$tahun); //variabel tahun itu

        
    } 

    public function get_graph_charge()
    {
        //mengambil tahun saat itu
        function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
        }

        $tahun = date("Y"); 

        //mendefinisikan bulan tahun saat itu
        $satu     = "$tahun-01-";
        $dua      = "$tahun-02-";
        $tiga     = "$tahun-03-";
        $empat    = "$tahun-04-";
        $lima     = "$tahun-05-";
        $enam     = "$tahun-06-";   
        $tujuh    = "$tahun-07-";
        $delapan  = "$tahun-08-";
        $sembilan = "$tahun-09-";
        $sepuluh  = "$tahun-10-";
        $sebelas  = "$tahun-11-";
        $duabelas = "$tahun-12-";
        
        //mencari denda untuk tiap-tiap bulan pada saat itu
        //$januari =  Detail::where('tgl_kembali','like','%'.$satu.'%')->sum('denda');
        //$februari =  Detail::where('tgl_kembali','like','%'.$dua.'%')->sum('denda');
        //$maret =  Detail::where('tgl_kembali','like','%'.$tiga.'%')->sum('denda');
        //$april =  Detail::where('tgl_kembali','like','%'.$empat.'%')->sum('denda');
        //$mei =  Detail::where('tgl_kembali','like','%'.$lima.'%')->sum('denda');
        //$juni =  Detail::where('tgl_kembali','like','%'.$enam.'%')->sum('denda');
        //$juli =  Detail::where('tgl_kembali','like','%'.$tujuh.'%')->sum('denda');
        //$agustus =  Detail::where('tgl_kembali','like','%'.$delapan.'%')->sum('denda');
        //$september =  Detail::where('tgl_kembali','like','%'.$sembilan.'%')->sum('denda');
        //$oktober =  Detail::where('tgl_kembali','like','%'.$sepuluh.'%')->sum('denda');
        //$november =  Detail::where('tgl_kembali','like','%'.$sebelas.'%')->sum('denda');
        //$desember =  Detail::where('tgl_kembali','like','%'.$duabelas.'%')->sum('denda');
        //$total = Detail::where('tgl_kembali','like','%'.$tahun.'%')->sum('denda');
        

        //BULAN JANUARI
        $januaris =  Detail::where('tgl_kembali','like','%'.$satu.'%')->get();
        $dendajanuari = 0;
        foreach($januaris as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendajanuari = $dendajanuari + $dendasementara;
        }

        //BULAN FEBRUARI
        $februaris =  Detail::where('tgl_kembali','like','%'.$dua.'%')->get();
        $dendafebruari = 0;
        foreach($februaris as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendafebruari = $dendafebruari + $dendasementara;
        }

        //BULAN MARET
        $marets =  Detail::where('tgl_kembali','like','%'.$tiga.'%')->get();
        $dendamaret = 0;
        foreach($marets as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendamaret = $dendamaret + $dendasementara;
        }

        //BULAN APRIL
        $aprils =  Detail::where('tgl_kembali','like','%'.$empat.'%')->get();
        $dendaapril = 0;
        foreach($aprils as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendaapril = $dendaapril + $dendasementara;
        }

        //BULAN MEI
        $meis =  Detail::where('tgl_kembali','like','%'.$lima.'%')->get();
        $dendamei = 0;
        foreach($meis as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendamei = $dendaapril + $dendasementara;
        }

        //BULAN JUNI
        $junis =  Detail::where('tgl_kembali','like','%'.$enam.'%')->get();
        $dendajuni = 0;
        foreach($junis as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendajuni = $dendajuni + $dendasementara;
        }
       
        //BULAN JULI
        $julis =  Detail::where('tgl_kembali','like','%'.$tujuh.'%')->get();
        $dendajuli = 0;
        foreach($julis as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendajuli = $dendajuli + $dendasementara;
        }

        //BULAN AGUSTUS
        $agustuss =  Detail::where('tgl_kembali','like','%'.$delapan.'%')->get();
        $dendaagustus = 0;
        foreach($agustuss as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendaagustus = $dendaagustus+ $dendasementara;
        }

        //BULAN SEPTEMBER
        $septembers =  Detail::where('tgl_kembali','like','%'.$sembilan.'%')->get();
        $dendaseptember = 0;
        foreach($septembers as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendaseptember = $dendaseptember + $dendasementara;
        }

        //BULAN OKTOBER
        $oktobers =  Detail::where('tgl_kembali','like','%'.$sepuluh.'%')->get();
        $dendaoktober = 0;
        foreach($oktobers as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendaoktober = $dendaoktober + $dendasementara;
        }

        //BULAN NOVEMBER
        $novembers =  Detail::where('tgl_kembali','like','%'.$sebelas.'%')->get();
        $dendanovember = 0;
        foreach($novembers as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendanovember = $dendanovember + $dendasementara;
        }

        //BULAN DESEMBER
        $desembers =  Detail::where('tgl_kembali','like','%'.$duabelas.'%')->get();
        $dendadesember = 0;
        foreach($desembers as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendadesember = $dendadesember + $dendasementara;
        }


        //TOTAL PER TAHUN
        $tahuns =  Detail::where('tgl_kembali','like','%'.$tahun.'%')->get();
        $dendatahun = 0;
        foreach($tahuns as $data){
            $borrow_date = $data->tgl_pinjam;
            $return_date = $data->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $dendatahun = $dendatahun + $dendasementara;
        }

        //return dd($dendatahun);

        
        
       
      
        //melempar variabel ke view folder report file graph_charge
        return View::make('report.graph_charge')
        
        ->with('total',$dendatahun) //variabel total denda
       
        ->with('januari',$dendajanuari) //variabel denda tiap tiap bulan
        ->with('februari',$dendafebruari)
        ->with('maret',$dendamaret)
        ->with('april',$dendaapril)
        ->with('mei',$dendamei)
        ->with('juni',$dendajuni)   
        ->with('juli',$dendajuli)
        ->with('agustus',$dendaagustus)
        ->with('september',$dendaseptember)
        ->with('oktober',$dendaoktober)
        ->with('november',$dendanovember)
        ->with('desember',$dendadesember)
        ->with('tahun',$tahun); //variabel tahun

        
    } 


    public function get_grafik_denda()
    {
        return View::make('report.grafik_denda');
    } 

    public function get_grafik()
    {
        
        return View::make('report.grafik');
    } 


	public function get_index()
    {
        $role = Auth::user()->role_id;
        if ($role == 3 ){
            return Redirect::to_route('restricted');
        }
       return Redirect::to_route('aktivitas');
    }    

	public function post_index()
    {

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