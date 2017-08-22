<?php
//ปิด Notice: Undefined
error_reporting (E_ALL ^ E_NOTICE);

$host = ""; //host
$user = ""; //user
$pass = ""; //pass
$db = ""; //db

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
die("Connection Database failed: ");
}

else {
mysqli_set_charset($conn, "utf8");
date_default_timezone_set('Asia/Bangkok');

}
?>





