<?php 
$name="localhost";
$user="root";
$pass="";
$dbname="book-shop";

$conn = mysqli_connect($name,$user,$pass,$dbname);
if(!$conn){
    die ("connection error");
}
?>