<?php
	require("connect.php");
	
	require("sqlddarrays.php");
	
?>
<html>  
      <head>  
           <title>Add a New Entry</title>  
           <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
		   
           
<script src="jquery-3.1.0.min.js" type="text/javascript" src="js/bootstrap.js"></script>
<script>
	function getCity(val) {
		$.ajax({
		type: "POST",
		url: "cities.php",
		data:'PrefectureName='+val,
		success: function(data){
			$("#city-list").html(data);
		}
		});
	}
	
	
	function getCityj(val, j) {
	
		$.ajax({
		type: "POST",
		url: "cities.php",
		data:'PrefectureName='+val,
		success: function(data){
			$('#citydd'+j+'').html(data);
		}
		});
	}
	
	  
	
</script>		   
      </head>  
      <body> 
           <div class="container">  
                <br />  
                <br />  
                <h2 align="center">Add a New Entry</h2>  
                <div class="form-group">  
                     <form name="add_name" action="insert.php" method="post" id="insertform"> 
                          <div class="table-responsive">  
						    <table class="table table-bordered" id="email_field">
								<tr><td>
								<input type="text" name="firstname" placeholder="Enter First Name" id="firstName" class="form-control name_list">
								</td></tr>
								<tr><td>
								<input type="text" name="lastname" id="lastName" placeholder="Enter Last Name"  class="form-control name_list">
								</td></tr>
								<tr><td>
								<input type="text" name="fathername" id="fatherName" placeholder="Enter Father's Name"  class="form-control name_list">
								</td></tr>
								<tr><td>
								<input type="text" name="ssn" id="ssn" placeholder="Enter Social Security Number"  class="form-control name_list">
								</td></tr>
								<tr><td>
								<input type="text" name="email[]" id="emailAddress" placeholder="Enter Email Address"  class="form-control name_list">
								</td>
								<td id="emaildd"><select id="emailtype" class="Form-Control InputBox emailtype" name="emailtype[]" ><?php
								foreach($resultemail as $emailtype) { ?>
								<option value="<?php echo $emailtype['LocationType']; ?> "> <?php echo $emailtype['LocationType']; ?> </option><?php } ?>  
								</select></td>
								<td><button type="button" name="addemail" id="addemail" class="btn btn-success">Add Email</button></td> 
								</tr>
							</table>
                            <table class="table table-bordered" id="dynamic_field">  
                                <tr><td>
								<input type="text" name="phoneno[]" placeholder="Enter Phone Number" id="phoneno" class="form-control name_list" />
								</td>  
                                <td id="phonedd"><select id="phonetype" name="phonetype[]" class="Form-Control InputBox phonetype">
								<?php
								foreach($result as $photype) { ?>
								<option value=" <?php echo $photype['LocationType']; ?> "> <?php echo $photype['LocationType']; ?> </option><?php } ?>  
								</select>
								<!--<select name="phone_number[][type]" id="cat" onchange="getPhones(this.value)";>
									
										</select>--> </td>
											<td><button type="button" name="add" id="add" class="btn btn-success">Add Phone</button></td>  
											</tr>  
							</table>  
							<table class="table table-bordered" id="city_field">  
								<tr>
								<td><input type="text" name="street[]" id="street" placeholder="Enter Street Address"  class="form-control address_list"></td>
								<td><input type="text" name="zipcode[]" id="zipcode" placeholder="Enter Zip Code"  class="form-control address_list"></td>
								<td id="addressdd"><select name="addresstype[]" id="addresstype" class="Form-Control InputBox" ><?php
								foreach($resultaddress as $addresstype) { ?>
								<option value="<?php echo $addresstype['LocationType']; ?> "> <?php echo $addresstype['LocationType']; ?> </option><?php } ?> </select></td>
								<td>
							
								<select required name="pref[]" id="prefecture-list" class= "Form-Control InputBox" placeholder="Select Prefecture"  onchange="getCity(this.value) ";>
								<option value="" disabled selected>Select Prefecture</option>
									<?php
										foreach($resultr as $prefecture) {
									?>
								<option value="<?php echo $prefecture["PrefectureName"]; ?>"><?php echo $prefecture["PrefectureName"]; ?></option>
									<?php
										}
									?>
								</select>
								</td>
								<td>
								<select required name="city[]" id="city-list" class="Form-Control InputBox" placeholder="Select City">
								<option value="" disabled selected>Select City</option>
								</select>
								</td>
								<td>
								<button type="button" name="addpref" id="addpref" class="btn btn-success">Add Address</button>
								</td></tr>
							</table>
							   
                               <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                     </form>  
                </div>  
           </div>  
		   
      </body>  
 </html>  
 <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript" src="js/bootstrap.min.js"></script>

 <script>  
 

