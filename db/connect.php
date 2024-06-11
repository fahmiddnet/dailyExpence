<?php 

define('HOST','localhost');
define('USER_NAME','fahmid');
define('USER_PASS','123456');
define('DB_NAME','daily_expence');

$conn = new mysqli(HOST,USER_NAME,USER_PASS,DB_NAME);

if($conn->connect_error ){
    die("Connection failed:" .$con->connect_error);
} else{
    // echo "connection successfull";
}

?>