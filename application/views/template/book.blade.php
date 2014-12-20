@layout('template.main')
@section('sidebar')
			<ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Inventarisasi Buku</li>
                <li>{{ HTML::link('books', 'Buku') }}</li>
                <li>{{ HTML::link('publishers', 'Penerbit') }}</li>
                <!--<li>{{ HTML::link('classifications', 'Klasifikasi') }}</li>-->
                
            </ul>
@endsection
