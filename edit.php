<?php
	require("connect.php");
	require("sqlddarrays.php");
	$id = mysqli_real_escape_string($link, $_POST['id']);
	
	$k=1;
	$l=0;
	$pho=0;
	$addr=0;


$sql1 = " SELECT * FROM contacts WHERE ID='$id'";
$result1 = $link->query($sql1);

while ($rowcontacts = mysqli_fetch_assoc($result1)) {
	$firstname = mysqli_real_escape_string($link, $rowcontacts['FirstName']);
	$lastname = mysqli_real_escape_string($link, $rowcontacts['LastName']);
	$fathername = mysqli_real_escape_string($link, $rowcontacts['FatherName']);
	$ssn = mysqli_real_escape_string($link, $rowcontacts['SSN']);
}
		
	$sql4 = "SELECT * FROM contactdetails WHERE ContactId='$id' AND ConInfoType='Email'";
$result4 = $link->query($sql4);
$emailcount=array();

$sql5 = "SELECT * FROM contactdetails WHERE ContactId='$id' AND ConInfoType='Phone'";
$result5 = $link->query($sql5);
$phonecount=array();


$sql3 = "SELECT * FROM contactaddresses WHERE ContactId='$id'";
$result3 = $link->query($sql3);
$addresscount=array();
?>
<html>  
      <head>  
           <title>Edit</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
		   <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
		   
