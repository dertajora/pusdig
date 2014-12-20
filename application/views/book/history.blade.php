@layout('template.book')
@section('head')

@endsection
@section('content')
<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Riwayat Peminjaman</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a href="/books" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Buku</a> 
            
           </th>
          
           </tr> 
         
         </thead>
            <tbody>
                  
                   
             
            </tbody>
        </table>

        
        @foreach($books->results as $book)
        @endforeach
        <p><b>DATA BUKU</b></p>
        <table>
        <tr>
        <td>NIB</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$book->id}}</td>
        </tr>

        <tr>
        <td>Judul</td>
        <td>: </td>
        <td>&nbsp&nbsp{{$book->judul}}</td>
        </tr>
        
        <tr>
        <td>Tanggal Terima&nbsp&nbsp</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$book->tgl_terima}}</td>
        </tr>
        <tr>
        <td>Pengarang</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$book->pengarang}}</td>
        </tr>
        <tr>
        <td>Penerbit</td>
        <td>:</td>
        <td>&nbsp
        	<?php $penerbit=$book->id_penerbit;
               $nama = DB::table('publishers')->where('id','=',$penerbit)->only('nama');
               echo $nama;
            ?></td>
        </tr>
        <tr>
        <td>Kategori</td>
        <td>:</td>
        <td>&nbsp@if($book->type_id==1)
                       <?php echo 'Fiksi'?>
                  @elseif ($book->type_id==2)
                      <?php echo 'Non Fiksi'?>
                  @elseif ($book->type_id==3)
                      <?php echo 'Pelajaran'?>
                  @elseif ($book->type_id==4)
                      <?php echo 'Pegangan Guru'?>
                  @elseif ($book->type_id==5)
                      <?php echo 'Referensi'?>
                  @endif
        </td>
        </tr>
       
        </table>
<br>

 <p><b>Tracking Peminjaman</b></p>
 		 <?php $cek=count($hasils);
           if ($cek > 0){
           echo "
           
		   <table class='table table-bordered table-striped table-hover'>
           <thead>
           <tr>
          
           <!--<th>ID Pinjam</th>
           <th>ID Detail</th>-->
           <th>ID Pinjam</th>
           <th>NIS</th>
           <th>Nama Peminjam</th>

           <th>Tanggal Pinjam</th>
           <th>Tanggal Kembali</th>
           <th>Status</th>
              
           </tr>
           </thead>
       		";} 
       		
       	   ?>
           <?php $pinjaman=count($hasils);
           if ($pinjaman == 0){
           		echo "<div class='alert alert-info'>
        			  <center><b>Buku ini belum pernah dipinjam sama sekali</b></center>
        			  </div>";
           }


           ?>	
           <tbody>
            
            @foreach($hasils as $hasil)
            
        <tr>
         
          <td>{{ $hasil->id_pinjam}}</td>
          <!--<td>{{ $hasil->id_detail }}</td> -->
          <td>{{ $hasil->member_id }}</td>
          <?php  
           ;

           $member=$hasil->member_id;
           
           $member = DB::table('members')->where('id','=',$member)->only('nama');
           
           ?>
          <td> <?php echo $member ;?> </td>
          <td>{{ $hasil->tgl_pinjam }}</td>
          <td> <?php $tgl_kembali = $hasil->tgl_kembali;
          if ($tgl_kembali == '0000-00-00'){
            echo 'Belum Kembali';
          } elseif ($tgl_kembali != '0000-00-00'){
            echo $tgl_kembali;
          }
          ?>
          </td>
          <?php $tes_status=$hasil->status;
          	$status_open='';
          	$status_close='';
          	if($tes_status== 'Kembali'){
          		$status_open="<font color='green'><b>";
          		$status_close="</b></font>";
          	} elseif ($tes_status== 'Perpanjang'){
          		$status_open="<font color='#33bafe'><b>";
          		$status_close="</b></font>";
          	}
          	elseif ($tes_status== 'Hilang'){
          		$status_open="<font color='red'><b>";
          		$status_close="</b></font>";
          	}
          ?>
          <?php $tes=$hasil->denda;
          	$fontopen='';
          	$fontclose='';
          	if($tes>0){
          		$fontopen="<font color='orange'><b>";
          		$fontclose="</b></font>";
          	}
          ?>
          <td><?php echo $status_open; ?>{{ $hasil->status }}<?php echo $status_close; ?></td>
         
               
        </tr>
    
      @endforeach
   
          

         </tbody>
</table>

        </center>


@endsection