@layout('template.user')


@section('content')


<center>
<table align="center" class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar Jabatan</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="/users" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar User</a> 
              
           </th>
          
           </tr> 
           <tr>
           <th rowspan="2">ID</th>
           <th rowspan="2">Jabatan</th>
           <th colspan="5"><center>&nbsp&nbsp&nbsp&nbsp&nbspKewenangan</center></th>
           <tr>
            <td width="300px"><center>Detail Tugas</center></td>
            <td>Manajemen Anggota</td>
            <td>Inventarisasi Buku</td>
            <td>Sirkulasi</td>
            <td>Laporan</td>
            <td>Manajemen User</td>
           
          

            </tr>
         </thead>
            <tbody>
              <tr>
               <td>1</td>
               <td>Administrator</td>
               <td>Pengelolaan Data dan Manajemen Pengguna</td>
               <td><i class="icon-ok icon-black"></i></td>
               <td><i class="icon-ok icon-black"></i></td>
               <td><i class="icon-remove icon-black"></i></td>
               <td><i class="icon-remove icon-black"></i></td>
               <td><i class="icon-ok icon-black"></i></td>
              </tr>
              <tr>
               <td>2</td>
               <td>Pustakawan</td>
               <td>Pengelolaan data anggota dan buku, serta pengaksesan laporan</td>
               <td><i class="icon-ok icon-black"></i></td>
               <td><i class="icon-ok icon-black"></i></td>
               <td><i class="icon-remove icon-black"></i></td>
               <td><i class="icon-ok icon-black"></i></td>
               <td><i class="icon-remove icon-black"></i></td>
              </tr>
               <tr>
               <td>3</td>
               <td>Operator</td>
               <td>Transaksi harian seperti peminjaman, pengembalian dan bebas pustaka</td>
               <td><i class="icon-remove icon-black"></i></td>
               <td><i class="icon-remove icon-black"></i></td>
               <td><i class="icon-ok icon-black"></i></td>
               <td><i class="icon-remove icon-black"></i></td>
               <td><i class="icon-remove icon-black"></i></td>
              </tr>
            </tbody>
        </table>
</center>
        
      
@endsection
