@layout('template.member')
@section('head')

@endsection

@section('content')





<!--<p> {{HTML::link_to_route('new_member', 'Tambah Anggota')}} </p>-->



<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Riwayat Peminjaman</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="/members" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Anggota</a> 
            
           </th>
          
           </tr> 
         
         </thead>
            <tbody>
                  
                   
             
            </tbody>
        </table>

        
        @foreach($members->results as $member)
        @endforeach
        <p><b>DATA ANGGOTA</b></p>
        <table>
        <tr>
        <td>NIS</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$member->id}}</td>
        </tr>

        <tr>
        <td>Nama</td>
        <td>: </td>
        <td>&nbsp&nbsp{{$member->nama}}</td>
        </tr>
        <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>&nbsp&nbsp<?php $tes = $member->kelamin;
        if ($tes=='L'){
        	echo 'Laki-laki';
        } elseif ($tes=='P'){
        	echo 'Perempuan';
        }

        ?></td>
        </tr>
        <tr>
        <td>Tempat , tanggal Lahir&nbsp</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$member->tempat_lahir}}, {{$member->tgl_lahir}}</td>
        </tr>
        <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$member->alamat}}</td>
        </tr>
        <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$member->status}}</td>
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
           <th>NIB</th>
           <th>Judul Buku</th>

           <th>Tanggal Pinjam</th>
           <th>Tanggal Kembali</th>
           <th>Status</th>
           <th>Denda</th>
          
        
           
           </tr>
           </thead>
           ";} ?>
           <?php $pinjaman=count($hasils);
           if ($pinjaman == 0){
           		echo "<div class='alert alert-info'>
        			  <center><b>Anggota ini belum pernah melakukan peminjaman</b></center>
        			  </div>";
           }


           ?>	
           <tbody>
            
            @foreach($hasils as $hasil)
          
        <tr>
         
          <td>{{ $hasil->id_pinjam}}</td>
          <!--<td>{{ $hasil->id_detail }}</td> -->
          <td>{{ $hasil->book_id }}</td>
          <?php  
           ;

           $buku=$hasil->book_id;
           
           $judul = DB::table('books')->where('id','=',$buku)->only('judul');
           
           ?>
          <td> <?php echo $judul ;?> </td>
          <td>{{ $hasil->tgl_pinjam }}</td>
          <td>
          <?php $tgl_kembali = $hasil->tgl_kembali;
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
          <td><?php echo $fontopen; ?>{{ $hasil->denda}}<?php echo $fontclose; ?></td>          
        </tr>
    
      @endforeach
   
          

           </tbody>
</table>

        </center>


@endsection
