@layout('template.main')
@section('sidebar')			
			<ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Manajemen User</li>
                <li>{{ HTML::link('users', 'Pengguna') }}</li>
                
                <li>{{ HTML::link('users/role', 'Jabatan') }}</li>
               
            </ul>
@endsection