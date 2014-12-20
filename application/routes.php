<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/
Route::get('code', array('as' => 'code','before' => 'auth',   'uses' => 'home@code'));
Route::get('search', array('as' => 'livesearch','before' => 'auth',   'uses' => 'home@livesearch'));
Route::get('/', array('as' => 'index','before' => 'auth',   'uses' => 'home@index'));
Route::get('restricted', array('as' => 'restricted','before' => 'auth',   'uses' => 'home@restricted'));
// Route::get('login', function() {
    // return View::make('login.login');
// });

Route::get('login', array('as' => 'login', 'uses' => 'login@index'));
Route::get('logout', array('as' => 'logout', 'uses' => 'login@logout'));
Route::post('login', array('uses'=>'login@login'));



/*Route::post('login', function() {
    // get POST data
    $userdata = array(
        'username'      => 'dertajora',
        'password'      => '123456'
    );
    if ( Auth::attempt($userdata) )
    {
        // we are now logged in, go to home
        return Redirect::to_route('transactions');
    }
    else
    {
        // auth failure! lets go back to the login
        return Redirect::to('login')
            ->with('login_errors', true);
        // pass any error notification you want
        // i like to do it this way :)
    }
});*/
//Route::get('login', array('as' => 'login', 'uses' => 'home@login'));
// user Resource
Route::get('users', array('as' => 'users', 'uses' => 'users@index'));
Route::get('users/(:any)', array('as' => 'user', 'uses' => 'users@show'));
Route::get('users/new', array('as' => 'new_user', 'uses' => 'users@new'));
Route::get('users/edit/(:any)', array('as' => 'edit_user', 'uses' => 'users@edit'));
//Route::post('users', 'users@create');
Route::get('users/delete/(:any)', 'users@delete');
Route::post('users/create', array('uses'=>'users@create'));
Route::put('users/(:any)', 'users@update');
Route::delete('users/(:any)', 'users@destroy');
Route::post('users/update/(:any)', array('as' => 'update_user','uses'=>'users@update'));
Route::get('users/logout', array('as' => 'logout', 'uses' => 'users@logout'));
Route::get('users/live_search', array('as' => 'live_search', 'uses' => 'users@live_search'));
Route::get('users/role', array('as' => 'roles', 'uses' => 'users@roles'));

// member Resource
Route::get('members', array('as' => 'members', 'uses' => 'members@index'));
Route::get('members/(:any)', array('as' => 'member', 'uses' => 'members@show'));
Route::get('members/new', array('as' => 'new_member', 'uses' => 'members@new'));
Route::get('members/edit/(:any)', array('as' => 'edit_member', 'uses' => 'members@edit'));
Route::get('members/cetak/(:any)', array('as' => 'cetak_member', 'uses' => 'members@cetak'));
//Route::post('members', 'members@create');
Route::put('members/(:any)', 'members@update');
Route::get('members/delete/(:any)', 'members@delete');
Route::post('members/create', array('uses'=>'members@create'));
Route::post('members/update/(:any)', array('as' => 'update_member','uses'=>'members@update'));
Route::get('members/pdf',array('as' => 'cetak' , 'uses' => 'members@pdf'));
Route::get('members/cetak_pdf/(:any)',array('as' => 'cetak' , 'uses' => 'members@cetak_pdf'));
Route::get('members/history/(:any)', array('as' => 'history_member', 'uses' => 'members@history'));
Route::post('members/search', array('as' => 'search_member','uses'=>'members@search'));
// classe Resource
Route::get('classes', array('as' => 'classes', 'uses' => 'classes@index'));
Route::get('classes/(:any)', array('as' => 'classe', 'uses' => 'classes@show'));
Route::get('classes/new', array('as' => 'classe', 'uses' => 'classes@new'));
Route::get('classes/edit/(:any)', array('as' => 'edit_class', 'uses' => 'classes@edit'));
Route::post('classes', 'classes@create');
Route::put('classes/(:any)', 'classes@update');
Route::delete('classes/(:any)', 'classes@destroy');
Route::post('classes/add', array('uses'=>'classes@add'));
Route::post('classes/update/(:any)', array('as' => 'update_class','uses'=>'classes@update'));
Route::get('classes/delete/(:any)', 'classes@delete');

