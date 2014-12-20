@layout('template.report')
@section('content')

<h3 align="center">Halaman Tracking Riwayat Anggota</h3> 

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
             &nbsp
              
           </th>
          
          
            </tr>
         </thead>
</table>

<center>

      


        @if(Session::has('cek_exist'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, anggota dengan NIS {{Session::get('cek_exist')}} tidak terdaftar !</center>
        </div>
        
        @endif

{{Form::open('reports/member_trace','POST' ,array('data-validate' => 'parsley'))}}
        <br>
        <br><br><br>
			  <b>Silahkan Masukkan NIS Anggota yang ingin dicek riwayatnya </b>              
             
        <br>
        <br>
        <table><tr><td>
        <input type="text" class="input-xxlarge" name="nis" placeholder="Masukkan NIS Anggota disini . . ." 
        data-type="digits" data-required="true" autofocus/>   
        </td></tr></table>
        <br>
        {{ Form::submit('&nbsp; &nbsp; Trace Riwayat &nbsp; &nbsp;', array('class' => 'btn btn-default btn-warning ')) }}
                
<br>  
</center>
{{Form::close()}}


@endsection