$(document).ready(function(){  
      var i=1;
		var j =1;
		var e=1;
		
		var phpprefecturearray = JSON.parse('<?php echo json_encode($prefecturearray); ?>'.split(','));
		var prefarray = new Array();
		var phpphonelocarray = JSON.parse('<?php echo json_encode($phonelocation); ?>'.split(','));
		var locationarray = new Array();
		var phpemaillocarray = JSON.parse('<?php echo json_encode($emaillocation); ?>'.split(','));
		var emailarray = new Array();
		var phpaddresslocarray = JSON.parse('<?php echo json_encode($addresslocation); ?>'.split(','));
		var addressarray = new Array();

for(var h = 0; h < phpphonelocarray.length; h++) {
    var locationlist = "<option value=\"" + phpphonelocarray[h] + "\">" + phpphonelocarray[h] + "</option>";
	locationarray.push(locationlist);
}
for(var h = 0; h < phpprefecturearray.length; h++) {
    var preflist = "<option value=\"" + phpprefecturearray[h] + "\">" + phpprefecturearray[h] + "</option>";
	prefarray.push(preflist);
}
for(var h = 0; h < phpemaillocarray.length; h++) {
    var emaillist = "<option value=\"" + phpemaillocarray[h] + "\">" + phpemaillocarray[h] + "</option>";
	emailarray.push(emaillist);
}

for(var h = 0; h < phpaddresslocarray.length; h++) {
    var addresslist = "<option value=\"" + phpaddresslocarray[h] + "\">" + phpaddresslocarray[h] + "</option>";
	addressarray.push(addresslist);
}

	

      $('#add').click(function(){  
           i++;
			
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="phoneno[]" placeholder="Enter Phone Number" id="phoneno'+i+'" class="form-control name_list" /></td>\
		   <td><select id="phonetype'+i+'" name="phonetype[]" class= "Form-Control phonetype'+i+'" >'+locationarray+'</select></td>\
		   <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_premove">X</button></td>\
		   </tr>');  
		});  
	  
	 
	
      $(document).on('click', '.btn_premove', function(){  
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
		   i--;
      });  
	  
       $('#addpref').click(function(){
			j++;
			
		   $('#city_field').append('<tr id="rows'+j+'">\
		   <td><input type="text" name="street[]" id="street'+j+'" placeholder="Enter Street Address"  class="form-control address_list"></td>\
		   <td><input type="text" name="zipcode[]" id="zipcode'+j+'" placeholder="Enter Zip Code"  class="form-control address_list"></td>\
		   <td><select name="addresstype[]" class="Form-Control" id="addresstype'+j+'">'+addressarray+'</select></td>\
		   <td><select required id="'+j+'" name="pref[]" class="Form-Control" onchange="getCityj(this.value, this.id)"><option value="" disabled selected>Select Prefecture</option>'+prefarray+'</select></td>\
		   <td><select required id="citydd'+j+'" name="city[]" class="Form-Control" class="cityrow"></select></td>\
		   <td><button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_adremove">X</button></td>\
		   </tr>');
		   });
		   
		   $(document).on('click', '.btn_adremove', function(){  
           var button_id = $(this).attr("id");
           $('#rows'+button_id+'').remove();
		   
      });  
		   
		    
           
		$('#addemail').click(function(){  
           e++;
			 
           $('#email_field').append('<tr id="rowemail'+e+'"><td><input type="text" name="email[]" id="emailAddress'+e+'" placeholder="Enter Email Address" class="form-control email_list" /></td>\
		   <td><select id="emailtype'+e+'" class= "Form-Control emailtype'+e+'" name="emailtype[]" >'+emailarray+'</select></td>\
		   <td><button type="button" name="remove" id="'+e+'" class="btn btn-danger btn_eremove">X</button></td>\
		   </tr>');  
		});
		
		$(document).on('click', '.btn_eremove', function(){  
           var button_id = $(this).attr("id");
           $('#rowemail'+button_id+'').remove();
		   e--;
      });  
	  
	$('#insertform').submit(function(event){
			var alertemail= true;
			var alertphone= true;
			var alertaddress= true;
			if ( $('#firstName').val()==="" || $('#lastName').val()==="" || $('#fatherName').val()==="" || $('#ssn').val()==="" || $('#emailAddress').val()==="" || $('#phoneno').val()==="" || $('#street').val()==="" || $('#zipcode').val()==="") {
				alert("You must enter all fields")
					event.preventDefault();}
			
			for(var b=1; b<=e; b++){
				if ( $('#emailAddress'+b+'').val()===""){
					if (alertemail==true){
						alert("You must enter all Email fields")
						event.preventDefault();
						alertemail=false;
					}
				}
			}
			
			for(var m=1; m<=i; m++){
				if ( $('#phoneno'+m+'').val()===""){
					if (alertphone==true){
						alert("You must enter all Phone Fields")
						event.preventDefault();
						alertphone=false;
					}
				}
			}
			
			for(var n=1; n<=j; n++){
				if ( $('#street'+n+'').val()==="" || $('#zipcode'+n+'').val()==="" ){
					if (alertaddress==true){
						alert("You must enter all Address Fields")
						event.preventDefault();
						alertaddress=false;
					}
				}
			}
			
			
		});
    	
	});  
	
 </script>  


