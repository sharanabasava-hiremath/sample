<?php 
	require_once('./dbconnect.php');
	
	$location_id = $_GET['locationid'];
	//echo $location_id;
	
	$sql = "select parking_space_name, parking_space_desc from parking_space where parkingspace_id=".$location_id;	
	$result = mysql_query($sql) or die(mysql_error());
		
		$locationData = mysql_fetch_assoc($result);	

	$query2 = "select slot_id from slot where parkingspace_id=".$location_id." and is_free=0 limit 15;";
	$result = mysql_query($query2) or die(mysql_error());
		$slotData = array();
		while ($row = mysql_fetch_assoc($result)) 
		{
			array_push($slotData, $row);
		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Narrow Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="bootswatch/paper/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

	<!-- Custom styles for SmartPark -->
    <link href="css/style.css" rel="stylesheet">
	
	<!-- beautiful fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300" rel="stylesheet" type="text/css">
	
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="login.php">Home</a></li>
			
			 
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">SmartPark</h3>
      </div>
      <div class="jumbotron">
		<h4>Parking Lot: <?= $locationData['parking_space_desc'] ?></h4>
			<h4>Area: <?= $locationData['parking_space_name'] ?></h4>
		<table>
			<?php 
			for($i=0; $i<count($slotData);$i++) {
				echo '<tr style="margin-bottom:10px">';									
				echo '<td style="margin-right:15px">'.$slotData[$i]['slot_id'].'</td>';
				//echo '<td style="margin-right:15px"><button class="btn btn-xs btn btn-lg btn-success" onclick="reverseSlot('.$slotData[$i]['slot_id'].')">Book Slot</td>';
				echo '<td style="margin-right:15px"><a href="./bookingPage.php?slotid='.$slotData[$i]['slot_id'].'"><button type="submit" class="btn btn-default btn btn-lg btn-success pull-right" style="margin-right:10px; margin-bottom:20px" >Book Slots</button></a></td>';
				echo '</tr>';
				
			}
			?>
		</table>
      </div>	  
      <footer class="footer">
        <p>&copy; SmartPark 2015</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>