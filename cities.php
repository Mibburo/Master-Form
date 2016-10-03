<?php
require("connect.php");

if (!empty($_POST["PrefectureName"])){
	$sql= "SELECT CityName FROM prefecturescities WHERE PrefectureName='" . $_POST["PrefectureName"] . "'";
	$result = $link->query($sql);
?>
	<option value="" disabled selected>Select City</option>
<?php
    foreach($result as $city) {
?>
	<option value="<?php echo $city['CityName']; ?>"><?php echo $city['CityName']; ?></option>
	<?php
    }
} 
?>