<script src="jquery-3.1.0.min.js" type="text/javascript"></script>
<script>
	function getCity(val, k) {
		$.ajax({
		type: "POST",
		url: "cities.php",
		data:'PrefectureName='+val,
		success: function(data){
			$("#city-list"+k+"").html(data);
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
                <h2 align="center">Edit</h2>  
                <div class="form-group">  
                     <form name="add_name" action="update.php" method="post" id="updateform"> 
                          <div class="table-responsive">  
						    <table class="table table-bordered" id="email_field">
							<tr><td>
								<input type="text" name="id" placeholder="Enter Id" id="id" value="<?php echo $id; ?>"class="form-control name_list" readonly>
								</td>
								<tr><td>
									<input type="text" name="firstname" placeholder="Enter First Name" id="firstName" value="<?php echo $firstname; ?>"class="form-control name_list">
								</td></tr>
								<tr><td>
									<input type="text" name="lastname" id="lastName" placeholder="Enter Last Name" value="<?php echo $lastname; ?>" class="form-control name_list">
								</td></tr>
								<tr><td>
									<input type="text" name="fathername" id="fatherName" placeholder="Enter Father's Name" value="<?php echo $fathername; ?>" class="form-control name_list">
								</td></tr>
								<tr><td>
									<input type="text" name="ssn" id="ssn" placeholder="Enter Social Security Number" value="<?php echo $ssn; ?>" class="form-control name_list">
								</td></tr>
								<?php
								while ($row4 = mysqli_fetch_assoc($result4)) { 
									$emailcount[] = $row4['Details'];
									echo'
									<tr id="emailrow',$l; echo'"><td>
										<input type="text" name="emailupdate[]" id="emailAddressup',$l; echo'" placeholder="Enter Email Address" value="', mysqli_real_escape_string($link, $row4['Details']); echo'" class="form-control name_list">
									</td>
									<td>
										<input type="hidden" name="emailid[]" id="emailAddridup" placeholder="Enter Email Address" value="', mysqli_real_escape_string($link, $row4['EphoId']); echo'" class="form-control name_list" readonly>
									</td>
									<td><select name="emailtypeupdate[]" class="Form-Control InputBox" id="emailtypeup" ><option value= "', mysqli_real_escape_string($link, $row4['LocationType']); echo'" selected>', mysqli_real_escape_string($link, $row4['LocationType']); echo'</option>';?>
								<?php
								foreach($resultemail as $emailtype) { ?>
									<option value="<?php echo $emailtype['LocationType']; ?> "> <?php echo $emailtype['LocationType']; ?> </option><?php } ?>  
									</select></td> 
										<td><button type="button" value="<?php echo mysqli_real_escape_string($link, $row4['EphoId']); ?>"  name="deleteemail[<?php echo $l; ?>]" id="<?php echo $l; ?>" class="btn btn-danger btndelemail" >Delete Row</button></td> 
									<?php $l=$l+1;} ?>
									</tr><tr>
										<td><button type="button" name="addemail" id="addemail" class="btn btn-success">Add Email</button></td> 
								</tr>
							</table>
                            
							<table class="table table-bordered" id="dynamic_field">  
                                <?php
								while ($row5 = mysqli_fetch_assoc($result5)) {
									$phonecount[] = $row5['Details'];									
									echo'
									<tr id="phonerow',$pho; echo'"><td>
										<input type="text" name="phonenoupdate[]" placeholder="Enter Phone Number"  id="phonenoup',$pho; echo'" value="', mysqli_real_escape_string($link, $row5['Details']); echo'" class="form-control name_list" />
									</td>
									<td>
										<input type="hidden" name="phoneid[]" placeholder="Enter Phone Number" value="', mysqli_real_escape_string($link, $row5['EphoId']); echo'" class="form-control name_list" readonly />
									</td>
										<td><select name="phonetypeupdate[]" class="Form-Control InputBox" id="phonetypeup" ><option value= "', mysqli_real_escape_string($link, $row5['LocationType']); echo'" selected>', mysqli_real_escape_string($link, $row5['LocationType']); echo'</option>';?>
									<?php
									foreach($result as $photype) { ?>
										<option value=" <?php echo $photype['LocationType']; ?> "> <?php echo $photype['LocationType']; ?> </option><?php } ?>  
										</select></td>  
										<td><button type="button" name="deletephone[<?php echo $pho; ?>]" value="<?php echo mysqli_real_escape_string($link, $row5['EphoId']); ?>"id="<?php echo $pho; ?>" class="btn btn-danger btndelpho">Delete Row</button></td>
								<?php $pho=$pho+1;} ?>
									</tr><tr>
										<td><button type="button" name="addphone" id="addphone" class="btn btn-success">Add Phone</button></td> 
									</tr>
							</table>  
							
							<table class="table table-bordered" id="city_field"> 
								<?php
								while ($row3 = mysqli_fetch_assoc($result3)) { 
									$addresscount[] = $row3['Street'];
									echo'							
										<tr id="addrrow',$addr; echo'">
											<td><input type="text" name="streetupdate[]" id="streetup',$addr; echo'" placeholder="Enter Street Address" value="', mysqli_real_escape_string($link, $row3['Street']); echo'" class="form-control address_list"></td>
											<td><input type="hidden" name="addrid[]" id="streetup" placeholder="Enter Street Address" value="', mysqli_real_escape_string($link, $row3['AddrId']); echo'" class="form-control address_list" readonly></td>
											<td><input type="text" name="zipcodeupdate[]" id="zipcodeup',$addr; echo'" placeholder="Enter Zip Code" value="', mysqli_real_escape_string($link, $row3['ZipCode']); echo'" class="form-control address_list"></td>
									  <td><select name="addresstypeupdate[]" class="Form-Control InputBox" id="addresstypeup")"><option value= "', mysqli_real_escape_string($link, $row3['LocationType']); echo'" selected>', mysqli_real_escape_string($link, $row3['LocationType']); echo'</option>';?>
									<?php
									foreach($resultaddress as $addresstype) { ?>
										<option value="<?php echo $addresstype['LocationType']; ?> "> <?php echo $addresstype['LocationType']; ?> </option><?php } ?>  
										</select></td> 
									<td>
										<select name="prefupdate[]" id="prefecture-list" class= "Form-Control InputBox" placeholder="Select Prefecture" onchange="getCity(this.value,  <?php echo $k; ?>)";>
										<option value="<?php echo mysqli_real_escape_string($link, $row3['Prefecture'])?>" selected ><?php echo mysqli_real_escape_string($link, $row3['Prefecture']) ?></option>
										<?php
											foreach($resultr as $prefecture) {
										?>
												<option value="<?php echo $prefecture["PrefectureName"];?> "> <?php echo $prefecture["PrefectureName"]; ?></option>
											<?php
												}
											?>
										</select>
										</td>
										<td> <?php echo'
										<select name="cityupdate[]" id="city-list',$k; echo'" class="Form-Control InputBox" placeholder="Select City">';?>
										<option value="<?php echo mysqli_real_escape_string($link, $row3['City'])?>" selected><?php echo mysqli_real_escape_string($link, $row3['City']) ?></option>
										</select>
										</td>
									<td><button type="button" value="<?php echo mysqli_real_escape_string($link, $row3['AddrId']);?>" name="deleteaddress[<?php echo $addr; ?>]" id="<?php echo $addr; ?>" class="btn btn-danger btndeladdr">Delete Row</button></td>
								<?php $k= $k+1; 
								$addr= $addr+1;} ?>
								</tr><tr>
								<td>
								<button type="button" name="addpref" id="addpref" class="btn btn-success">Add Address</button>
								</td></tr>
							</table>
							   
                               <input type="submit" name="submit" id="submit" class="btn btn-info" value="Update" />
								<input type="submit" formaction="deletecontact.php" id="delcontact" class="btn btn-danger" value="Delete Contact" onclick="return confirm('You are about to delete a contact, this cannot be undone, continue?')" />
                          </div>  
                     </form>  
                </div>  
           </div>  
      </body>  
 </html>  
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
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
		var phpemailcount = JSON.parse('<?php echo json_encode($emailcount); ?>'.split(','));
		var phpphonecount = JSON.parse('<?php echo json_encode($phonecount); ?>'.split(','));
		var phpaddresscount = JSON.parse('<?php echo json_encode($addresscount); ?>'.split(','));
		
		var emcount = phpemailcount.length;
		var phocount = phpphonecount.length;
		var addrcount = phpaddresscount.length;

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

	
	$(".btndelemail").click(function() {
		var emailid= $(this).attr("value");
		var buttonid= $(this).attr("name");
		var rowid= $(this).attr("id");
		if (confirm("You are about to delete an entry, this cannot be undone, continue?")){
		$.ajax({
		type: "POST",
		url: "deleterow.php",
		data: 'emailid='+emailid+'&deletemail='+buttonid,
		success: function(data){
			$('#emailrow'+rowid+'').remove();
		}
		});
		}
	});
	
	$(".btndelpho").click(function() {
		var phoneid= $(this).attr("value");
		var buttonid= $(this).attr("name");
		var rowid= $(this).attr("id");
		if (confirm("You are about to delete an entry, this cannot be undone, continue?")){
		$.ajax({
		type: "POST",
		url: "deletephonerow.php",
		data: 'phoneid='+phoneid+'&deletephone='+buttonid,
		success: function(data){
			$('#phonerow'+rowid+'').remove();
		}
		});
		}
	});
	
	$(".btndeladdr").click(function() {
		var addrid= $(this).attr("value");
		var buttonid= $(this).attr("name");
		var rowid= $(this).attr("id");
		if (confirm("You are about to delete an entry, this cannot be undone, continue?")){
		$.ajax({
		type: "POST",
		url: "deleteaddrrow.php",
		data: 'addrid='+addrid+'&deleteaddress='+buttonid,
		success: function(data){
			$('#addrrow'+rowid+'').remove();
		}
		});
		}
	});

      $('#addphone').click(function(){  
           i++;
			
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="phonenoinsert[]" id="phoneno'+i+'" placeholder="Enter Phone Number" class="form-control name_list" /></td><td></td>\
		   <td><select id="phonetype'+i+'" name="phonetypeinsert[]" class= "Form-Control phonetype'+i+'" >'+locationarray+'</select></td>\
		   <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_premove">X</button></td>\
		   </tr>');  
		});  
	  
	 
	
      $(document).on('click', '.btn_premove', function(){  
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
		   
      });  
	  
       $('#addpref').click(function(){
			j++;
			
		   $('#city_field').append('<tr id="rows'+j+'">\
		   <td><input type="text" name="streetinsert[]" id="street'+j+'" placeholder="Enter Street Address"  class="form-control address_list"></td><td></td>\
		   <td><input type="text" name="zipcodeinsert[]" id="zipcode'+j+'" placeholder="Enter Zip Code"  class="form-control address_list"></td>\
		   <td><select name="addresstypeinsert[]" class="Form-Control" id="addresstype'+j+'">'+addressarray+'</select></td>\
		   <td><select required id="pref'+j+'" name="prefinsert[]" class="Form-Control" onchange="getCityj(this.value, '+j+')"><option value="" disabled selected>Select Prefecture</option>'+prefarray+'</select></td>\
		   <td><select required id="citydd'+j+'" name="cityinsert[]" class="Form-Control" class="cityrow"></select></td>\
		   <td><button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_adremove">X</button></td>\
		   </tr>');
		   });
		   
		   $(document).on('click', '.btn_adremove', function(){  
           var button_id = $(this).attr("id");
           $('#rows'+button_id+'').remove();
		   
      });  
		   
		    
           
		$('#addemail').click(function(){  
           e++;
			
           $('#email_field').append('<tr id="rowemail'+e+'"><td><input type="text" name="emailinsert[]" placeholder="Enter Email Address" class="form-control email_list" /></td><td></td>\
		   <td><select id="emailtype'+e+'" class= "Form-Control emailtype'+e+'" name="emailtypeinsert[]" >'+emailarray+'</select></td>\
		   <td><button type="button" name="remove" id="'+e+'" class="btn btn-danger btn_eremove">X</button></td>\
		   </tr>');  
		});
		
		$(document).on('click', '.btn_eremove', function(){  
           var button_id = $(this).attr("id");
           $('#rowemail'+button_id+'').remove();
		  
      });  
	  
	  $('#updateform').submit(function(event){
			var alertemail= true;
			var alertphone= true;
			var alertaddress= true;
			if ( $('#firstName').val()==="" || $('#lastName').val()==="" || $('#fatherName').val()==="" || $('#ssn').val()==="" || $('#emailAddressup').val()==="" || $('#phoneno').val()==="" || $('#streetup').val()==="" || $('#zipcodeup').val()==="") {
				alert("You must enter all fields")
					event.preventDefault();}
					
			for(var z=1; z<=emcount; z++){
				if ( $('#emailAddressup'+z+'').val()===""){
					if (alertemail==true){
						alert("You must enter all Email fields")
						event.preventDefault();
						alertemail=false;
					}
				}
			}		
			
			for(var phoinc=1; phoinc<=phocount; phoinc++){
				if ( $('#phonenoup'+phoinc+'').val()===""){
					if (alertphone==true){
						alert("You must enter all Phone fields")
						event.preventDefault();
						alertphone=false;
					}
				}
			}	
			
			for(var addrinc=1; addrinc<=addrcount; addrinc++){
				if ( $('#streetup'+addrinc+'').val()==="" || $('#zipcodeup'+addrinc+'').val()==="" ){
					if (alertaddress==true){
						alert("You must enter all Address Fields")
						event.preventDefault();
						alertaddress=false;
					}
				}
			}
			
			for(var b=1; b<=e; b++){
				if ( $('#emailinsert'+b+'').val()===""){
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