// publisher Resource
Route::get('publishers', array('as' => 'publishers', 'uses' => 'publishers@index'));
Route::get('publishers/(:any)', array('as' => 'publisher', 'uses' => 'publishers@show'));
Route::get('publishers/new', array('as' => 'new_publisher', 'uses' => 'publishers@new'));
Route::get('publishers/edit/(:any)', array('as' => 'edit_publisher', 'uses' => 'publishers@edit'));

Route::post('publishers/add', array('uses'=>'publishers@add'));
Route::post('publishers/update/(:any)', array('as' => 'update_publisher','uses'=>'publishers@update'));
Route::get('publishers/delete/(:any)', 'publishers@delete');

// classification Resource
Route::get('classifications', array('as' => 'classifications', 'uses' => 'classifications@index'));
Route::get('classifications/(:any)', array('as' => 'classification', 'uses' => 'classifications@show'));
Route::get('classifications/new', array('as' => 'new_classification', 'uses' => 'classifications@new'));
Route::get('classifications/edit/(:any)', array('as' => 'edit_classification', 'uses' => 'classifications@edit'));

Route::post('classifications/add', array('uses'=>'classifications@add'));
Route::post('classifications/update/(:any)', array('as' => 'update_kelas','uses'=>'classifications@update'));
Route::get('classifications/delete/(:any)', 'classifications@delete');

// book Resource
Route::get('books', array('as' => 'books', 'uses' => 'books@index'));
Route::get('books/katalog', array('as' => 'katalog', 'uses' => 'books@katalog'));
//Route::get('books/(:any)', array('as' => 'book', 'uses' => 'books@show'));
Route::get('books/new', array('as' => 'new_book', 'uses' => 'books@new'));
Route::get('books/edit/(:any)', array('as' => 'edit_book', 'uses' => 'books@edit'));
Route::get('books/cetak_label/(:any)', array('as' => 'cetak_label', 'uses' => 'books@cetak_label'));
Route::post('books', 'books@create');
Route::put('books/(:any)', 'books@update');
Route::get('books/delete/(:any)', 'books@delete');
Route::post('books/create', array('uses'=>'books@create'));
Route::post('books/cari', array('as' => 'cari','uses'=>'books@cari'));
Route::post('books/update/(:any)', array('as' => 'update_book','uses'=>'books@update'));
Route::get('books/history/(:any)', array('as' => 'history_book', 'uses' => 'books@history'));

// transaction Resource
Route::get('transactions', array('as' => 'transactions', 'uses' => 'transactions@index'));
Route::get('transactions/(:any)', array('as' => 'transaction', 'uses' => 'transactions@show'));
Route::get('transactions/new', array('as' => 'new_transaction', 'uses' => 'transactions@new'));
Route::get('transactions/(:any)/edit', array('as' => 'edit_transaction', 'uses' => 'transactions@edit'));
Route::post('transactions', 'transactions@create');
Route::put('transactions/(:any)', 'transactions@update');
Route::delete('transactions/(:any)', 'transactions@destroy');
Route::get('transactions/pinjam', array('as' => 'pinjam', 'uses' => 'transactions@pinjam'));
Route::get('transactions/kembali', array('as' => 'kembali', 'uses' => 'transactions@kembali'));
Route::get('transactions/bebas_pustaka', array('as' => 'bebas_pustaka', 'uses' => 'transactions@bebas_pustaka'));
Route::post('transactions/cek', array('as' => 'cek', 'uses' => 'transactions@cek'));
Route::post('transactions/proses_pinjam', array('as' => 'proses_pinjam', 'uses' => 'transactions@proses_pinjam'));
Route::post('transactions/cek_pinjaman', array('as' => 'cek_pinjaman', 'uses' => 'transactions@cek_pinjaman'));
Route::post('transactions/cek_bebas', array('as' => 'cek_bebas', 'uses' => 'transactions@cek_bebas'));
Route::get('transactions/proses_bebas/(:any)', array('as' => 'proses_bebas', 'uses' => 'transactions@proses_bebas'));

