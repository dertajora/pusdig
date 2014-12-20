@layout('template.report')
@section('content')



<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar Riwayat Peminjaman Buku </h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
             <a href="/reports/riwayat_buku" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspCari Riwayat Lagi</a>
           </th>
        </table>


         @foreach($datas->results as $data)
        @endforeach
        <p><b>DATA BUKU</b></p>
        <table>
        <tr>
        <td>NIB</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$data->id}}</td>
        </tr>

        <tr>
        <td>Judul</td>
        <td>: </td>
        <td>&nbsp&nbsp{{$data->judul}}</td>
        </tr>
        
        <tr>
        <td>Tanggal Terima&nbsp&nbsp</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$data->tgl_terima}}</td>
        </tr>
        <tr>
        <td>Pengarang</td>
        <td>:</td>
        <td>&nbsp&nbsp{{$data->pengarang}}</td>
        </tr>
        <tr>
        <td>Penerbit</td>
        <td>:</td>
        <td>&nbsp
        	<?php $penerbit=$data->publisher_id;
               $nama = DB::table('publishers')->where('id','=',$penerbit)->only('nama');
               echo $nama;
            ?></td>
        </tr>
        <tr>
        <td>Kategori</td>
        <td>:</td>
        <td>&nbsp@if($data->type_id==1)
                       <?php echo 'Fiksi'?>
                  @elseif ($data->type_id==2)
                      <?php echo 'Non Fiksi'?>
                  @elseif ($data->type_id==3)
                      <?php echo 'Referensi'?>
                  @elseif ($data->type_id==4)
                      <?php echo 'Pegangan Guru'?>
                  @elseif ($data->type_id==5)
                      <?php echo 'Buku Pelajaran'?>
                  @endif
        </td>
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
           <th>NIS Peminjam</th>
           <th>Nama Peminjam</th>
           
           <th>Status</th>
        
           
            </tr>
         </thead>
         " ; } elseif ($jumlah == 0){
         		echo "<div class='alert alert-info'>
        			  <center><b>Buku ini belum pernah dipinjam sama sekali</b></center>
        			  </div>";	
         	}
         ?>
           
            <tbody>
            @foreach($books->results as $book)
                  
                  <tr>
                  
                  <td> <?php $tanggal_data = $book->tgl_pinjam; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>
                  <td> <?php $tgl_kembali = $book->tgl_kembali;
                  $status_buku = $book->status;
		          if ($status_buku == 'Hilang'){
		            
                 $pieces = explode("-", $tgl_kembali);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  echo " ( Lapor )";
		          } elseif ($tgl_kembali == ''){
		            echo 'Belum Kembali';
		          }
		          elseif ($tgl_kembali != '0000-00-00'){
		            $pieces = explode("-", $tgl_kembali);
                echo "$pieces[2] / $pieces[1] / $pieces[0]";
		          }
		          ?>
		          </td>
                 
                  <td>{{$book->member_id}}</td>
                  <td>
                  <?php $member_id=$book->member_id;

                        $nama = DB::table('members')->where('id','=',$member_id)->only('nama');
                        echo $nama;
                        ?>
                  </td>
                 
               
                  <?php $tes_status=$book->status;
                  $tes_status = $book->status;
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
		          	if($status== 'Kembali'){
		          		$status_open="<font color='green'><b>";
		          		$status_close="</b></font>";
		          	} elseif ($status== 'Perpanjang'){
		          		$status_open="<font color='#33bafe'><b>";
		          		$status_close="</b></font>";
		          	}
		          	elseif ($status== 'Hilang'){
		          		$status_open="<font color='red'><b>";
		          		$status_close="</b></font>";
		          	}
		          ?>
		          
		          <td><?php echo $status_open; ?>{{ $status }}<?php echo $status_close; ?>
		          </td>
		         
                  
                 
                  </tr>

                  @endforeach
             
                
               
            </tbody>
        </table>
         <center>
        <table>

        <tr>

        <!--to show the pagination field-->

        {{$books->links()}}

        </tr>

        </table>
        </center>
@endsection