@layout('template.main')
@section('sidebar')
<ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Sirkulasi</li>
                <li>{{ HTML::link('transactions', 'Daftar Peminjaman') }}</li>
                <li>{{ HTML::link('transactions/pinjam', 'Peminjaman') }}</li>
                <li>{{ HTML::link('transactions/kembali', 'Pengembalian') }}</li>
                <li>{{ HTML::link('transactions/bebas_pustaka', 'Bebas Pustaka') }}</li>
</ul>
@endsection