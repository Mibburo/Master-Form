
<html>  
      <head>  
           <title>Search</title>  
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
                <h2 align="center">Search</h2>  
                <div class="form-group"> 
					
					 <form name="seach" action="result.php"" method="post" id="search"> 
						<div id = "searchdiv" class="table-responsive">
						<table class="table table-bordered" id="search_field">
						<tr><td><input type="text" name="searchfirstname" id="firstName" class="form-control name_list" placeholder="Search Via First Name"></td></tr>
						<tr><td><input type="text" name="searchlastname" id="lastName" class="form-control name_list" placeholder="Search Via Last Name"></td></tr>
						<tr><td><input type="text" name="searchssn" id="ssn" class="form-control name_list" placeholder="Search Via SSN"></td></tr>
						<tr><td><input type="text" name="searchemail" id="email" class="form-control name_list" placeholder="Search Via Email"></td></tr>
						<tr><td><input type="text" name="searchphoneno" id="phoneno" class="form-control name_list" placeholder="Search Via Phone Number"></td></tr>
						<tr><td><input type="text" name="searchstreet" id="street" class="form-control name_list" placeholder="Search Via Street Address"></td></tr>	
					</table>
					<input type="submit" name="submit" id="submit" class="btn btn-info" value="Search" />  
					<a href="addcontact.php">
					<button type="button" name="addcontact" id="addcontact" class="btn btn-success">Add a New Contact</button></a>
				</div>
      </body>  
 </html>  
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript" src="js/bootstrap.min.js"></script>
 