<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = new mysqli("localhost", "root", "", "contacts_test");
require("connect.php");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$first_name = mysqli_real_escape_string($link, $_POST['firstname']);
$last_name = mysqli_real_escape_string($link, $_POST['lastname']);
$phoneno = $_POST['phoneno'];
$email_address = $_POST['email'];
$father_name = mysqli_real_escape_string($link, $_POST['fathername']);
$ssn = mysqli_real_escape_string($link, $_POST['ssn']);
$prefecture = $_POST['pref'];
$city = $_POST['city'];
$street = $_POST['street'];
$zip_code = $_POST['zipcode'];
$locationtypephone = $_POST['phonetype'];
$locationtypeemail = $_POST['emailtype'];
$locationtypeaddress = $_POST['addresstype'];
$lengthpho = count($phoneno);
$lengthemail = count($locationtypeemail);
$lengthaddress = count($locationtypeaddress); 
// attempt insert query execution
$sql = "INSERT INTO contacts (FirstName, LastName, FatherName, SSN) VALUES ('$first_name', '$last_name', '$father_name', '$ssn')";
if (!$result = $link->query($sql))
    echo "insert failed, error: ", $link->error;
  else
    echo "last insert id in query is ", $link->insert_id, "\n";
$id = $link->insert_id;



for($key=0;$key<$lengthpho;$key++){
	echo "", $locationtypephone[$key], "", $phoneno[$key], "\n";
	$sql2 = " INSERT INTO contactdetails (ContactId, ConInfoType, LocationType, Details) VALUES ($id, 'Phone', '$locationtypephone[$key]', '$phoneno[$key]')";
if($link->multi_query($sql2)){
	
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not execute $sql2 " . $link->error;
}
	}


for($key=0;$key<$lengthemail;$key++){
$sql3 = " INSERT INTO contactdetails (ContactId, ConInfoType, LocationType, Details) VALUES ($id, 'Email', '$locationtypeemail[$key]', '$email_address[$key]')";
if($link->multi_query($sql3)){
	
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not execute $sql3 " . $link->error;
}
}

for($key=0;$key<$lengthaddress;$key++){
$sql4 = " INSERT INTO contactaddresses (ContactId, Prefecture, City, ConInfoType, LocationType, Street, ZipCode) VALUES ($id, '$prefecture[$key]', '$city[$key]', 'Address', '$locationtypeaddress[$key]', '$street[$key]', '$zip_code[$key]')";
if($link->multi_query($sql4)){
	
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not execute $sql4 " . $link->error;
}
}

header('Location:search.php');
 
// close connection
$link->close();
?>