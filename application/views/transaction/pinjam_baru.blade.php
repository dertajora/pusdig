@layout('template.transaction')
@section('content')




<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Halaman Peminjaman</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="/transactions" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Peminjaman</a> 
              
           </th>
          
           </tr> 
         
         </thead>
            <tbody>
                 

                
             
            </tbody>
        </table>


                  <tr>

                  <td></td>
                  <td> </td>
				@foreach($members->results as $member)
				@endforeach
				<p><b>Data Anggota</b></p>
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

<?php $cek=count($hasils);
           if ($cek > 0){
           echo "
<table class='table table-bordered table-striped table-hover'>
           <thead>
           <tr>
           
           <!--<th>ID Pinjam</th>
           <th>ID Detail</th>-->
           <th>NIB</th>
           <th>Judul Buku</th>           
           <th>Tanggal Pinjam</th>
           <th>Status</th>
           
          
        
          
           </tr>
           </thead>
           ";}?>
           <?php $jumlah=0;?>  

           <tbody>
            
            @foreach($hasils as $hasil)
          
        <tr>
          
          <!--<td>{{ $hasil->id_pinjam}}</td>
          <td>{{ $hasil->id_detail }}</td>-->
          <td>{{ $hasil->book_id }}</td>
          <?php  
           
           $buku=$hasil->book_id;
           
           $judul = DB::table('books')->where('id','=',$buku)->only('judul');
           
           ?>
          <td><?php echo $judul?></td>
          
          <td> <?php $tanggal_data = $hasil->tgl_pinjam; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>
          <?php $tes_status = $hasil->status;
               $tgl_kembali=$hasil->tgl_kembali;
                if ($tes_status == 'Perpanjang' ){
                  $status='Perpanjang';}
                elseif ($tgl_kembali == null){
                 $status="<font color='green'><b>Dipinjam</b></font>";
                }
                ?>
          <td>{{ $status }}</td>
          <?php $jumlah=$jumlah+1?>
          
          
        </tr>
    
      @endforeach
   
          

           </tbody>
</table>

<?php 
$kolom1  = '';
$kolom2  = '';
$kolom3  = '';
?>
@if ( $jumlah == 0)
    <?php
 
	?>
@elseif ( $jumlah == 1 )
     <?php $kolom3='disabled' ;
     $cek2='disabled'?>
@elseif ( $jumlah == 2 )
    <?php $kolom2='disabled' ;
    $kolom3='disabled';
    ?>
@elseif ( $jumlah >= 3 )
    <?php
    $kolom1='disabled';
    $kolom2='disabled' ;
    $kolom3='disabled';

    ?>
@endif

<center>
<p><b>Silahkan Masukkan NIB Buku yang akan dipinjam : </b></p>
{{Form::open('transactions/proses_pinjam','POST',array('data-validate' => 'parsley'))}}


              <table class="table table-bordered table-striped table-hover">
              <tr> 
              <th style="width: 40px;"><b><center>Data</center></b>
              </th>
              
              <th style="width: 100px;"><b><center>NIB Buku</center></b>
              </th>
              <th style="width: 250px;"><b><center>Judul</center></b></th>
              <th style="width: 150px;"><b><center>Status</center></b></th>
              </tr>  
              <tr>  
              <td>  
              Buku 1
              </td>
             
              <td><center><input class="input-xlarge" type="text" id="search" name="buku1" <?php echo $kolom1;?> autofocus/></center></td>
              <td><center><h5><ul id="results"></ul></center></h5></td>
              <td><center><ul id="resultslima"></ul></center></td>
              </tr>
              <tr>
              <td>
              Buku 2 </td>
              
              <td>
                <center><input class="input-xlarge" type="text" id="searchsatu" name="buku2" <?php echo $kolom2;?>/></center>
                </td>
               
                <td>
                <center><h5><ul id="resultssatu"></ul></h5></center/>
                </td>
                <td><center><h5><ul id="resultsenam"></ul></h5></center></td>
              
              </tr>
              
              <tr>  
              <td>  
              Buku 3
              </td>
            
              <td><center><input class="input-xlarge" type="text" id= "searchdua" name="buku3" <?php echo $kolom3;?>/></center></td>
              <td><center>
              <h5><ul id="resultsdua"></ul><h5></center></td>
              <td><center><h5><ul id="resultstujuh"></ul></h5></center></td></tr>
              
              
              </tr>
              <tr>  
              <?php $peminjam=$member->id ;?>

              <input type="hidden" value="{{ $peminjam }}" name="member_id"/>
              
              </table>
              </tr>

              <table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <?php if ($pinjaman <3){ echo "
              <th align='center' class='btn-info' colspan='10'>
              <center>"?>
              {{ Form::submit('&nbsp; &nbsp; Proses Pinjaman &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}<?php echo "
              </center>
              </th> ";}
              elseif ($pinjaman >= 3){
                echo "<th align='center' class='btn-danger' colspan='10'>";
                echo "<center>";
                echo "Maaf, anggota belum memenuhi syarat untuk melakukan peminjaman buku";
                echo "</center></th>";
              }

              ?>
          
          
              </tr>
              </thead>
              </table>

             <!-- <input type="submit" name="add_author" value="Create"/> -->

              
             {{Form::close()}}

            

       
             
                
               
            </tbody>
        </table>
        
</center>


@endsection

