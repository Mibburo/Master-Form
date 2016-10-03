<?php

$sql = "SELECT LocationType FROM contactdetailstype WHERE ConInfoType = 'Phone'";
	$result = $link->query($sql);
		$phonelocation = array();
	while ($row = mysqli_fetch_array($result)) {
  $phonelocation[] = $row['LocationType'];
	}

	
	$sqlr = "SELECT DISTINCT PrefectureName FROM prefecturescities";
	$resultr = $link->query($sqlr);
	$prefecturearray = array();
	while ($rowpre = mysqli_fetch_array($resultr)) {
		$prefecturearray[] = $rowpre['PrefectureName'];
	}

	
	$sqlemail = "SELECT LocationType FROM contactdetailstype WHERE ConInfoType = 'Email'";
	$resultemail = $link->query($sqlemail);
		$emaillocation = array();
	while ($rowemail = mysqli_fetch_array($resultemail)) {
  $emaillocation[] = $rowemail['LocationType'];
	}

	$sqladdress = "SELECT LocationType FROM contactdetailstype WHERE ConInfoType = 'Address'";
	$resultaddress = $link->query($sqladdress);
		$addresslocation = array();
	while ($rowaddr = mysqli_fetch_array($resultaddress)) {
  $addresslocation[] = $rowaddr['LocationType'];
	}
	
	
?>