@layout('template.report')
@section('content')

<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar Buku Hilang</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
             &nbsp
           </th>
          
           </tr> 
           <tr>
           <th>NIB</th>
           <th>Judul</th>
           <th>Pengarang</th>
           <th>Penerbit</th>
           <th>Peminjam Terakhir</th>
           <th>NIS Peminjam</th>
           <th>Tanggal Pinjam</th>
           
            </tr>
         </thead>
            <tbody>
            @foreach($books->results as $book)
                  
                  <tr>
                  <td> {{$book->book_id}} </td> 
                 
                  <td>{{$book->judul}}</td>
                  <td>{{$book->pengarang}}</td>
                  <td>{{$book->nama}}</td>
                  
                  <td><?php $member_id=$book->member_id;

                        $nama = DB::table('members')->where('id','=',$member_id)->only('nama');
                        echo $nama;
                        ?>
                  </td>

                  <td> {{$book->member_id}} </td>
                  
                   <td> <?php $tanggal_data = $book->tgl_pinjam; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>
                  
                 
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