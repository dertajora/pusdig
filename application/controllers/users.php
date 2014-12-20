<?php

class Users_Controller extends Base_Controller {

	public $restful = true;    
    public function __construct(){
        $this->filter('before','auth');
    }

    public function get_logout()
    {
        return View::make('home.index');
    }

     public function get_login()
    {
        return View::make('home.login');
    }

    public function get_live_search()
    {
        return View::make('code.index');
    }
    public function get_roles()
    {
        return View::make('user.roles');
    }

	public function get_index()
    {
        $role = Auth::user()->role_id;
        if ($role != 1 ){
            return Redirect::to_route('restricted');
        }
        $users =  User::order_by('nama', 'asc')->paginate(10); //show 3 record in each page

        return View::make('user.index')

        ->with('title','Daftar User')

        ->with('users',$users);

    }

    public function post_create(){

    //validate all input using the validate

    //static method under author class.

    /*$validation = User::validate(Input::all());

    //if the validation fails redirect user to

    //the insert new author page

    if($validation->fails()){
       // return View::make('member.new')->with_errors($validation)->with_input();
    return Redirect::to_route('new_user')->with_errors($validation)->with_input();

    }

    //else create create new author

    else{*/
    $cek = Input::get('username');
    $validasi = User::where_username($cek)->count('id'); 
    if ( $validasi > 0){
         return Redirect::to_route('new_user')
         
         ->with('cek',$cek);
    } else {
    $user = new User;
    $user->nama = Input::get('nama');
    $user->username = Input::get('username');
    
    $user->password = Hash::make(Input::get('password'));
    $user->role_id = Input::get('role_id');
    $user->save();
    //$user->password = Crypter::encrypt(Input::get('password'));
            //return Redirect::to('');
    /*Member::create(array(

    'nama'=>Input::get('nama'),
    'kelamin'=>Input::get('kelamin'),
    'tempat_lahir'=>Input::get('tempat'),
    'tgl_lahir'=>Input::get('nama'),
    'alamat'=>Input::get('alamat')

    )); */

    //and then redirect user to the index page

    return Redirect::to_route('new_user')

    ->with('status_message','Data user berhasil dibuat');

    //}
        }
    }        

	public function post_index()
    {

    }    

	public function get_show()
    {
        return View::make('user.show');

    }    

	public function get_edit($id)
    {
        $user = User::find($id);
        if(is_null($user)) {

            return Redirect::to('user');
        }
        return View::make('user.edit')->with('user',$user);
    }    

    public function post_update($id) {

        $user= User::find($id);
        /*$validation = User::validate(Input::all());
        
        if(is_null($user)) {

            return Redirect::to('users');
        }
        elseif ($validation->fails()) {
            return Redirect::to('users/edit/'.$id)->with_errors($validation)->with_input();
        }
       
        else{
        */
        
        $user->nama = Input::get('nama');
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->role_id = Input::get('role_id');
        
        $user->save();

        
         return Redirect::to_route('users')

         ->with('status_message','Data user berhasil diubah');

    //}
        
    }

	public function get_new()
    {
        return View::make('user.new');

    }    

    public function get_delete($id) {

        $user = User::find($id);
        $user->delete();
        
        return Redirect::to_route('users');    
    
    }

	public function put_update()
    {

    }    

	public function delete_destroy()
    {

    }

}