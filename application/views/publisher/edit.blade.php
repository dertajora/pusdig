@layout('template.book')
@section('content')
<center>
	<h3>Halaman Ubah Data Penerbit</h3>

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/publishers" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Penerbit</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>
<h5 color="yellow" align="right"><i>Ubah data penerbit dengan ID {{ $publisher->id}} </i></h5>


{{Form::open('publishers/update/'.$publisher->id,'POST',array('data-validate' => 'parsley'))}}

              <center>
              <table>
              

              <tr>  
              <td>  
              Nama Penerbit * &nbsp&nbsp
              </td>
              <td>  
              : &nbsp&nbsp
              </td>
              <td><input type="text" name="penerbit" value="{{ $publisher->nama; }}" data-required="true"/><br /></td>

              
              <tr>  
             
              
              <tr><td></td><td></td><td>* Wajib diisi</td></tr>
              </table>
              </center>
              <table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <th align="center" class="btn-info" colspan="10">
              <center>
              {{ Form::submit('&nbsp; &nbsp;Update &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}
              </center>
              </th>
          
          
              </tr>
              </thead>
              </table>

             <!-- <input type="submit" name="add_author" value="Create"/> -->

              
            <!-- {{Form::close()}} -->

</center>
{{ Form::close(); }}


@endsection