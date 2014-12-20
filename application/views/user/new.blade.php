@layout('template.user')
@section('content')



<h3 align="center">Halaman Tambah User</h3> 

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



{{Form::open('users/create','POST',array('data-validate' => 'parsley'))}}

              <center>
              <table>
                
              <tr>  
              <td>  
              Nama *
              </td>
              <td>  
              : 
              </td>
              <td><input type="text" name="nama" data-required="true" autofocus/><br /></td>
               
          	  </tr>
              <tr>
              <td>
              Username * </td>
              <td>  
              : 
              </td>
              <td>
                <input type="text" name="username" data-required="true" data-minlength="6"/>
                </td>
              
              </tr>
              <tr>  
              <td>  
              Password * &nbsp&nbsp
              </td>
              <td>  
              : &nbsp&nbsp
              </td>
              <td><input id="foo" class="password" type="password" name="password" data-required="true" data-minlength="6"/></td>
              
          	  </tr>

              <tr>  
              <td>  
              Ulang Password&nbsp&nbsp
              </td>
              <td>  
              : 
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
              <select name="role_id" data-required="true">
              	<option></option>
              	<option value="1">Administrator</option>
              	<option value="2">Pustakawan</option>
              	<option value="3">Operator</option>
           
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
              {{ Form::submit('&nbsp; &nbsp; Create &nbsp; &nbsp;', array('class' => 'btn btn-primary')) }}
              </center>
              </th>
          
          
              </tr>
              </thead>
              </table>

             <!-- <input type="submit" name="add_author" value="Create"/> -->

              
             {{Form::close()}}


@endsection