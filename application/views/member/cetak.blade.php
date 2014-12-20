@layout('template.member')
@section('head')
<script>
    
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
</script>

<style type="text/css">
body {padding:30px}
.print-area {padding:1em;margin:0 0 1em}
</style>

 <style type="text/css">  
      td.thickBorder{ border: solid #000 1px;}  
    </style>
@endsection

@section('content')
<center>
  <h4>Halaman Konfirmasi Cetak Kartu Anggota</h4>
</center>
<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/members" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar Anggota</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>


<a data-toggle="modal" href="javascript:printDiv('print-area-1');" class="pull-right btn btn-success">
<i class="icon-print icon-white"></i>&nbsp&nbspCetak Kartu Anggota</a>


<div id="print-area-1" width="30px" class="print-area">
<hr>
<table><font face='Trebuchet MS' size='2'><tr>
  <td style="width: 50px;">
  </td>
  <td style="width: 50px;">
  <center><img  src="{{ URL::to_asset('tutwuri.jpg') }}" alt=""></img></center> 
  </td>
  <td style="width: 250px;">
  <center><b><font face='Trebuchet MS' size="3px">Kartu Anggota Perpustakaan</font></b><br>
  <font face='Trebuchet MS' >Perpustakaan Bina Tunas<br>
  <font face='Trebuchet MS'><b>SMA Negeri 3 Pemalang</b>
  </td>
  <td style="width: 50px;">
  <img  src="{{ URL::to_asset('smanty.jpg') }}" alt=""></img>
  </font></td>
  </tr>
  </table>
  <br>
  <?php $nis = 3541 ;?>
<small>
  <table width="75%"><font face='Trebuchet MS'>
  <tr>
  <td style="width: 38% ">
  NIS Anggota
  </td>
  <td style="width: 2% ">:</td>
  <td style="width: 40 %">{{ $member->id}}</td>
  </tr>
  <tr><td>
  Nama
  </td>
  <td>:</td>
  <td>{{ $member->nama}}</td>
  </tr>
   <tr><td>
  Kelas / Angkatan
  </td>
  <td>:</td>
  <?php $class=$member->class_id;
  $kelas = DB::table('class')->where('id','=',$class)->only('nama');
  ?>
  <td>{{ $kelas}} / {{ $member->angkatan}} </td>
  </tr>
  <tr><td> 
  Kelamin
  </td>
  <td>:</td>
  <td><?php $gender=$member->kelamin; 
    if ($gender == 'L'){
      echo 'Laki-laki';
    }elseif ($gender =='P'){
      echo 'Perempuan';
    }
  ?></td>
  </tr>
  <tr><td>
  Tempat, Tanggal Lahir&nbsp&nbsp&nbsp</td>
  <td>:</td>
  <td>{{ $member->tempat_lahir}}, <?php echo $tgl_lahir; ?></td>
  </tr>
  <tr><td>
  Alamat
  </td>
  <td>:</td>
  <td>{{ $member->alamat}}</font></td>
  </tr>
  </table>
  <Br>
  
<table>
    
    <tr><th border="1" style="width: 100px; BORDER-RIGHT: black solid; BORDER-TOP: black solid; BORDER-LEFT: black solid; BORDER-BOTTOM: black solid">&nbsp<br><br><center><b>Foto</b></center><br><br></th>
  <td style="width: 130px;">&nbsp<br><br><br></th>
  
  <th style="width: 30px;">&nbsp<br><br></th>
  <th style="width: 250px;">Pemalang, <?php echo $tgl_skrng;?><br>Kepala SMA N 3 Pemalang<br><img  src="{{ URL::to_asset('ttd_fix.png') }}" alt=""></img><br>
    A Y A N T O, S Pd, M Pd<br>NIP. 19660415 199003 1 009</th>
  </small>
  
</table>
 <br> 
<hr>
</div>


<textarea id="printing-css" style="display:none;"></textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <th align="center" class="btn-info" colspan="10">
              <center>
             &nbsp
              </center>
              </th>
          
          
              </tr>
              </thead>
              </table>

@endsection