@layout('template.book')


@section('content')

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 id="myModalLabel">Tambah Kelas Buku</h4>

            </div>
            <div class="modal-body">
              {{Form::open('classifications/add','POST',array('data-validate' => 'parsley'))}}
              
              <center>
              <table>
              <tr>  
              <td>  
              Kelas
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="kelas" data-required="true" autofocus/><br /></td></tr>
            
              <tr>  
              <td>  
              Rentang
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="rentang" data-required="true"/><br /></td></tr>  
             
            </table>
         
              </center>
              
            </div>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Tutup</button>
              <input class="btn btn-primary" type="submit" value="Tambah"/>
              {{ Form::close(); }}
            </div>
          </div>




<!--<p> {{HTML::link_to_route('new_member', 'Tambah Anggota')}} </p>-->



<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar Kelas Buku</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="#myModal" class="btn btn-warning">
              <i class="icon-plus-sign icon-white"></i>&nbsp&nbspTambah Kelas</a> 
              
           </th>
          
           </tr> 
           <tr>
           
           <th>Kelas</th>
           <th>Rentang Kelas DDC</th>
           

          
            </tr>
         </thead>
            <tbody>
                @foreach($kelas->results as $classification)
                  
                  <tr>

                
                  <td> {{$classification->kelas}} </td>
                  <td> {{$classification->rentang}} </td>
                

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

        {{$kelas->links()}}
       

        </tr>

        </table>
        </center>

@endsection
