<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = new mysqli("localhost", "root", "", "contacts_test");
require("connect.php");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$rowid = mysqli_real_escape_string($link,$_POST['deletemail']);
$emailid = mysqli_real_escape_string($link,$_POST['emailid']);
$lengthemailid = count($emailid);

$sqldelemail = "DELETE FROM contactdetails WHERE EphoId='$emailid'";
	
$link->query($sqldelemail);


?>