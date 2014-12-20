@layout('template.transaction')
@section('content')

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 id="myModalLabel">Verifikasi Peminjaman</h4>

            </div>
            <div class="modal-body">
            <table>
            {{Form::open('transactions/cek_bebas','POST')}}
            <tr>  
                          <td>  
                    <b>Silahkan Masukkan NIS</b>              
                          </td>
                          <td>  
                          : 
                          </td>
                          <td><input type="text" name="id"/><br /></td>
                          <td>
                         
                        
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>
                          
                            </td>
                          </tr>
            </table>
            </div>
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Batal</button>
               {{ Form::submit('&nbsp; &nbsp; Cek Peminjaman &nbsp; &nbsp;', array('class' => 'btn btn-warning')) }}
              </form>
            </div>
          </div>

<h3 align="center">Halaman Bebas Pustaka</h3> 
@if(Session::has('cek_bebas'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, anggota dengan NIS {{Session::get('cek_bebas')}} sudah terdaftar bebas pustaka !</center>
        </div>
        
        @endif

        @if(Session::has('sukses'))
        
        <div class="alert alert-success">
        <center>Pendaftaran bebas pustaka untuk anggota dengan NIS {{Session::get('sukses')}} berhasil </center>
        </div>
        
        @endif


        @if(Session::has('cek_exist'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, anggota dengan NIS {{Session::get('cek_exist')}} tidak terdaftar !</center>
        </div>
        
        @endif

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
               <a data-toggle="modal" href="#myModal" class="btn btn-warning">
              <i class="icon-ok icon-white"></i>&nbsp&nbspPemohon Baru</a> 
           </th>
          
          
          
            </tr>
         </thead>
</table>


<p align="right"><b>Daftar Pemohon Bebas Pustaka</b> </p>
<table class="table table-bordered table-striped table-hover">
<thead>
           
           <tr>
           <th>NIS</th>
           <th>Nama</th>
           <th>Kelas</th> 
           <th>Angkatan</th>
           
        

           <th class="muted" style="width: 120px;">Opsi</th>
            </tr>
         </thead>
         <tbody>
                  @foreach($members->results as $member)

                  <tr>
                  <td> {{$member->id}} </td>  
                  <td> {{$member->nama}} </td>
                  <td> <?php $class=$member->class_id;

                        $kelas = DB::table('class')->where('id','=',$class)->only('nama');
                        echo $kelas;
                        ?>
                  </td>
                  <td> {{$member->angkatan}} </td>
                  
                  <td>  <a class="tip btn btn-info btn-small" title="Cetak Kartu Bebas Pustaka" data-placement="bottom" href="/transactions/cetak_bebas/{{ $member->id }}"><i class="icon-edit icon-white"></i> Cetak Kartu</a>
                  </td>

                  </tr>

                  @endforeach

                
             
            </tbody>
</table>


@endsection
