@layout('template.main')
@section('content')




<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar Anggota</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="members/new" class="btn btn-warning">
              <i class="icon-pencil icon-white"></i>&nbsp&nbspTambah Anggota</a> 
              <a align="right" data-toggle="modal" href="#myModal" class="btn btn-warning">
              <i class="icon-search icon-white"></i>&nbsp&nbspCari Anggota</a> 
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              <i>
              <?php
              $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
              $hari = $array_hari[date('N')];

              $array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
              $bulan = $array_bulan[date('n')];

              $tgl = date('j');
              $thn = date('Y'); 

              echo $hari.", ".$tgl." ".$bulan." ".$thn ;

              ?>  
           </th>
          
           </tr> 
         
         </thead>
            <tbody>
                 

                
             
            </tbody>
        </table>

        	@foreach($borrows->results as $borrow)
				@endforeach

				{{$borrow->book_id}}

        <h5 align="right">Riwayat Peminjaman </h5></i>
 

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
				<td>Alamat</td>
				<td>:</td>
				<td>{{$member->alamat}}</td>
				</tr>
				</table>

<p><b>Daftar Tanggungan Pinjaman</b></p>
<table class="table table-bordered table-striped table-hover">
           <thead>
           <tr>
           <th class="muted"></th>
           <th>ID Peminjaman</th>
           <th>ID Buku</th>
           <th>Judul Buku</th>
           <th>Tanggal Pinjam</th>
           <th>Status</th>  
           <th>Denda</th>
        
           <th class="muted" style="width: 80px;">Action</th>
           </tr>
           </thead>

           <tbody>
           
           <tr>
           <td></td> 
           <td>12</td>
           <td>27689</td>
           <td>5cm</td>
           <td>19-03-98</td> 
           <td>Pinjam</td>
          	<td>5000</td>
           <td></td>
           </tr>
           </tbody>
</table>

<?php $nilai = 1 ;
$cek = '';?>
@if ( $nilai == 1 )
     <?php $cek='disabled' ;
     $cek2='disabled'?>
@elseif ( $nilai == 2 )
    An error occurred.
    <?php $cek='halo bos ini opsi kedua' ;?>
@else
    Did it work?
    <?php $cek='halo mas ganteng ini opsi ketiga' ?>
@endif
<br>


<p><b>Silahkan Masukkan Buku yang akan dipinjam : </b></p>
{{Form::open('users/create','POST')}}


              <table>
                
              <tr>  
              <td>  
              Buku 1
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="nama"/><br /></td>
              <td>
              @if($errors->has('nama'))

              <div class="alert alert-error">
              {{$errors->first('nama', ':message')}}
              </div>  
              </td>
              @endif
              </tr>
              <tr>
              <td>
              Buku 2 </td>
              <td>  
              : 
              </td>
              <td>
                <input type="text" name="username" <?php echo $cek2;?>/>
                </td>
              <td>
              @if($errors->has('username'))

              <div class="alert alert-error">
              {{$errors->first('username', ':message')}}
              </div>  
              </td>
              @endif
              </tr>
              
              <tr>  
              <td>  
              Buku 3
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="nama" <?php echo $cek;?>/><br /></td>
              <td>
              @if($errors->has('nama'))

              <div class="alert alert-error">
              {{$errors->first('nama', ':message')}}
              </div>  
              </td>
              @endif
              </tr>
              </table>

              <table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <th align="center" class="btn-info" colspan="10">
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
              {{ Form::submit('&nbsp; &nbsp; Proses Pinjaman &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}
              
              </th>
          
          
              </tr>
              </thead>
              </table>

             <!-- <input type="submit" name="add_author" value="Create"/> -->

              
             {{Form::close()}}

             <table class="table table-bordered table-striped table-hover">

        <h3 align="center">Koleksi Buku</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="books/new" class="btn btn-warning">
              <i class="icon-pencil icon-white"></i>&nbsp&nbspTambah Buku</a> 
              <a align="right" data-toggle="modal" href="#myModal" class="btn btn-warning">
              <i class="icon-search icon-white"></i>&nbsp&nbspCari Buku</a> 
           </th>
          
           </tr> 
           <tr>
           <th>NIB</th>
           <th>Judul</th>
           <th>Tanggal Terima</th>
           <th>Pengarang</th>
           <th>Penerbit</th>
           <th>Sumber</th>
           <th>Halaman</th>
           <th>Ukuran</th>
           <th>Kategori</th>

           <th class="muted" style="width: 80px;">Action</th>
            </tr>
         </thead>
            <tbody>
            @foreach($books->results as $book)
                  <?php $cek_type= null; $hasil=''?>
                  <tr>

                  <td> {{$book->nib}} </td>
                  <td> {{$book->judul}} </td>
                  <td> {{$book->tgl_terima}} </td>
                  <td> {{$book->pengarang}} </td>
                  <td> {{$book->penerbit}} </td>
                  <td> {{$book->sumber}} </td>
                  <td> {{$book->jml_halaman}} </td>
                  <td> {{$book->ukuran}} </td>
                  <td> <?php $cek_type= $book->type_id ;
                  $kategori = $cek_type;
                  ?>
                  @if($kategori=1)
                      <?php echo $cek_type ?>

                  @endif
                  <!--
                  /*if ($kategori='1')
                  {
                  $hasil='Tipe 1';
                  }
                  else if ($kategori='2')
                  {
                  $hasil='Tipe 2';
                  }
                  else
                  {
                  echo "Bukan tipe 1 & 2";
                  }*/ -->
                                        
                  
                  
                  </td>
                  <td>  <a class="btn btn-info btn-small" href="books/edit/{{ $book->id }}"><i class="icon-edit icon-white"></i></a>
                  <a class="btn btn-danger btn-small" onclick="return confirm('Apakah anda yakin akan menghapus data buku dengan NIB {{ $book->id}} ?')" href="books/delete/{{ $book->id }}"><i class="icon-remove icon-white"></i></a></td>

                  </tr>

                  @endforeach
             
                
               
            </tbody>
        </table>

@endsection
