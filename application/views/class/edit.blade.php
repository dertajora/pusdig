@layout('template.member')
@section('content')
<center>
	<h3>Halaman Ubah Data Kelas</h3>

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/classes" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Kelas</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>
<h5 color="yellow" align="right"><i>Ubah Data Kelas dengan ID {{ $kelas->id}} </i></h5>


{{Form::open('classes/update/'.$kelas->id,'POST',array('data-validate' => 'parsley'))}}

              <center>
              <table>
              

              <tr>  
              <td>  
              Nama Kelas *&nbsp&nbsp
              </td>
              <td>  
              : &nbsp&nbsp
              </td>
              <td><input type="text" name="nama" value="{{ $kelas->nama; }}" data-required="true"/><br /></td>

              
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