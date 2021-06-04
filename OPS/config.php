<?php

$db_host='localhost';
$db_name='ops';
$db_user='root';
$db_password='';

$conn_error="Connection failed";

if($con=mysqli_connect($db_host,$db_user,$db_password)){
	if(!mysqli_select_db($con,$db_name)){
		echo "Database not found";
	}
}else{
	echo "Database connection failed!";
}


?>
