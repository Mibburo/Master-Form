<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = new mysqli("localhost", "root", "", "contacts_test");
require("connect.php");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$id = mysqli_real_escape_string($link,$_POST['id']);

$sqldeladdr = "DELETE FROM contacts WHERE ID='$id'";
	
$link->query($sqldeladdr);

header('Location:search.php');
?>