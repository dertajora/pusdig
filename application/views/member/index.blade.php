@layout('template.member')


@section('content')





<!--<p> {{HTML::link_to_route('new_member', 'Tambah Anggota')}} </p>-->



<table class="table table-bordered table-striped table-hover">
             
              
                 
         
         {{Form::open('members/search','POST',array('class' => 'form-search pull-left'))}}    
        <h3 align="center">Daftar Anggota</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="members/new" class="pull-left btn btn-warning">
              <i class="icon-plus-sign icon-white"></i>&nbsp&nbspTambah Anggota</a> 

              
                  &nbsp&nbsp<input type="text" name="keyword"  placeholder="Masukkan Nama/NIM..." class="input-medium search-query" autofocus>
                  <button type="submit" class="btn btn-warning"><i class="icon-search icon-white"></i>&nbsp&nbsp<b>Search</b></button>
              {{Form::close()}}
        </thead>     
           </th>
          
           </tr> 
         </table>
         <table class="table table-bordered table-striped table-hover tablesorter">
          <thead>
           <tr>
            <th>NIS</th>
           <th>Nama</th>
           <th>Kelas</th>
           
           <th>Angkatan</th>
           <th>Kelamin</th>
           <th>Tempat Lahir</th>
           <th>Tanggal Lahir</th>
           <th>Alamat</th>
           <th>Status</th>
        

           <th class="muted" style="width: 120px;">Opsi</th>
            </tr>
         </thead>
            <tbody>
                  @foreach($members->results as $member)

                  <tr>
                  <td> {{$member->id}} </td>  
                  
                  <?php $id_member = $member->id;
                  
                  $hasils = DB::
                    query('select member_id,borrows.id as id_pinjam,
                    borrow_details.id as id_detail  from 
                    borrow_details left join borrows on borrow_details.borrow_id = borrows.id
                    where member_id="'.$id_member.'" && tgl_kembali is null');  
                  $cek_pinjaman=count($hasils);
                  
                  ?>
                  
                  <td> {{$member->nama}} </td>
                  <td> <?php $class=$member->class_id;

                        $kelas = DB::table('class')->where('id','=',$class)->only('nama');
                        echo $kelas;
                        ?>
                  </td>
                  <td> {{$member->angkatan}} </td>
                  <td> {{$member->kelamin}} </td>
                  <td> {{$member->tempat_lahir}} </td>
                  <td> <?php $tanggal_data = $member->tgl_lahir; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>
                  <td> {{$member->alamat}} </td>
                  <td> {{$member->status}} </td>
                 

                  <td>  <a class="tip btn btn-info btn-small" title="Ubah Data" data-placement="bottom" href="members/edit/{{ $member->id }}"><i class="icon-edit icon-white "></i></a>
                  <?php if($cek_pinjaman==0){
                    echo "<a class='tip btn btn-danger btn-small' title='Hapus Data' data-placement='bottom' onclick=\"return confirm('Apakah anda yakin akan menghapus data anggota dengan nama ".$member->nama." ? Apabila data anggota dihapus, maka riwayat peminjaman anggota juga akan ikut terhapus.')\" href='members/delete/".$member->id."'><i class='icon-trash icon-white'></i></a>";

                  }elseif ($cek_pinjaman>0) {
                      echo "<a class='tip btn btn-danger btn-small' title='Hapus Data' data-placement='bottom' onclick=\"return confirm('Anggota dengan nama ".$member->nama." sedang melakukan peminjaman, apabila data tetap dihapus maka data peminjaman dan riwayat peminjaman juga ikut terhapus. Lanjutkan proses penghapusan ?')\" href='members/delete/".$member->id."'><i class='icon-trash icon-white'></i></a>";
                  } ?>
                  
                 
                  
                  <a class="tip btn btn-success btn-small" title="Cetak Kartu" data-placement="bottom" href="members/cetak/{{ $member->id }}"><i class="icon-print icon-white"></i></a>
                 


                  </td>

                  </tr>

                  @endforeach
                   
             
            </tbody>
        </table>

        <center>
        <table>

        <tr>

        <!--to show the pagination field-->

        {{$members->links()}}
       

        </tr>

        </table>
        </center>
        <script type="text/javascript">
        $(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
    
        </script>

@endsection
