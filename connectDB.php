<?php
$server = "localhost";
$mysqluser = "root";
$mysqlpass = "";
$mysqldb = "sarisari";

$conn = mysqli_connect($server,$mysqluser,$mysqlpass,$mysqldb);

//stop php if cannot connect to
if(!$conn)
{
  die("Failed to connect to MySQL----: " . mysqli_connect_error() );
 
}
?>