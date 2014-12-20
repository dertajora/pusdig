@layout('template.transaction')
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

        <h3 align="center">Halaman Pengembalian</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="/transactions" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Peminjaman</a> 
              <a align="right" data-toggle="modal" href="/transactions/kembali" class="btn btn-warning">
              <i class="icon- icon-circle-arrow-left icon-white"></i>&nbsp&nbspPengembalian Baru</a> 
               
           </th>
          
           </tr> 
         
         </thead>
            <tbody>
                 

                
             
            </tbody>
        </table>

          

        <h5 align="right">Riwayat Peminjaman </h5></i>
 

                  <tr>

                  <td></td>
                  <td> </td>
        @foreach($members->results as $member)
        @endforeach
        <p><b>DATA ANGGOTA</b></p>
        <table>
        <tr>
        <td>NIS</td>
        <td>:</td>
        <td> {{$member->id}}</td>
        </tr>
        <tr>
        <td>Nama</td>
        <td>: </td>
        <td>{{$member->nama}}</td>
        </tr>

        <tr>
        <td>Kelas / Angkatan</td>
        <td>: </td>
        <?php $class=$member->class_id;
        $kelas = DB::table('class')->where('id','=',$class)->only('nama');
        ?>
        <td>{{$kelas}} / {{$member->angkatan}}</td>
        </tr>
        </table>
<br>
           <?php $pinjaman=count($hasils);
           if ($pinjaman == 0){
              echo "<div class='alert alert-info'>
                <center><b>Anggota ini tidak memiliki tanggungan pinjaman</b></center>
                </div>";
           }?>
           <?php $cek=count($hasils);
           if ($cek > 0){
           echo "
 <p><b>TANGGUNGAN PINJAMAN</b></p>
<table class='table table-bordered table-striped table-hover'>
           <thead>
           <tr>
          
           <!--<th>ID Pinjam</th>
           <th>ID Detail</th>-->
           <th>NIB</th>
           <th>Judul Buku</th>

           <th>Tanggal Pinjam</th>
           <th>Status</th>
           <th>Hari Terlambat</th>
           <th>Denda</th>
          
        
           <th class='muted' style='width: 200px;''>Opsi</th>
           <th class='muted'>Hilang</th>
           </tr>
           </thead>" ;}?>
           <?php $jumlah=0;?>  

           <tbody>
            
            @foreach($hasils as $hasil)
          
        <tr>
         
         <!-- <td>{{ $hasil->id_pinjam}}</td>
          <td>{{ $hasil->id_detail }}</td> -->
          <td>{{ $hasil->book_id }}</td>
          <?php  
           ;

           $buku=$hasil->book_id;
           
           $judul = DB::table('books')->where('id','=',$buku)->only('judul');
           
           ?>
          <td> <?php echo $judul ;?> </td>
          <td>
          <?php $tanggal_data = $hasil->tgl_pinjam; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>

          <td><?php $tgl_kembali=$hasil->tgl_kembali; 
              if($hasil->status=='Perpanjang'){
                $status = 'Perpanjang';
              }
              elseif($tgl_kembali == null){
                $status = 'Dipinjam';
              }
              ?>{{ $status }}</td>
          <td>
          <?php 
           $today = date("Y-m-d"); 
           $yesterday = $hasil->tgl_pinjam;
           //echo $yesterday;
           $selisih = datediff($yesterday,$today);
           $telat = $selisih-7;
           if ($telat < 0){ 
              $telat = 0;
           }
           echo $telat;
           $denda = $telat * 100;
           ?>
          </td>
          
         
          <td><?php echo $denda?></td>
          <td>
           <a class="tip btn btn-info btn-small" title="Kembalikan Pinjaman" data-placement="bottom" onclick="return confirm('Apakah anda yakin ingin melakukan pengembalian untuk peminjaman ini ?')" href="/transactions/return/{{ $hasil->id_detail }}">
           <i class="icon-edit icon-white" ></i>Kembali</a>
           
           <?php 
           $status=$hasil->status;
          
           if ($status != 'Perpanjang') 
           { echo 
           "<a class='tip btn btn-danger btn-small' title='Perpanjang Peminjaman' data-placement='bottom' onClick=\"return confirm('Anda yakin ingin melakukan perpanjangan untuk peminjaman ini ?')\" href='/transactions/extend/".$hasil->id_detail."'>
           <i class='icon-remove icon-white'></i>Perpanjang</a>";

          
            } elseif ($status == 'Perpanjang'){
              
            } ?> 
           </td>
            <td>
            <a class="tip btn btn-primary btn-small" title="Pinjaman Hilang" data-placement="bottom" onclick="return confirm('Apakah anda yakin ingin menganggap pinjaman ini hilang ?')" href="/transactions/lost/{{ $hasil->id_detail }}">
              <i class="icon-edit icon-white"></i>Hilang</a>
          </td>
          
        </tr>
    
      @endforeach
   
          

           </tbody>
</table>

<i><h5>NB : Maksimal Peminjaman adalah 7 hari, diluar itu dikenakan denda</h5> </i>
@endsection