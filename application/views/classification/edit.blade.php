@layout('template.book')
@section('content')
<center>
	<h3>Halaman Ubah Data Kelas Buku</h3>

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/classifications" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Kelas Buku</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>
<h5 color="yellow" align="right"><i>Ubah data kelas buku dengan ID {{ $kelas->id}} </i></h5>


{{Form::open('classifications/update/'.$kelas->id,'POST',array('data-validate' => 'parsley'))}}

              <center>
              <table>
              

              <tr> 
              <td> 
              Kelas&nbsp
              </td>
              <td>  
              : 
              </td>
              <td>&nbsp &nbsp<input type="text" name="kelas" value="{{ $kelas->kelas; }}" data-required="true"/><br /></td>

              </tr>
              <tr> 
              <td>
              Rentang&nbsp
              </td>
              <td>  
              : 
              </td>
              <td>&nbsp &nbsp<input type="text" name="rentang" value="{{ $kelas->rentang; }}" data-required="true"/><br /></td>
             
              </tr>
              
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