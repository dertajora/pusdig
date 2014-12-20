@layout('template.main')
@section('content')

<h3 align="center">Peminjaman</h3> 



<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="9">
              
              <a data-toggle="modal" href="/books" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspPeminjaman Baru</a>  
              
              </i>
           </th>
          
          
          
            </tr>
         </thead>
</table>


<i>
  <h5 align="right">Riwayat Peminjaman </h5></i>
 

                  <tr>

                  <td></td>
                  <td> </td>

<p><b>Data Anggota</b></p>
<table>
<tr>
<td>
NIS 
</td>
<td>:</td>

<td></td>
</tr>
<tr>
<td>
Nama 
</td>
<td>: </td>

<td>Derta Isyajora</td>
</tr>

<tr>
<td>
Alamat
</td>
<td>:</td>

<td>Pemalang</td>
</tr>
</table>

<br>

<p><b>Daftar Tanggungan Pinjaman</b></p>
<table class="table table-bordered table-striped table-hover">
           <thead>
           <tr>
           <th class="muted"></th>
           <th>ID Detail</th>
           
           <th>ID Peminjaman</th>
           <th>ID Buku</th>
           
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



Ini adalah tampilan peminjaman
<br>
ada riwayat peminjaman
<br>
kemudian ada 3 form kosong, yang digunakan untuk memasukkan buku yang akan dipinjam, ketika peminjaman 2 buku, maka form yang aktif hanya 1, ketika peminjaman hanya ada 2 ,maka form yang aktif hanya 1, ketika peminjaman ada 3, maka form tidak ada yang aktif dan tidak bisa meminjam. Jika tidak ada peminjaman maka form akan aktif semua.

Bisa menggunakan fasilitas form disabled , yang diaktifkan menggunakan disabled.


@endsection
