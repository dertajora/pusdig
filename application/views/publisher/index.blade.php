@layout('template.book')


@section('content')

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 id="myModalLabel">Tambah Penerbit</h4>

            </div>
            <div class="modal-body">
              <form action="publishers/add" method="POST" data-validate="parsley">
              <center>
              <table>
                
              <tr>  
              <td>  
              Nama Penerbit * &nbsp&nbsp
              </td>
              <td>  
              : &nbsp&nbsp
              </td>
              <td><input type="text" name="penerbit" data-required="true" autofocus/><br /></td></tr>
              <tr><td></td><td></td><td>* Wajib diisi</td></tr>
            </table>
         
              </center>
              
            </div>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Batal</button>
              <input class="btn btn-primary" type="submit" value="Tambah"/>
              </form>
            </div>
          </div>




<!--<p> {{HTML::link_to_route('new_member', 'Tambah Anggota')}} </p>-->



<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar Penerbit</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="#myModal" class="btn btn-warning">
              <i class="icon-plus-sign icon-white"></i>&nbsp&nbspTambah Penerbit</a> 
              
           </th>
          
           </tr> 
           <tr>
           <th>ID</th>
           <th>Nama Penerbit</th>
           

           <th class="muted" style="width: 120px;">Opsi</th>
            </tr>
         </thead>
            <tbody>
                @foreach($publishers->results as $publisher)
                  
                  <tr>

                  <td> {{$publisher->id}} </td>
                  <td> {{$publisher->nama}} </td>
                 <td>  <a class="tip btn btn-info btn-small" title="Ubah Data" data-placement="bottom" href="publishers/edit/{{ $publisher->id }}"><i class="icon-edit icon-white"></i></a>
                  <a class="tip btn btn-danger btn-small" title="Hapus Data" data-placement="bottom" onclick="return confirm('Apakah anda yakin akan menghapus data penerbit dengan ID {{ $publisher->id}} ?')" href="publishers/delete/{{ $publisher->id }}"><i class="icon-trash icon-white"></i></a></td>

                 @endforeach

                
             
            </tbody>
        </table>

        
        <table>

        <tr>

        <!--to show the pagination field-->

     
       

        </tr>

        </table>
        </center>
        <center>
        <table>

        <tr>

        <!--to show the pagination field-->

        {{$publishers->links()}}
       

        </tr>

        </table>
        </center>

@endsection
