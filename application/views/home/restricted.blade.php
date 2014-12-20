@layout('template.main')

@section('head')



@endsection
@section('content')
<center>
<b><font face='Century Gothic' color='red'><h3>Akses Ditolak !</h3></font>
<img  src="{{ URL::to_asset('stop.jpg') }}" alt=""></img>
<p>
	<h4><div class='alert alert-danger'>
        			  <b>Anda tidak memiliki kewenangan untuk mengakses halaman ini, silahkan kembali !</b>
        			  </div></h4>
<a data-toggle="modal" href="/" class="btn btn-success">
              <i class="icon-arrow-left icon-white"></i>&nbsp&nbspKembali</a> 
</center>
@endsection