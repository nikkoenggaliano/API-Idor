<?php 
session_start();
$conn = mysqli_connect("localhost","root","","idor");
if(!$conn){
	die('Error');
}


