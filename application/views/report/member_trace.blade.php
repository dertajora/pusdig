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

        <h3 align="center">Daftar Riwayat Peminjaman Anggota </h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
             <a href="/reports/riwayat_anggota" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspCari Riwayat Lagi</a>
           </th>
        </table>


         @foreach($datas->results as $data)
        @endforeach
        <p><b>DATA ANGGOTA</b></p>
        <table>
        <tr>
        <td>NIS</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$data->id}}</td>
        </tr>

        <tr>
        <td>Nama</td>
        <td>: </td>
        <td>&nbsp&nbsp{{$data->nama}}</td>
        </tr>
         <tr>
        <td>Kelas / Angkatan</td>
        <td>: </td>
        <?php $class=$data->class_id;
        $kelas = DB::table('class')->where('id','=',$class)->only('nama');
        ?>
        <td>&nbsp&nbsp{{$kelas}} / {{$data->angkatan}}</td>
        </tr>
        <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>&nbsp&nbsp<?php $tes = $data->kelamin;
        if ($tes=='L'){
        	echo 'Laki-laki';
        } elseif ($tes=='P'){
        	echo 'Perempuan';
        }

        ?></td>
        </tr>
        <tr>
        <td>Tempat , Tanggal Lahir&nbsp</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$data->tempat_lahir}}, {{$data->tgl_lahir}}</td>
        </tr>
        <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$data->alamat}}</td>
        </tr>
        <tr>
        <td>Status</td>
        <td>:</td>
        <?php if
        ($data->status == 'Aktif'){
            echo "<td>&nbsp&nbspAktif</td>";
        } elseif ($data->status == 'Bebas') {
          echo "<td><font color='green'><b>&nbsp&nbspAnggota telah terdaftar sebagai bebas pustaka</b></font></td>";
        } ?>
        </tr>
        </table>
<br>
<?php
           if ($jumlah > 0){
           echo "
 <p><b>RIWAYAT PEMINJAMAN</b></p>
         
           
        <table class='table table-bordered table-striped table-hover'> 
           </tr> 
           <tr>
           <th>Tanggal Pinjam</th>
           <th>Tanggal Kembali</th>
           <th>NIB Buku yang Dipinjam</th>
           <th>Judul Buku</th>
           
           <th>Status</th>
           <th>Denda</th>
           
            </tr>
         </thead>
         " ; } elseif ($jumlah == 0){
         		echo "<div class='alert alert-info'>
        			  <center><b>Anggota ini belum pernah melakukan peminjaman sama sekali</b></center>
        			  </div>";	
         	}
         ?>
           
            <tbody>
            @foreach($borrows->results as $borrow)
                  
                  <tr>
                   
                  <td> <?php $tanggal_data = $borrow->tgl_pinjam; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>
                  <td> <?php $tgl_kembali = $borrow->tgl_kembali;
                  $status_buku = $borrow->status;
		          if ($status_buku == 'Hilang'){
		             $pieces = explode("-", $tgl_kembali);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  echo " ( Lapor )";
		          }
              elseif ($tgl_kembali == ''){
                echo 'Belum Kembali';
              } 
		          elseif ($tgl_kembali != '0000-00-00'){
		            $pieces = explode("-", $tgl_kembali);
                echo "$pieces[2] / $pieces[1] / $pieces[0]";
		          }
		          ?>
		          </td>
                 
                  <td>{{$borrow->book_id}}</td>
                  <td>
                  <?php $book_id=$borrow->book_id;

                        $judul = DB::table('books')->where('id','=',$book_id)->only('judul');
                        echo $judul;
                        ?>
                  </td>
                 
               
                  <?php 
                  $tes_status = $borrow->status;
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
		          
		          <td><?php echo $status_open; ?>{{ $status }}<?php echo $status_close; ?>
		           <?php 
                $denda = 0;    
                $borrow_date = $borrow->tgl_pinjam;
                $return_date = $borrow->tgl_kembali;
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
		          		$fontopen="<font color='orange'><b>";
		          		$fontclose="</b></font>";
		          	}
		          ?>
		          <td><?php echo $fontopen; ?>{{ $denda}}<?php echo $fontclose; ?></td>   	
		          </td>
		         
                  
                 
                  </tr>

                  @endforeach
             
                
               
            </tbody>
        </table>
         <center>
    
        <table>

        <tr>

        <!--to show the pagination field-->

        {{$borrows->links()}}

        </tr>

        </table>
        </center>
@endsection