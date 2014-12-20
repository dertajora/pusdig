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

$html .= '<b>nameString</b>';


$html .= '</p>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $tutorial_db->real_escape_string($search_string);
$jumlah = $_POST['jumlah'];
$con=mysqli_connect("localhost","root","","pusdig");
if (strlen($search_string) >= 1 && $search_string !== ' ') {
for ($i=1; $i<=$jumlah; $i++){
    //$validasi = 'SELECT count(id) FROM books WHERE  id = "'.$search_string.'"';   
    $result = mysqli_query($con,'SELECT count(id) FROM books WHERE  id = "'.$search_string.'"');
    $hasil = $result;
    if ( $hasil != 0){
        $output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '&nbsp&nbsp<i class="icon-ok icon-black"></i>&nbsp&nbsp<font face="Century Gothic" color="#ff0000"><b>NIB telah terdaftar</b></font>', $output);
		$output = str_replace('functionString', 'Sorry :(', $output);

		// Output
		echo($output);
    } 
    $search_string = $search_string+1;
    }
} 
// Check Length More Than One Character



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