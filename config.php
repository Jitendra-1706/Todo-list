<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "demo";

$link = new mysqli($server,$username,$password,$db);
if($link->connect_error){
    die("Error".$link->connect_error);
}








































?>