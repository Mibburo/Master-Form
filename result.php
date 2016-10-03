<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = new mysqli("localhost", "root", "", "contacts_test");
require("connect.php");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



if (empty($_POST['searchssn'])){
$ssn ='';}
else {$ssn = mysqli_real_escape_string($link, $_POST['searchssn']);}
if (empty($_POST['searchfirstname'])){
$firstname ='';}
	else{
$firstname = mysqli_real_escape_string($link, $_POST['searchfirstname']);
}
if (empty($_POST['searchlastname'])){
$lastname ='';}
	else{
$lastname = mysqli_real_escape_string($link, $_POST['searchlastname']);
}
if (empty($_POST['searchemail'])){
$email ='';}
	else{
$email = mysqli_real_escape_string($link, $_POST['searchemail']);
}
if (empty($_POST['searchphoneno'])){
$phoneno ='';}
	else{
$phoneno = mysqli_real_escape_string($link, $_POST['searchphoneno']);
}

if (empty($_POST['searchstreet'])){
$street ='';}
	else{
$street = mysqli_real_escape_string($link, $_POST['searchstreet']);
}

$sql = " SELECT DISTINCT ID, FirstName, LastName, FatherName, SSN 
			FROM contacts INNER JOIN contactdetails 
			ON contacts.ID=contactdetails.ContactId 
			INNER JOIN contactaddresses 
			ON contacts.ID=contactaddresses.ContactId 
			WHERE contacts.SSN LIKE '%$ssn%' 
			AND contacts.FirstName LIKE '%$firstname%' 
			AND contacts.LastName LIKE '%$lastname%'
			AND contactdetails.Details LIKE '%$email%'
			AND contactdetails.Details LIKE '%$phoneno%'
			AND contactaddresses.Street LIKE '%$street%'
			 ";
			
$result = $link->query($sql);
?>

<html>  
      <head>  
           <title>Search Results</title>  
		   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           
<script src="jquery-3.1.0.min.js" type="text/javascript" src="js/bootstrap.js"></script>
	   
        </head>  
        <body>
	    <div class="container">  
                <br />  
                <br />  
                <h2 align="center">Search Results</h2>  
                <?php 
					while($contacts = $result->fetch_assoc()) {
						echo '
				<div class="form-group">  
                     <form name="resultform[]" action="edit.php" method="post" id="resultform"> 
                        <div class="table-responsive">  
						    <table class="table table-bordered" id="email_field">
							<thead class="thead-inverse">
								<tr>
								  <th>ID</th>
								  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Father Name</th>
								  <th>SSN</th>
								</tr>
							  </thead>
							<tbody><tr>
								<td><input type="text" name="id" id="id" class="form-control name_list" value="', mysqli_real_escape_string($link, $contacts['ID']); echo'" readonly></td>
								<td><input type="text" name="firstname" id="firstName" class="form-control name_list" value="', mysqli_real_escape_string($link, $contacts['FirstName']); echo'" readonly></td>
								<td><input type="text" name="lastname" id="lastName" value="', mysqli_real_escape_string($link, $contacts['LastName']); echo'" class="form-control name_list" readonly></td>
								<td><input type="text" name="fathername" id="fatherName" value="', mysqli_real_escape_string($link, $contacts['FatherName']); echo'" class="form-control name_list" readonly></td>
								<td><input type="text" name="SSN" id="ssn" value="', mysqli_real_escape_string($link, $contacts['SSN']); echo'" class="form-control name_list" readonly></td>
								<td><input type="submit" name="submit',mysqli_real_escape_string($link, $contacts['ID']); echo'"" id="submit" class="btn btn-info" value="Edit" /></td>  
							</tbody></tr>
							
							</table>
						</div>
						</form>';
					}?>
					
		</body>  
 </html>  
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript" src="js/bootstrap.min.js"></script>
