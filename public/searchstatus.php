<?php
/************************************************
	The Search PHP File
************************************************/


/************************************************
	MySQL Connect
************************************************/

// Credentials
$dbhost = "localhost";
$dbname = "pusdig";
$dbuser = "root";
$dbpass = "";

//	Connection
global $tutorial_db;

$tutorial_db = new mysqli();
$tutorial_db->connect($dbhost, $dbuser, $dbpass, $dbname);
$tutorial_db->set_charset("utf8");

//	Check Connection
if ($tutorial_db->connect_errno) {
    printf("Connect failed: %s\n", $tutorial_db->connect_error);
    exit();
}

/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html  = '';
$html .= '<p class="result">';

$html .= '<h5>nameString</h5>';


$html .= '</p>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $tutorial_db->real_escape_string($search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = 'SELECT  book_id from borrow_details 
			  left join borrows on borrow_details.borrow_id = borrows.id
			  WHERE book_id="'.$search_string.'" && status = "hilang" ';
	
	$querybaru = 'SELECT  book_id from borrow_details left join borrows on borrow_details.borrow_id = borrows.id 
				  WHERE book_id="'.$search_string.'" && tgl_kembali is null ';		  
	//$query = 'SELECT * FROM books WHERE  id = "'.$search_string.'"';
	$hasil = $tutorial_db->query($querybaru);
	while($hasils = $hasil->fetch_array()) {
		$hasil_array[] = $hasils;
	}

	// Do Search
	$result = $tutorial_db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {

		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<i class="icon-minus-sign icon-black"></i>&nbsp&nbsp<font face="Century Gothic" color="#ff0000"><b>Buku hilang</b></font>', $output);
		$output = str_replace('functionString', 'Sorry :(', $output);

		// Output
		echo($output);
		}
	}elseif(isset($hasil_array)){
		foreach ($hasil_array as $result) {
		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<i class="icon-minus-sign icon-black"></i>&nbsp&nbsp<font face="Century Gothic" color="#ff0000"><b>Buku sedang dipinjam</b></font>', $output);
		$output = str_replace('functionString', 'Sorry :(', $output);

		// Output
		echo($output);
		}
	}
	else{

		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<i class="icon-ok icon-black"></i>&nbsp&nbsp<font face="Century Gothic" color="green"><b>Buku tersedia</b></font>', $output);
		$output = str_replace('functionString', 'Sorry :(', $output);

		// Output
		echo($output);
	}
}


/*
// Build Function List (Insert All Functions Into DB - From PHP)

// Compile Functions Array
$functions = get_defined_functions();
$functions = $functions['internal'];

// Loop, Format and Insert
foreach ($functions as $function) {
	$function_name = str_replace("_", " ", $function);
	$function_name = ucwords($function_name);

	$query = '';
	$query = 'INSERT INTO search SET id = "", function = "'.$function.'", name = "'.$function_name.'"';

	$tutorial_db->query($query);
}
*/
?>