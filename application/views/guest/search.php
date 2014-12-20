<?php
error_reporting(0); 
$connection = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('pusdig', $connection);
$term = strip_tags(substr($_POST['searchit'],0, 100));
$term = mysql_escape_string($term); // Attack Prevention
if($term==""){

echo "<input type='text' ></input>";
echo "<input type='text' ></input>";
}
else{
$query = mysql_query("select * from members where id=$term", $connection);
$string = '';

if (mysql_num_rows($query)){
while($row = mysql_fetch_assoc($query)){
$nama = $row['nama'];
$tempat = $row['tempat_lahir'];
//$string .= $row['tempat_lahir']."</a>";
//$string .= "<br/>\n";
}

}else{
$string = "";
}

echo "<input type='text' value='$nama'></input>";
echo "<input type='text' value='$tempat'></input>";

}
?>