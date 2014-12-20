@layout('template.main')
@section('sidebar')
			<ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Keanggotan</li>
                
                <li>{{ HTML::link('members', 'Pendaftaran Anggota') }}</li>
                <li>{{ HTML::link('classes', 'Pendaftaran Kelas') }}</li>
            </ul>
@endsection