Route::get('transactions/return/(:any)', array('as' => 'return','uses'=>'transactions@return'));
Route::get('transactions/return', array('as' => 'return_again','uses'=>'transactions@return_again'));
Route::get('transactions/extend/(:any)', array('as' => 'extend','uses'=>'transactions@extend'));
Route::get('transactions/lost/(:any)', array('as' => 'lost','uses'=>'transactions@lost'));

Route::get('transactions/cetak_bebas/(:any)', array('as' => 'cetak_bebas', 'uses' => 'transactions@cetak_bebas'));


// report Resource
Route::get('reports', array('as' => 'reports', 'uses' => 'reports@index'));
Route::get('reports/(:any)', array('as' => 'report', 'uses' => 'reports@show'));
Route::get('reports/new', array('as' => 'new_report', 'uses' => 'reports@new'));
Route::get('reports/(:any)/edit', array('as' => 'edit_report', 'uses' => 'reports@edit'));
Route::post('reports', 'reports@create');
Route::put('reports/(:any)', 'reports@update');
Route::delete('reports/(:any)', 'reports@destroy');
Route::get('reports/report_lost', array('as' => 'report_lost', 'uses' => 'reports@report_lost'));
Route::get('reports/new_entry', array('as' => 'new_entry', 'uses' => 'reports@new_entry'));
Route::get('reports/denda', array('as' => 'denda', 'uses' => 'reports@denda'));
Route::get('reports/aktivitas', array('as' => 'aktivitas', 'uses' => 'reports@aktivitas'));
Route::get('reports/grafik_denda', array('as' => 'grafik_denda', 'uses' => 'reports@grafik_denda'));
Route::get('reports/grafik', array('as' => 'grafik', 'uses' => 'reports@grafik'));
Route::get('reports/graph_book', array('as' => 'graph_book', 'uses' => 'reports@graph_book'));
Route::get('reports/graph_borrow', array('as' => 'graph_borrow', 'uses' => 'reports@graph_borrow'));
Route::get('reports/graph_charge', array('as' => 'graph_charge', 'uses' => 'reports@graph_charge'));
Route::get('reports/riwayat_buku', array('as' => 'riwayat_buku', 'uses' => 'reports@riwayat_buku'));
Route::get('reports/riwayat_anggota', array('as' => 'riwayat_anggota', 'uses' => 'reports@riwayat_anggota'));
Route::post('reports/book_trace', array('as' => 'book_trace', 'uses' => 'reports@riwayat_buku'));
Route::post('reports/member_trace', array('as' => 'member_trace', 'uses' => 'reports@riwayat_anggota'));
Route::post('reports/denda_bulanan', array('as' => 'month_charge', 'uses' => 'reports@denda'));
Route::post('reports/peminjaman_bulanan', array('as' => 'month_borrow', 'uses' => 'reports@aktivitas'));


// guest Resource
Route::get('guests', array('as' => 'guests', 'uses' => 'guests@index'));
Route::get('guests/(:any)', array('as' => 'guest', 'uses' => 'guests@show'));
Route::get('guests/new', array('as' => 'new_guest', 'uses' => 'guests@new'));
Route::get('guests/(:any)/edit', array('as' => 'edit_guest', 'uses' => 'guests@edit'));
Route::post('guests', 'guests@create');
Route::put('guests/(:any)', 'guests@update');
Route::delete('guests/(:any)', 'guests@destroy');
/*


|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

Event::listen('laravel.query',function($sql){
	var_dump($sql);
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});