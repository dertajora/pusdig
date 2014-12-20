@layout('template.member')
@section('content')
<center>
	<h3>Halaman Ubah Data Anggota</h3>

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
<h5 color="yellow" align="right"><i>Ubah Data Anggota dengan NIS {{ $member->id}} </i></h5>


{{Form::open('members/update/'.$member->id,'POST',array('data-validate' => 'parsley'))}}

              <center>
              <table>
              

              <tr>  
              <td>  
              Nama *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="nama" value="{{ $member->nama; }}" data-required="true"/><br /></td>

              
              </tr>
              <tr>  
              <td>  
              Kelas*
              </td>
              <td>  
              : 
              </td>
              <td>
              <?php

              mysql_connect('localhost', 'root', '');
              mysql_select_db('pusdig');

              $sql = "SELECT id,nama FROM class";
              $result = mysql_query($sql); 
              echo "<select name='kelas' data-required='true'>";
              echo "<option></option>";
              
              $cek_kelas=$member->class_id;
              while ($row = mysql_fetch_array($result)) {
                  $cek = $row['id'];
                  if ($cek == $cek_kelas){
                     $opsi = 'selected';
                     echo "<option value='" . $cek. "'selected >" . $row['nama'] . "</option>";
                  } else {
                  echo "<option value='" . $cek. "' >" . $row['nama'] . "</option>";}
              }
              echo "</select>";

              ?>

              </td></tr>
              <tr>  
              <?php $cek2= $member->angkatan;
              $opsi1 =null;
              $opsi2 =null;              
              $opsi3 =null;
              $opsi4 =null;
              $opsi5 =null;
              $opsi6 =null;
              $opsi7 =null;

             
              if ($cek2=='2013'){
                $opsi1 = 'selected';}
              elseif ($cek2 == '2014') {
                $opsi2 = 'selected';
              }  
              elseif ($cek2 == '2015') {
                $opsi3 = 'selected';
              }  
              elseif ($cek2 == '2016') {
                $opsi4 = 'selected';
              }  
               elseif ($cek2 == '2017') {
                $opsi5 = 'selected';
              } elseif ($cek2 == '2011') {
                $opsi6 = 'selected';
              } elseif ($cek2 == '2012') {
                $opsi7 = 'selected';
              }  
              ?>
              
              <td>  
              Tahun Masuk*
              </td>
              <td>  
              : 
              </td>
              <td>
              <select name="angkatan" data-required="true">
                <option></option>
                <option value="2011" <?php echo $opsi6;?>>2011</option>
                <option value="2012" <?php echo $opsi7;?>>2012</option>
                <option value="2013" <?php echo $opsi1;?>>2013</option>
                <option value="2014" <?php echo $opsi2;?>>2014</option>
                <option value="2015" <?php echo $opsi3;?>>2015</option>
                <option value="2016" <?php echo $opsi4;?>>2016</option>
                <option value="2017" <?php echo $opsi5;?>>2017</option>
           
           
               </select></td></tr> 

              <tr>
              <td>
              Kelamin* </td>
              <td>  
              : 
              </td>

              <?php $cek= $member->kelamin;
              $L=null;$P=null;
             
              if ($cek=='L'){
                $L = 'checked';}
              elseif ($cek == 'P') {
                $P = 'checked';
              }  
              ?>
              <td>
                <label class="radio">
                <input type="radio" name="kelamin" id="optionsRadios1" value="L" <?php echo $L;?> >Laki-laki
              </label>
                <label class="radio">
                <input type="radio" name="kelamin" id="optionsRadios1" value="P" <?php echo $P;?>>Perempuan
                </label>
                
              </td>
              <td></td>
               </tr>
              
              <tr>  
              <td>  
              Tempat Lahir *&nbsp&nbsp
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="tempat_lahir" value="{{ $member->tempat_lahir; }}"  data-required="true" /></td>

            
             
              <tr>  
              <td>  
              Tanggal Lahir *
              </td>
              <td>  
              : 
              </td>
              <td><input type="date" name="tgl_lahir" value="{{ $member->tgl_lahir; }}"  data-required="true" /><br /></td>
              
              </tr> 
              <tr>  
              <td>  
              Alamat
              </td>
              <td>  
              : &nbsp &nbsp
              </td>
              <td><textarea name="alamat">{{ $member->alamat; }}</textarea><br /></td>
              <td>
             
              </tr>
              <tr>  
             
              
              
              </table>
              <tr><td></td><td></td><td>* Wajib diisi</td></tr>
              </center>
              <table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <th align="center" class="btn-info" colspan="10">
              <center>
              {{ Form::submit('&nbsp; &nbsp;Update &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}
              </center>
              </th>
          
          
              </tr>
              </thead>
              </table>

             <!-- <input type="submit" name="add_author" value="Create"/> -->

              
            <!-- {{Form::close()}} -->

</center>
{{ Form::close(); }}


@endsection