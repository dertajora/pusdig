@layout('template.transaction')
@section('content')
<h3 align="center">Halaman Pengembalian</h3> 

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/transactions" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Peminjaman</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>
<center>
        @if(Session::has('cek_bebas'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, anggota dengan NIS {{Session::get('cek_bebas')}} sudah terdaftar sebagai bebas pustaka !</center>
        </div>
        
        @endif

        @if(Session::has('cek_exist'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, anggota dengan NIS {{Session::get('cek_exist')}} tidak terdaftar !</center>
        </div>
        
        @endif
{{Form::open('transactions/cek_pinjaman','POST' ,array('data-validate' => 'parsley'))}}
        <br>
        <br><br><br>
        <b>Silahkan Masukkan NIS Anggota</b>              
             
        <br>
        <br>
        <table><tr><td>
        <input type="text" class="input-xxlarge" name="id" data-type="digits" data-required="true" placeholder="Masukkan NIS anggota disini. . ." autofocus/>   
        </td></tr></table> 
        <br>
        {{ Form::submit('&nbsp; &nbsp; Cek Peminjaman &nbsp; &nbsp;', array('class' => 'btn btn-default btn-warning ')) }}
                
<br>  
</center>
{{Form::close()}}



@endsection


