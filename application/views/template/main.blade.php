<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sipus SMANTY</title>
    <meta name="description" content="">
    <meta author="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
    <!--untuk meload css dari bootstrap beserta font lama -->
    {{ Asset::container('bootstrapper')->styles(); }} 
	{{ Asset::container('bootstrapper')->scripts(); }}

    <!--untuk meload font trebuchet MS -->

    {{ HTML::style('css/jq.css'); }} 
    @yield('head')
     <style type="text/css">
     
                    .judul a:link {text-decoration:none;}
                    .judul a:visited {text-decoration:underline;}
                    .judul a:hover {text-decoration:none;color:#66cbfd;}
                    .judul a:active {text-decoration:none;}  
            
                    .keluar a:link {text-decoration:none;}
                    .keluar a:visited {text-decoration:underline;}
                    .keluar a:hover {text-decoration:none;color:#66cbfd;}
                    .keluar a:active {text-decoration:none;}  

      input.parsley-success
            {
              color: #468847 !important;
              background-color: #DFF0D8 !important;
              border: 2px solid #D6E9C6 !important;
            }
            input.parsley-error
            {
              color: #B94A48 !important;
              background-color: #F2DEDE !important;
              border: 2px solid #EED3D7 !important;
            }
 
           
 
            ul.parsley-error-list
            {
                font-size:12px;
                margin: 2px;
                list-style-type:none;
            }
 
            ul.parsley-error-list li
            {
                line-height: 12px;
            }

            


        </style>
</head>

<?php
              $dbconn = mysql_connect('localhost','root','');
              if (!$dbconn) 
              { 
                  die("database connection failed"); 
              }
              else 
              {
                  $dbsel = mysql_select_db('pusdig');
                  if (!$dbsel) { die("database not found"); }
              }
              
             
              //$isi = mysql_fetch_row($hasil);
               
              
              
              ?>
<body>
 
<?php  $roles = Auth::user()->role_id;  ?>

<div class="navbar navbar-fixed-top">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div id="judul">
                <span class="brand judul"><a href="/">Sipus Bina Tunas</a></span>
                </div>
                <div class="nav-collapse collapse">

                    <ul class="nav">
                        <?php if ($roles != 3){ echo "
                        <li><a href='http://pusdig.com/members'><i class='icon-list icon-black'></i>&nbsp&nbspManajemen Anggota</a></li>
                        <li><a href='http://pusdig.com/books'><i class='icon-book icon-black'></i>&nbsp&nbspInventarisasi Buku</a></li>";
                        }?>
                        <?php 
                        if ($roles == 3){ 
                        echo "<li><a href='/transactions'><i class='icon-refresh icon-black'></i>&nbsp&nbspSirkulasi</a></li>";
                        }
                        ?>
                        <?php if($roles == 2 ) { echo " 
                        <li><a href='/reports/aktivitas'><i class='icon-signal icon-black'></i>&nbsp&nbspLaporan</a></li>";
                        }
                        ?>
                        <?php if ($roles == 1  ){ echo 
                        "<li><a href='/users'><i class='icon-user icon-black'></i>&nbsp&nbspManajemen User</a></li>";
                        }
                        ?>

                    </ul>

                    
                     
                    <ul class="nav pull-right settings">
                        
                        <li class="divider-vertical"></li>
                        <li><a ><i class="icon-large icon-off" ></i></a></li>
                         <li>  {{ HTML::link('/logout', 'Logout',array('data-placement'=>'bottom')) }}</li>

                    </ul>

                    <ul class="nav pull-right settings">
                        <li class="divider-vertical"></li>
                    </ul>

                    <p class="navbar-text pull-right">
                        Welcome <strong>{{ Auth::user()->username; }}</strong>
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
            @yield('sidebar')
               
           
          
        </div>
    </div>
    <!--/.well -->
    <!--/span3-->
	

    <div class="span10 pull-left">

        <div class="well" onload="printpage()">
        
        @if(Session::has('status_message'))
        
        <div class="alert alert-success">
        <center>{{Session::get('status_message')}}</center>
        </div>
        @endif

        @if(Session::has('cek'))
        
        <div class="alert alert-success">
        <center>Mohon maaf, data dengan username {{Session::get('cek')}} sudah terdaftar !</center>
        </div>
        
        @endif

        @if(Session::has('cek_member'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, data anggota dengan NIS {{Session::get('cek_member')}} sudah terdaftar !</center>
        </div>
        
        @endif

        @if(Session::has('cek_penerbit'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, data penerbit dengan nama {{Session::get('cek_penerbit')}} sudah terdaftar !</center>
        </div>
        
        @endif

        @if(Session::has('cek_kelas'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, data kelas {{Session::get('cek_kelas')}} sudah terdaftar !</center>
        </div>
        
        @endif

        @if(Session::has('cek_kelas_buku'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, data dengan kelas buku {{Session::get('cek_kelas_buku')}} sudah terdaftar !</center>
        </div>
        
        @endif

        @if(Session::has('cek_buku'))
        
        <div class="alert alert-error">
        <center>Mohon maaf, data buku dengan NIB {{Session::get('cek_buku')}} sudah terdaftar !</center>
        </div>
        
        @endif

        @if(Session::has('error_message'))
        
        <div class="alert alert-error">
        <center>{{Session::get('error_message')}}</center>
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

<!--<script src="http://code.jquery.com/jquery-latest.min.js"></script>-->


<script>
    // enable tooltips
    $(".tip").tooltip();
</script>


{{ HTML::script('js/parsley.js'); }}
{{ HTML::script('js/custom.js'); }}

{{ HTML::script('js/jquery.tablesorter.js');}}

</body>
</html>
