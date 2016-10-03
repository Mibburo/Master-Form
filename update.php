<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = new mysqli("localhost", "root", "", "contacts_test");
require("connect.php");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$id = mysqli_real_escape_string($link, $_POST['id']);
$first_name = mysqli_real_escape_string($link, $_POST['firstname']);
$last_name = mysqli_real_escape_string($link, $_POST['lastname']);
$phonenoupdate = $_POST['phonenoupdate'];
$phonenoid = $_POST['phoneid'];
$emailupdate = $_POST['emailupdate'];
$emailid = $_POST['emailid'];
$father_name = mysqli_real_escape_string($link, $_POST['fathername']);
$ssn = mysqli_real_escape_string($link, $_POST['ssn']);
$prefectureupdate = $_POST['prefupdate'];
$cityupdate = $_POST['cityupdate'];
$streetupdate = $_POST['streetupdate'];
$streetid = $_POST['addrid'];
$zip_codeupdate = $_POST['zipcodeupdate'];
$locationtypephoneupdate = $_POST['phonetypeupdate'];
$locationtypeemailupdate = $_POST['emailtypeupdate'];
$locationtypeaddressupdate = $_POST['addresstypeupdate'];
$lengthphoupdate = count($phonenoupdate);
$lengthemailupdate = count($locationtypeemailupdate);
$lengthaddressupdate = count($locationtypeaddressupdate); 

$sqlcontactupd = "UPDATE contacts SET FirstName='$first_name', LastName='$last_name', FatherName='$father_name', SSN='$ssn' WHERE ID='$id' ";
$ressqlcontactupd = $link->query($sqlcontactupd);
if ($ressqlcontactupd ){
	//$ressqlcontactupd->close();
if  (mysqli_more_results($link)){
$link->next_result();}
echo "Update successful";
}else{
  echo "ERROR: Could not execute $sqlcontactupd ", $link->error;
  }

for($key=0;$key<$lengthphoupdate;$key++){
$sqlphoneupd = "UPDATE contactdetails SET LocationType='$locationtypephoneupdate[$key]', Details='$phonenoupdate[$key]' WHERE ContactId='$id' AND ConInfoType='Phone' AND EphoId='$phonenoid[$key]'";

if ($link->multi_query($sqlphoneupd)){
	if  (mysqli_more_results($link)){
    $link->next_result();}
echo "Update successful";
}else{
  echo "ERROR: Could not execute $sqlphoneupd ", $link->error;
}
} 

for($key=0;$key<$lengthemailupdate;$key++){
$sqlemailupd = "UPDATE contactdetails SET LocationType='$locationtypeemailupdate[$key]', Details='$emailupdate[$key]' WHERE ContactId='$id' AND ConInfoType='Email' AND EphoId='$emailid[$key]' ";
if ($link->multi_query($sqlemailupd)){
    if  (mysqli_more_results($link)){
    $link->next_result();}
echo "Update successful";
}else{
  echo "ERROR: Could not execute $sqlemailupd ", $link->error;
}
}

for($key=0;$key<$lengthaddressupdate;$key++){
$sqladdressupd = "UPDATE contactaddresses SET Prefecture='$prefectureupdate[$key]',City='$cityupdate[$key]', LocationType='$locationtypeaddressupdate[$key]',Street='$streetupdate[$key]', ZipCode='$zip_codeupdate[$key]' WHERE ContactId='$id' AND AddrId='$streetid[$key]'";
if ($ressqladdressupd = $link->multi_query($sqladdressupd)){
    if  (mysqli_more_results($link)){
    $link->next_result();}
echo "Update successful";
}else{
  echo "ERROR: Could not execute $sqladdressupd ", $link->error;
}
}
  
if (!empty($_POST['phonenoinsert'])){
	$locationtypephoneinsert = $_POST['phonetypeinsert'];
	$phonenoinsert = $_POST['phonenoinsert'];
	$lengthphoinsert = count($phonenoinsert);
	
	for($key=0;$key<$lengthphoinsert;$key++){
	echo "", $locationtypephoneinsert[$key], "", $phonenoinsert[$key], "\n";
	$sqlphoins = " INSERT INTO contactdetails (ContactId, ConInfoType, LocationType, Details) VALUES ($id, 'Phone', '$locationtypephoneinsert[$key]', '$phonenoinsert[$key]')";
if($ressqlphoins = $link->multi_query($sqlphoins)){
	if  (mysqli_more_results($link)){
    $link->next_result();}
	
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not execute $sqlphoins " . $link->error;
}
}

}

if (!empty($_POST['emailinsert'])){
	$emailinsert = $_POST['emailinsert'];
	$locationtypeemailinsert = $_POST['emailtypeinsert'];
	$lengthemailinsert = count($locationtypeemailinsert);
	
	for($key=0;$key<$lengthemailinsert;$key++){
$sqlemailins = " INSERT INTO contactdetails (ContactId, ConInfoType, LocationType, Details) VALUES ($id, 'Email', '$locationtypeemailinsert[$key]', '$emailinsert[$key]')";
if($ressqlemailins = $link->multi_query($sqlemailins)){
if  (mysqli_more_results($link)){
    $link->next_result();}
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not execute $sqlemailins " . $link->error;
}
}
	
}

if (!empty($_POST['streetinsert'])){
	$prefectureinsert = $_POST['prefinsert'];
	$cityinsert = $_POST['cityinsert'];
	$streetinsert = $_POST['streetinsert'];
	$zip_codeinsert = $_POST['zipcodeinsert'];
	$locationtypeaddressinsert = $_POST['addresstypeinsert'];
	$lengthaddressinsert = count($locationtypeaddressinsert);
	
	for($key=0;$key<$lengthaddressinsert;$key++){
$sqladdins = " INSERT INTO contactaddresses (ContactId, Prefecture, City, ConInfoType, LocationType, Street, ZipCode) VALUES ($id, '$prefectureinsert[$key]', '$cityinsert[$key]', 'Address', '$locationtypeaddressinsert[$key]', '$streetinsert[$key]', '$zip_codeinsert[$key]')";
if($ressqladdins = $link->multi_query($sqladdins)){
	if  (mysqli_more_results($link)){
    $link->next_result();}
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not execute $sqladdins " . $link->error;
}
}
	
}


?>