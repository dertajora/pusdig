@layout('template.report')
@section('content')

<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar Buku Baru</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="/reports/graph_book" class="btn btn-warning">
              <i class="icon-indent-right icon-white"></i>&nbsp&nbspGrafik Koleksi</a> 
              
              
          
           </th>
          
           </tr> 
          
         </thead>
        </table>
        <table class="table table-bordered table-striped table-hover">
          <thead>
         <h5 class='pull-right' align='right'> Daftar Buku Baru Bulan <font color='green'><b>{{$tgl_baru}} </b></font></h5>
          <tr>
           <th>NIB</th>
           <th>Judul</th>
           <th>Tanggal Terima</th>
           <th>Pengarang</th>
           <th>Penerbit</th>
           <th>Sumber</th>
          
           <th>Kategori</th>
            </tr>
          </thead>
            <tbody>
            @foreach($books->results as $book)
                  <?php $cek_type= null; $hasil=''?>
                  <tr>

                  <td> {{$book->id}} </td>
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
                  <td> {{$book->sumber}} </td>
                  
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