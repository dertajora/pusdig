@layout('template.user')
@section('content')





<!--<p> {{HTML::link_to_route('new_member', 'Tambah Anggota')}} </p>-->



<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar User</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
              <a data-toggle="modal" href="users/new" class="btn btn-warning">
              <i class="icon-plus-sign icon-white"></i>&nbsp&nbspTambah User</a> 
              
           </th>
          
           </tr> 
           <tr>
           <th>Nama</th>
           <th>Username</th>
           
           <th>Jabatan</th>
           
        

           <th class="muted" style="width: 80px;">Opsi</th>
            </tr>
         </thead>
            <tbody>
            @foreach($users->results as $user)

                  <tr>

                  <td> {{$user->nama}} </td>
                  <td> {{$user->username}} </td>
                  
                 
                 <td>
                  @if($user->role_id==1)
                       <?php echo 'Administrator'?>
                  @elseif ($user->role_id==2)
                      <?php echo 'Pustakawan'?>
                  @elseif ($user->role_id==3)
                      <?php echo 'Operator'?>
                  @endif
                  </td>
                  <td>  <a class="tip btn btn-info btn-small" title="Ubah Data" data-placement="bottom" href="users/edit/{{ $user->id }}"><i class="icon-edit icon-white"></i></a>
                  <a class="tip btn btn-danger btn-small" title="Hapus Data" data-placement="bottom" onclick="return confirm('Apakah anda yakin akan menghapus data user dengan username {{ $user->username}} ?')" href="users/delete/{{ $user->id }}"><i class="icon-trash icon-white"></i></a></td>

                  </tr>

                  @endforeach     

                
             
            </tbody>
        </table>
        <center>
		<table>

		<tr>

		<!--to show the pagination field-->

		{{$users->links()}}

		</tr>

		</table>
		</center>
    
@endsection
