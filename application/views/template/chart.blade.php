<html>
<head>
	<meta charset="utf-8">
    <title>SuperAdmin</title>
    <meta name="description" content="">
    <meta author="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 " >

   
    
    {{ Asset::container('bootstrapper')->styles(); }}
	{{ Asset::container('bootstrapper')->scripts(); }}
	@yield('head')
</head>
<body>

<div class="navbar navbar-fixed-top">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <span class="brand">Sipus Bina Tunas</span>

                <div class="nav-collapse collapse">

                   <ul class="nav">
                        
                        <li><a href="http://pusdig.com/members"><i class="icon-list icon-black"></i>&nbsp&nbspKeanggotaan</a></li>
                        <li><a href="http://pusdig.com/books"><i class="icon-book icon-black"></i>&nbsp&nbspInventarisasi Buku</a></li>
                        <?php $asli=1;
                        if ($asli == 1){ 
                        echo "<li><a href='http://pusdig.com/transactions/pinjam'><i class='icon-refresh icon-black'></i>&nbsp&nbspSirkulasi</a></li>";
                        }
                        ?>
                        <li><a href="http://pusdig.com/reports/denda"><i class="icon-signal icon-black"></i>&nbsp&nbspLaporan</a></li>
                        <li><a href="http://pusdig.com/users"><i class="icon-user icon-black"></i>&nbsp&nbspManajemen User</a></li>
                        

                    </ul>


                    <ul class="nav pull-right settings">
                        
                        <li class="divider-vertical"></li>
                        <li><a href="http://pusdig.com/users/logout" class="tip icon logout" data-original-title="Logout" data-placement="bottom"><i
                           class="icon-large icon-off"></i></a></li>
                    </ul>

                    <ul class="nav pull-right settings">
                        <li class="divider-vertical"></li>
                    </ul>

                    <p class="navbar-text pull-right">
                        Welcome <strong>Admin</strong>
                    </p>

                   

                    

                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
</div>
<br><br>

<div class="row-fluid">
    <div class="span2 pull-left">
        <div class="well sidebar-nav">
             <Center><img style="border:1px solid #33bafe;"  src="{{ URL::to_asset('1.jpg') }}" alt=""></img> </center>
                <?php
              $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
              $hari = $array_hari[date('N')];

              $array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Novemer','Desember');
              $bulan = $array_bulan[date('n')];

              $tgl = date('j');
              $thn = date('Y'); 
              echo "<i><h5 align='right'>";
              echo $hari.", ".$tgl." ".$bulan." ".$thn ;
              echo "</h5></i>";
              ?> 
                <br>
			<ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Laporan</li>
                <!--<li>{{ HTML::link('reports/aktivitas', 'Laporan Peminjaman') }}</li>-->
                
                <li>{{ HTML::link('reports/new_entry', 'Buku Baru') }}</li>
                <li>{{ HTML::link('reports/report_lost', 'Buku Hilang') }}</li>
                <li>{{ HTML::link('reports/denda', 'Perolehan Denda') }}</li>
                <li>{{ HTML::link('reports/graph_book', 'Grafik Koleksi Buku') }}</li>
                <li>{{ HTML::link('reports/graph_borrow', 'Grafik Peminjaman') }}</li>
                <li>{{ HTML::link('reports/graph_charge', 'Grafik Perolehan Denda') }}</li>
                
            </ul>
        </div>
    </div>
    <!--/.well -->
    <!--/span3-->
	

    <div class="span10 pull-left">

        <div class="well">
        
        @if(Session::has('status_message'))
        
        <div class="alert alert-success">
        <center>{{Session::get('status_message')}}</center>
        </div>
        @endif

        @yield('content')
        
        </div>

    </div>
    <!--/span9-->

</div>
<!--/row-fluid-->

<hr>

<footer align="center">
	<center>
    <p>Copyright &copy; 2013 <strong>Programmer Bingung</strong></p></center>
</footer>


{{ HTML::script('js/parsley.js'); }}

</body>
</html>