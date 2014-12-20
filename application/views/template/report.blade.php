@layout('template.main')
@section('sidebar')			
			<ul class="nav nav-tabs nav-stacked">
				<li class="nav-header">Laporan</li>
				<li>{{ HTML::link('reports/aktivitas', 'Peminjaman') }}</li>
                <li>{{ HTML::link('reports/denda', 'Perolehan Denda') }}</li>
                <li>{{ HTML::link('reports/new_entry', 'Buku Baru') }}</li>
                <li>{{ HTML::link('reports/report_lost', 'Buku Hilang') }}</li>
                <li>{{ HTML::link('reports/riwayat_buku', 'Riwayat Buku') }}</li>
                <li>{{ HTML::link('reports/riwayat_anggota', 'Riwayat Anggota') }}</li>
                <li>{{ HTML::link('reports/graph_book', 'Grafik Koleksi Buku') }}</li>
                <li>{{ HTML::link('reports/graph_borrow', 'Grafik Peminjaman') }}</li>
                <li>{{ HTML::link('reports/graph_charge', 'Grafik Perolehan Denda') }}</li>                
            </ul>
@endsection