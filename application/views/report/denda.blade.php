@layout('template.report')
@section('content')
<?php 

?>

<?php

$tgl = date('j');
$thn = date('Y');

?>

	<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Rincian Perolehan Denda Tahun <?php echo $thn;?></h3>  
        {{Form::open('reports/denda_bulanan','POST',array('class' => 'form-search pull-left'))}}      
        
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="/reports/graph_charge" class="btn btn-warning">
              <i class="icon-indent-right icon-white"></i>&nbsp&nbspGrafik Bulanan</a> 
              
               <button type="submit" class="btn btn-warning pull-right"><i class="icon-search icon-white"></i>&nbsp&nbsp<b>Lihat Rincian</b></button>

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
              
               

             

              ?>  
           </th>
          
           </tr> 
         
         </thead>
            <tbody>
                 

                
             
            </tbody>
        </table>
        	
        <?php echo "<h5 class='pull-left' align='right'> Total denda bulan ini adalah <font color='green'><b>$dendabulanan rupiah</b></font> </h5>";?>
        <?php if ($bulanfix == 0) {
          echo "
        <h5 align='right'> Rincian denda bulan <font color='green'><b>$bulan $thn </b></font></h5>";}
        elseif ($bulanfix != 0){
           $bulanupdate = $array_bulan[$bulanfix];
           echo " <h5 class='pull-right' align='right'> Rincian denda bulan <font color='green'><b>$bulanupdate $thn </b></font></h5>"; 
        } ?>
        
        
        

                  
				<?php if ($cek_denda > 0) {
          echo " 
          <br><br>
           <p><b>PEMINJAMAN DENGAN DENDA</b></p>
          <table class='table table-bordered table-striped table-hover'>
           <thead>
           <tr>
          
           <!--<th>ID Pinjam</th>
           <th>ID Detail</th>-->
           <th>NIS Peminjam</th>
           <th>ID Buku</th>
           <th>Judul Buku</th>

           <th>Tanggal Pinjam</th>
           <th>Tanggal Kembali</th>
           <th>Status</th>
           
           <th>Denda</th>
          
        
           </tr>
           </thead>
          ";} elseif ($cek_denda == 0){
            echo "<br><br><br><div class='alert alert-info'>
                <center><b>Tidak ada peminjaman pada bulan ini yang dikenai denda</b></center>
                </div>";
            }?>

           
           <tbody>
            
            @foreach($hasils as $hasil)
          
        <tr>
         
          <?php 

            $member_id = $hasil->member_id;
            $book_id = $hasil->book_id;
            
            $tanggal_data = $hasil->tgl_pinjam;        
            $pieces = explode("-", $tanggal_data);
            $tgl_pinjam = "$pieces[2] / $pieces[1] / $pieces[0]";
            $tes_status = $hasil->status;
            if ($tes_status=='Hilang'){
              $tanggal_data = $hasil->tgl_kembali; 
               $pieces = explode("-", $tanggal_data);
               $tgl_kembali = "$pieces[2] / $pieces[1] / $pieces[0] ( Lapor )";    
            }else{
            $tanggal_data = $hasil->tgl_kembali; 
            $pieces = explode("-", $tanggal_data);
            $tgl_kembali = "$pieces[2] / $pieces[1] / $pieces[0]";
            }
                if($tes_status =='Hilang'){
                  $status="<font color='#ff0000'><b>Hilang</b></font>";
                }
                elseif ($tgl_kembali == null){
                 $status="<font color='green'><b>Dipinjam</b></font>";
                } elseif ($tes_status == 'Perpanjang' ){
                  $status='Perpanjang';
                } elseif ($tgl_kembali != null){
                  $status="<font color='green'><b>Kembali</b></font>";
                }
            $buku=$hasil->book_id;
           
            $judul = DB::table('books')->where('id','=',$buku)->only('judul');
            
            $borrow_date = $hasil->tgl_pinjam;
            $return_date = $hasil->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;

            $tes=$dendasementara;
          

           if ($dendasementara > 0){
            echo '<td>'.$member_id.'</td>';
            echo '<td>'.$book_id.'</td>';
            echo '<td>'.$judul.'</td>';
            echo '<td>'.$tgl_pinjam.'</td>';
            echo '<td>'.$tgl_kembali.'</td>';
            echo '<td>'.$status.'</td>';
            echo '<td>'.$dendasementara.'</td>';
           }
           ?>
          
          
         
          
        </tr>
        
    
      @endforeach
      

           </tbody>
</table>


<i> </i>
@endsection