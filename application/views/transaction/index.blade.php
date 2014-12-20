@layout('template.transaction')
@section('content')

<?php 
 function dateDiff($start, $end) {
         $start_ts = strtotime($start);
          $end_ts = strtotime($end);
          $diff = $end_ts - $start_ts;
          return round($diff / 86400);
          }

?>


<table class="table table-bordered table-striped table-hover">

        <h3 align="center">Daftar Peminjaman</h3>  
        <thead>
           <tr>
           <th class="btn-info" colspan="10">
               
              <a align="right" data-toggle="modal" href="/transactions/pinjam" class="btn btn-warning">
              <i class="icon-plus-sign icon-white"></i>&nbsp&nbspPeminjaman Baru</a> 
              
           </th>
          
           </tr> 
         
         </thead>
            <tbody>
                 

                
             
            </tbody>
        </table>
       
<table class="table table-bordered table-striped table-hover">
           <thead>
           <tr>
          
          <!-- <th>ID Pinjam</th>
           <th>ID Detail</th>-->
           <th>NIS Peminjam</th>
           <th>NIB</th>
           
           <th>Judul Buku</th>

           <th>Tanggal Pinjam</th>
           <th>Tanggal Kembali</th>
           <th>Status</th>
           <th>Denda</th>
          
        
           </tr>
           </thead>
            

           <tbody>
            
            @foreach($hasils->results as $hasil)
          
        <tr>
         
        
          <td>{{ $hasil->member_id }}</td>
          <td>{{ $hasil->book_id }}</td>
          
          <?php  
           
           $buku=$hasil->book_id;
           
           $judul = DB::table('books')->where('id','=',$buku)->only('judul');
           
           ?>
          <td> <?php echo $judul ;?> </td>
          
          <td> <?php $tanggal_data = $hasil->tgl_pinjam; 
                   
                    $pieces = explode("-", $tanggal_data);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  ?></td>
          <td> <?php $tgl_kembali = $hasil->tgl_kembali;
                  $status_buku = $hasil->status;
              if ($status_buku == 'Hilang'){
                
                 $pieces = explode("-", $tgl_kembali);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  echo " ( Lapor )";
              }
              elseif ($tgl_kembali == null){
                echo 'Belum Kembali';
              }
              elseif ($tgl_kembali != '0000-00-00'){
                 
                   
                $pieces = explode("-", $tgl_kembali);
                    echo "$pieces[2] / $pieces[1] / $pieces[0]";
                  
              }
              ?>
              </td>
          <?php 
            $denda = 0;    
            $borrow_date = $hasil->tgl_pinjam;
            $return_date = $hasil->tgl_kembali;
            $selisih = datediff($borrow_date,$return_date);
            $telat = $selisih-7;
            if ($telat <= 0){
                $telat = 0;
            }
            $dendasementara = $telat * 100;
            $denda = $denda + $dendasementara;

          $tes=$denda;
          $fontopen='';
          $fontclose='';
          if($tes>0){
              $fontopen="<font color='#ff0000'><b>";
              $fontclose="</b></font>";
          }
          ?>
           <?php $tes_status=$hasil->status;
           if($tes_status =='Hilang'){
                  $status='Hilang';
                }
                 elseif ($tes_status == 'Perpanjang' ){
                  $status='Perpanjang';
                }
                  elseif ($tgl_kembali == null){
                 $status='Dipinjam';
                
                } elseif ($tgl_kembali != null){
                  $status='Kembali';
                }
                $status_open='';
                $status_close='';
                if($status== 'Kembali'){
                  $status_open="<font color='green'><b>";
                  $status_close="</b></font>";
                } elseif ($status== 'Perpanjang'){
                  $status_open="<font color='#33bafe'><b>";
                  $status_close="</b></font>";
                }
                elseif ($status== 'Hilang'){
                  $status_open="<font color='red'><b>";
                  $status_close="</b></font>";
                }
              ?>
              
              <td><?php echo $status_open; ?>{{ $status }}<?php echo $status_close; ?>
          
         
          <td><?php echo $fontopen; ?>{{ $denda}}<?php echo $fontclose; ?></td>
       
          
          
        </tr>
        
    
      @endforeach
      

           </tbody>
</table>
 <center>
        <table>

        <tr>

        <!--to show the pagination field-->

        {{$hasils->links()}}

        </tr>

        </table>
        </center>

       
@endsection

