@layout('template.transaction')
@section('content')

<h3 align="center">Halaman Peminjaman</h3> 

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

        @if(Session::has('belum'))
        
        <div class="alert alert-warning">
        <center>Anda belum memasukkan data buku</center>
        </div>
        
        @endif

        @if(Session::has('warning'))
        
        <div class="alert alert-warning">
        <center>Peminjaman gagal</center>
        </div>
        
        @endif

        @if(Session::has('sukses'))
        
        <div class="alert alert-success">
        <center>Peminjaman Berhasil</center>
        </div>
        
        @endif

        @if(Session::has('buku1'))
        
        <div class="alert alert-success">
        <center>Peminjaman berhasil untuk buku 1</center>
        </div>
        
        @endif

        @if(Session::has('buku2'))
        
        <div class="alert alert-success">
        <center>Peminjaman berhasil untuk buku 2</center>
        </div>
        
        @endif

        @if(Session::has('buku3'))
        
        <div class="alert alert-success">
        <center>Peminjaman berhasil untuk buku 3</center>
        </div>
        
        @endif
        @if(Session::has('gagal'))
        
        <div class="alert alert-error">
        <center>{{Session::get('gagal')}}</center>
        </div>
        
        @endif



        @if(Session::has('cek_exist'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, anggota dengan NIS {{Session::get('cek_exist')}} tidak terdaftar !</center>
        </div>
        
        @endif
{{Form::open('transactions/cek','POST' ,array('data-validate' => 'parsley'))}}
        <br>
        <br><br><br>
			  <b>Silahkan Masukkan NIS Anggota</b>              
             
        <br>
        <br>
        <table><tr><td>
        <input type="text" class="input-xxlarge" name="id" placeholder="Masukkan NIS anggota disini . . ." 
        data-type="digits" data-required="true" autofocus/>   
        </td></tr></table>
        <br>
        {{ Form::submit('&nbsp; &nbsp; Cek Peminjaman &nbsp; &nbsp;', array('class' => 'btn btn-default btn-warning ')) }}
                
<br>  
</center>
{{Form::close()}}


@endsection
