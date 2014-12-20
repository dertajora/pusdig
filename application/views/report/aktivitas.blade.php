@layout('template.report')
@section('content')
<?php 
 function dateDiff($start, $end) {
         $start_ts = strtotime($start);
          $end_ts = strtotime($end);
          $diff = $end_ts - $start_ts;
          return round($diff / 86400);
          }

?>
<table class="table table-bordered table-striped table-hover">
<?php  
$tgl = date('j');
$thn = date('Y'); ?>
        <h3 align="center">Daftar Aktivitas Peminjaman</h3>  
        {{Form::open('reports/peminjaman_bulanan','POST',array('class' => 'form-search pull-left'))}}      
        
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="/reports/graph_borrow" class="btn btn-warning">
              <i class="icon-indent-right icon-white"></i>&nbsp&nbspGrafik Bulanan</a> 
            
              
              <button type="submit" class="btn btn-warning pull-right"><i class="icon-search icon-white"></i>&nbsp&nbsp<b>Lihat </b></button>

              <select name="bulan" class="pull-right">
                <option value="" disabled selected>Pilih Bulan...</option>
                <option value="<?php $var = "$thn-01-";echo $var;?>">Januari</option>
                <option value="<?php $var = "$thn-02-";echo $var;?>">Februari</option>
                <option value="<?php $var = "$thn-03-";echo $var;?>">Maret</option>
                <option value="<?php $var = "$thn-04-";echo $var;?>">April</option>
                <option value="<?php $var = "$thn-05-";echo $var;?>">Mei</option>
                <option value="<?php $var = "$thn-06-";echo $var;?>">Juni</option>
                <option value="<?php $var = "$thn-07-";echo $var;?>">Juli</option>
                <option value="<?php $var = "$thn-08-";echo $var;?>">Agustus</option>
                <option value="<?php $var = "$thn-09-";echo $var;?>">September</option>
                <option value="<?php $var = "$thn-10-";echo $var;?>">Oktober</option>
                <option value="<?php $var = "$thn-11-";echo $var;?>">November</option>
                <option value="<?php $var = "$thn-12-";echo $var;?>">Desember</option>
           
               </select> &nbsp&nbsp&nbsp
              {{Form::close()}}
              

              <?php
              $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
              $hari = $array_hari[date('N')];

              $array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
              $bulan = $array_bulan[date('n')];

              $tgl = date('j');
             

             

              ?> 
             
           </th>
          
       

           </tr> 
         </table>
 
        <?php echo "<h5 class='pull-left' align='right'> Total peminjaman buku bulan ini adalah <font color='green'><b>$total buku</b></font> </h5>";?>
        <?php if ($bulanfix == 0) {
          echo "
        <h5 align='right'> Rincian peminjaman bulan <font color='green'><b>$bulan $thn </b></font></h5>";}
        elseif ($bulanfix != 0){
           $bulanupdate = $array_bulan[$bulanfix];
           echo " <h5 class='pull-right' align='right'> Rincian peminjaman bulan <font color='green'><b>$bulanupdate $thn </b></font></h5>"; 
        } ?>

        <?php if ($total > 0) {
          echo " 
        <br><br>
           <p><b>DAFTAR PEMINJAMAN</b></p>
        <table class='table table-bordered table-striped table-hover'>
           <thead>
           <tr>
          
          <!-- <th>ID Pinjam</th>
           <th>ID Detail</th>-->
           <th>NIS Peminjam</th>
           <th>NIB</th>
           
           <th>Judul Buku</th>

           <th>Tanggal Pinjam</th>
           <th>Tanggal Kembali</th>
           <th>Status</th>
           <th>Denda</th>
          
        
           </tr>
           </thead>";} elseif ($total == 0) {
             echo "<br><br><br><div class='alert alert-info'>
                <center><b>Tidak ada aktivitas peminjaman buku pada bulan ini </b></center>
                </div>";
           }?>
            

           <tbody>
            
            @foreach($hasils->results as $hasil)
          
        <tr>
         
        
          <td>{{ $hasil->member_id }}</td>
          <td>{{ $hasil->book_id }}</td>
          
          <?php  
           
           $buku=$hasil->book_id;
           
           $judul = DB::table('books')->where('id','=',$buku)->only('judul');
           
           ?>
          <td> <?php echo $judul ;?> </td>
          
          <td> <?php $tanggal_data = $hasil->tgl_pinjam; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>
          <td> <?php $tgl_kembali = $hasil->tgl_kembali;
                  $status_buku = $hasil->status;
              if ($status_buku == 'Hilang'){
                 $pieces = explode("-", $tgl_kembali);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  echo " ( Lapor )";
              }
              elseif ($tgl_kembali == null){
                echo 'Belum Kembali';
              }
              elseif ($tgl_kembali != '0000-00-00'){
                $pieces = explode("-", $tgl_kembali);
                echo "$pieces[2] / $pieces[1] / $pieces[0]";
              }
              ?>
              </td>
          <?php 

            $denda = 0;    
            $borrow_date = $hasil->tgl_pinjam;
            $return_date = $hasil->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $denda = $denda + $dendasementara;
            
            $tes=$denda;
            $fontopen='';
            $fontclose='';
            if($tes>0){
              $fontopen="<font color='#ff0000'><b>";
              $fontclose="</b></font>";
            }
          ?>
           <?php 
                $tes_status = $hasil->status;
                if($tes_status =='Hilang'){
                  $status='Hilang';
                }
                 elseif ($tes_status == 'Perpanjang' ){
                  $status='Perpanjang';
                }
                  elseif ($tgl_kembali == null){
                 $status='Dipinjam';
                
                } elseif ($tgl_kembali != null){
                  $status='Kembali';
                }


                $status_open='';
                $status_close='';
                if ($tes_status== 'Hilang'){
                  $status_open="<font color='red'><b>";
                  $status_close="</b></font>";
                }
                elseif ($tes_status== 'Perpanjang'){
                  $status_open="<font color='#33bafe'><b>";
                  $status_close="</b></font>";
                }
                elseif($tgl_kembali != null){
                  $status_open="<font color='green'><b>";
                  $status_close="</b></font>";
                } 
                
              ?>
              
              <td><?php echo $status_open; ?>{{ $status }}<?php echo $status_close; ?>
          
         
          <td><?php echo $fontopen; ?>{{ $denda}}<?php echo $fontclose; ?></td>
       
          
          
        </tr>
        
    
      @endforeach
      

           </tbody>
</table>
 <center>
        <table>

        <tr>

        <!--to show the pagination field-->

        {{$hasils->links()}}

        </tr>

        </table>
        </center>
@endsection