@layout('template.user')
@section('content')


<center>
	<h3>Halaman Ubah Data User</h3>

<table class="table table-bordered table-striped table-hover">

     
        <thead>
           <tr>
           <th align="center" class="btn-info" colspan="10">
              
              <a data-toggle="modal" href="/users" class="btn btn-warning">
              <i class="icon-list-alt icon-white"></i>&nbsp&nbspDaftar User</a>  
              
           </th>
          
          
            </tr>
         </thead>
</table>
<h5 color="yellow" align="right"><i>Ubah Data User dengan username {{ $user->username}} </i></h5>
</center>


{{ Form::open('users/update/'.$user->id,'POST',array('data-validate' => 'parsley')); }}

              <center>
              <table>
                
              <tr>  
              <td>  
              Nama *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="nama" value="{{ $user->nama; }}" data-required="true"/><br /></td>
               
              </tr>
              <tr>
              <td>
              Username * </td>
              <td>  
              : 
              </td>
              <td>
                <input type="text" name="username"  value="{{ $user->username; }}" data-required="true" data-minlength="6"/>
                </td>
              
              </tr>
              <tr>  
              <td>  
              Password Baru&nbsp*
              </td>
              <td>  
              : 
              </td>
              <td><input id="foo" class="password" type="password" name="password" data-required="true" data-minlength="6"/></td>
              
              </tr>

              <tr>  
              <td>  
              Ulang Password &nbsp&nbsp
              </td>
              <td>  
              : &nbsp&nbsp
              </td>
              <td><input id="foo" class="password" type="password" data-required="true" data-equalto="#foo"/></td>
               
              </tr>
              
              <tr>  
              <td>  
              Jabatan *
              </td>
              <td>  
              : 
              </td>
              <td>
              <?php $cek2= $user->role_id;
              $opsi1 =null;
              $opsi2 =null;              
              $opsi3 =null;
             
             
              if ($cek2=='1'){
                $opsi1 = 'selected';}
              elseif ($cek2 == '2') {
                $opsi2 = 'selected';
              }  
              elseif ($cek2 == '3') {
                $opsi3 = 'selected';
              }  
             
              ?>
              <select name="role_id" data-required="true">
                <option></option>
                <option value="1" <?php echo $opsi1;?>>Administrator</option>
                <option value="2" <?php echo $opsi2;?>>Pustakawan</option>
                <option value="3" <?php echo $opsi3;?>>Operator</option>
           
               </select></td> 
                

               </tr>
               <tr><td></td><td></td><td>* Wajib diisi</td></tr>
              </table>
              </center>
              <table class="table table-bordered table-striped table-hover">

     
              <thead>
              <tr>
              <th align="center" class="btn-info" colspan="10">
              <center>
              {{ Form::submit('&nbsp; &nbsp; Update &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}
              </center>
              </th>
          
              
              </tr>
              </thead>
              </table>

             <!-- <input type="submit" name="add_author" value="Create"/> -->

              
             {{Form::close()}}
@endsection