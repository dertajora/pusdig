@layout('template.transaction')
@section('content')

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 id="myModalLabel">Verifikasi Peminjaman</h4>

            </div>
            <div class="modal-body">
            <table>
            {{Form::open('transactions/cek_bebas','POST')}}
            <tr>  
                          <td>  
                    <b>Silahkan Masukkan NIS</b>              
                          </td>
                          <td>  
                          : 
                          </td>
                          <td><input type="text" name="id"/><br /></td>
                          <td>
                         
                        
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>
                          
                            </td>
                          </tr>
            </table>
            </div>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Close</button>
               {{ Form::submit('&nbsp; &nbsp; Cek Peminjaman &nbsp; &nbsp;', array('class' => 'btn btn-warning')) }}
              </form>
            </div>
          </div>
<?php

function dateDiff($start, $end) {

$start_ts = strtotime($start);

$end_ts = strtotime($end);

$diff = $end_ts - $start_ts;

return round($diff / 86400);

}


?>
  <table class="table table-bordered table-striped table-hover">

        <h3 align="center">Verifikasi Bebas Pustaka</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
            <a data-toggle="modal" href="/transactions/bebas_pustaka" class="btn btn-warning">
            <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Pemohon</a> 
            <a data-toggle="modal" href="#myModal" class="btn btn-warning">
            <i class="icon-ok icon-white"></i>&nbsp&nbspPemohon Baru</a> 
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
     

     
        <tr>
        <td>Tanggungan Pinjaman</td>
        <td>:</td>
        <td><?php $pinjaman=count($hasils);echo $pinjaman;?></td>
        </tr>
        </table>
<br>
<br>
<?php $cek=count($hasils);
           if ($cek > 0){
           echo "
 <p><b>TANGGUNGAN PINJAMAN</b></p>
<table class='table table-bordered table-striped table-hover'>
           <thead>
           <tr>
          
          <!-- <th>ID Pinjam</th>
           <th>ID Detail</th>-->
           <th>NIB</th>
           <th>Judul Buku</th>

           <th>Tanggal Pinjam</th>
           <th>Status</th>
          
          
        
           </tr>
           </thead>
            
           ";}?>
           <tbody>
            
            @foreach($hasils as $hasil)
          
        <tr>
         
        <!--  <td>{{ $hasil->id_pinjam}}</td>
          <td>{{ $hasil->id_detail }}</td>-->
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
          <td><?php $tgl_kembali=$hasil->tgl_kembali; 
              if($hasil->status=='Perpanjang'){
                $status = 'Perpanjang';
              }
              elseif($tgl_kembali == null){
                $status = 'Dipinjam';
              }
              ?>{{ $status }}</td>
          
        
          
        </tr>
        
    
      @endforeach
      

           </tbody>
</table>
 


 <table class="table table-bordered table-striped table-hover">
   
<?php 
if ($pinjaman == 0){
     
              echo "<thead>";
              echo "<tr>";
              echo "<th align='center' class='btn-info' colspan='10'>";
            
             echo  "<center> Anggota memenuhi persyaratan bebas pustaka &nbsp&nbsp&nbsp <a class='btn btn-success'  
               onClick=\"return confirm('Apakah anda yakin ingin meloloskan permohonan bebas pustaka untuk anggota dengan NIS  $member->id ?')\" 
               href='/transactions/proses_bebas/".$member->id."'>
               <i class='icon-ok-sign icon-white'></i>&nbsp &nbspProses Bebas</a>";

             
              echo "</center>";
              } 
else {
    echo "<th align='center' class='btn-danger' colspan='10'>";
    echo "<center>";
    echo "Maaf, anggota belum memenuhi syarat untuk pemberian kartu bebas pustaka";
    echo "</th>";
    


}
?>
</table>
</center>

<i><h5>NB : Setelah bebas pustaka diberikan, anggota tidak dapat melakukan peminjaman kembali</h5> </i>
@endsection