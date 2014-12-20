@layout('template.book')

@section('head')
<script type="text/javascript">
$(function() {
    $('.pagination li:last-child').addClass('someClass');
});
</script>
@endsection
@section('content')


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 id="myModalLabel">Cari Koleksi</h4>

            </div>
            <div class="modal-body">
              {{Form::open('books/cari','POST')}}
              <center>
              <table>
                
              <tr>  
              <td>  
              Keyword
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="keyword"/><br /></td></tr>
              <tr>
              <td>
              Cari Berdasar </td>
              <td>  
              : 
              </td>
              <td>
                <label class="radio">
                <input type="radio" name="key" id="optionsRadios1" value="judul" checked>Judul
              </label>
                <label class="radio">
                <input type="radio" name="key" id="optionsRadios1" value="pengarang">Pengarang
                </label>
                <label class="radio">
                <input type="radio" name="key" id="optionsRadios1" value="nib">
                NIB
                </label>
                <label class="radio">
                <input type="radio" name="key" id="optionsRadios1" value="penerbit">Penerbit
                </label>
                <label class="radio">
                <input type="radio" name="key" id="optionsRadios1" value="kelas">Kelas
                </label>
              </td>
              <td></td>
               </tr>
               <tr> 
                <td>Ditampilkan</td>
                <td>:</td>
                <Td>
                <select name="jumlah">
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
           
                </select></td>  
                <td>Buku perhalaman</td>
              </td>
              </tr>
            </table>
         
              </center>
              
            </div>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Batal</button>
              {{ Form::submit('&nbsp; &nbsp; Cari &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}
             {{ Form::close(); }}
            </div>
          </div>
<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Hasil Pencarian</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="12">
              <a data-toggle="modal" href="/books" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Buku</a> 
              <a align="right" data-toggle="modal" href="#myModal" class="btn btn-warning">
              <i class="icon-search icon-white"></i>&nbsp&nbspPencarian</a> 
           </th>
          <?php if ($jumlah > 0) { echo "  
           </tr> 
           <tr>
           <th>NIB</th>
           <th>Judul</th>
           <th>Tanggal Terima</th>
           <th>Pengarang</th>
           <th>Penerbit</th>
           <th>Kategori</th>
           <th>Kelas</th>
           <th>DDC</th>
           <th>Sumber</th>
           <th>Halaman</th>
           <th>Ukuran</th>
           <th class='muted' style='width: 120px;''>Opsi</th>
            </tr>
         </thead>";}
         ?><?php if ($jumlah == 0 ){
          echo "<div class='alert alert-info'>
                <center><b>Tidak ada buku yang cocok dengan kategori pencarian dan keyword</b></center>
                </div>";
         } ?>
            <tbody>
            @foreach($books->results as $book)
                  <tr>

                  <td> {{$book->id}} </td>
                   <?php $id_book = $book->id;
                  
                  $hasils = DB::
                    query('select member_id,borrows.id as id_pinjam,
                    borrow_details.id as id_detail  from 
                    borrow_details left join borrows on borrow_details.borrow_id = borrows.id
                    where book_id="'.$id_book.'" && tgl_kembali is null');  
                  $cek_pinjaman=count($hasils);
                  
                  ?>
                  <td> {{$book->judul}} </td>
                  
                  <td> <?php $tanggal_data = $book->tgl_terima; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>
                  <td> {{$book->pengarang}} </td>
                  <td><?php $penerbit=$book->publisher_id;

                        $nama = DB::table('publishers')->where('id','=',$penerbit)->only('nama');
                        echo $nama;
                        ?>
                  </td>
                  <td> 
                  @if($book->type_id==1)
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
                  <td> <Center><?php $kelas=$book->kelas ;
                       if ($kelas != 0){
                          echo $kelas;
                       } else {
                          echo "-";
                       }
                  ?> </center></td>
                  <td> <Center>
                       <?php $ddc=$book->ddc ;
                       if ($ddc != null){
                          echo $ddc;
                       } else {
                          echo "-";
                       } ?>
                     </center>
                  </td>
                  <td> {{$book->sumber}}  </td>
                  <td> {{$book->jml_halaman}}  </td>
                  <td> {{$book->ukuran}}  </td>
                  <td>  <a class="btn btn-info btn-small" href="/books/edit/{{ $book->id }}"><i class="icon-edit icon-white"></i></a>
                  <?php if($cek_pinjaman==0){
                    echo "<a class='tip btn btn-danger btn-small' title='Hapus Data' data-placement='bottom' onclick=\"return confirm('Apakah anda yakin akan menghapus data buku dengan NIB ".$book->id." ? Apabila data buku dihapus, maka riwayat peminjaman buku juga akan ikut terhapus.')\" href='/books/delete/".$book->id."'><i class='icon-trash icon-white'></i></a>";

                  }elseif ($cek_pinjaman>0) {
                      echo "<a class='tip btn btn-danger btn-small' title='Hapus Data' data-placement='bottom' onclick=\"return confirm('Buku dengan NIB ".$book->id." sedang dipinjam, apabila data tetap dihapus maka data peminjaman dan riwayat peminjaman juga ikut terhapus. Lanjutkan proses penghapusan ?')\" href='/books/delete/".$book->id."'><i class='icon-trash icon-white'></i></a>";
                  } ?>
                 <a class="tip btn btn-success btn-small" title="Cetak Label" data-placement="bottom" href="/books/cetak_label/{{ $book->id }}"><i class="icon-print icon-white"></i></a></td>

                  </tr>

                  @endforeach
             
                
               
            </tbody>
        </table>
       
         <table>

        <tr>
        <center>  
        <!--to show the pagination field-->

        {{$books->links()}}
        </center>
        </tr>

        </table>
         <center>
@endsection