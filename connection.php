<?php

$con = mysqli_connect('localhost','root','','services');

if(!$con)
{
    die("Cannot connect to database".mysqli_connect_error());
}

// defining image path
define("UPLOAD_SRC",$_SERVER['DOCUMENT_ROOT']."/online_services/uploads/");

// for reading image
define("FETCH_SRC","http://127.0.0.1/online_services/uploads/");

?>