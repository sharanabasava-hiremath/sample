<?php
if(isset($_POST['register']))
{
require_once('./dbconnect.php');
session_start(); 

$username = $_SESSION["username"];
$area = $_POST['areaname']; 
$parking_name = $_POST['parkingname'];
$number_of_slots = $_POST['numberofslots'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$pricePerHour = $_POST['pricePerHour'];
$slotname = $_POST['slotname'];
echo $lng;
echo $lat;
echo $area;
echo $parking_name;
echo $number_of_slots;

$sql="SELECT userid from parking_user where emailid='$username'";
	$result = mysql_query($sql) or die(mysql_error());
	//echo $slot_id;
	//echo $username;
	$user_id = mysql_fetch_assoc($result)["userid"];
	
	
$sql="INSERT INTO parking_space (vendor_id,parking_space_name,parking_space_desc,lat,lng, price_per_hour, capacity) VALUES ('$user_id','$parking_name','$area',$lat,$lng, $pricePerHour, $number_of_slots)";
if(mysql_query($sql)) 
{
	$parkingspace_id = mysql_insert_id();
	for($i=1; $i<=$number_of_slots;$i++) {
		$sql = "insert into slot (parkingspace_id,slot_name, floor, type, is_free) values (".$parkingspace_id.",'".$slotname.$i."',1,1,0);";
		$result = mysql_query($sql) or die(mysql_error()); 
	}
	 setcookie("Registration", $area.":".$parking_name.":".$number_of_slots, time()+3600);
	 header("Location:http://localhost/smart-park/smart-park/src/vendorRegisterSuccess.php");
}
	
else
{
	die(mysql_error());
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script>
	
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'address': <<enteredAddress>>},  function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				    var destination1 = {
				    	lat:results[0].geometry.location.lat(),
				    	lng:results[0].geometry.location.lng()
				    };
                            else {
		alert("Invalid destination address, please enter again");
	}
	</script>
</head>
<body>
</body>
</html>


