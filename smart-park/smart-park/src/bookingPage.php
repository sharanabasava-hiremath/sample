<?php 
	require_once('./dbconnect.php');
	session_start();
		$flag=0;
	$slot_id = $_GET['slotid'];
	$username = $_SESSION["username"];
	
	
	$sql="SELECT parkingspace_id from slot where slot_id='$slot_id'";
	$result = mysql_query($sql) or die(mysql_error());
	$parking_id = mysql_fetch_assoc($result)["parkingspace_id"];
	
	$sql="SELECT * from parking_space where parkingspace_id='$parking_id'";
	$result = mysql_query($sql) or die(mysql_error());
	
	while ($row = mysql_fetch_array ($result))
	{
	$parking_space_name = $row["parking_space_name"];
	$parking_space_desc = $row["parking_space_desc"];
	}
	
	//echo $parking_space_name;
	//echo $parking_space_desc;
	
	$sql="SELECT userid from parking_user where emailid='$username'";
	$result = mysql_query($sql) or die(mysql_error());
	//echo $slot_id;
	//echo $username;
	$user_id = mysql_fetch_assoc($result)["userid"];
	$sql="UPDATE sensor_value SET user_id = '$user_id', user_value=1 WHERE slot_id = '$slot_id'";
	//echo $sql;
	$result = mysql_query($sql) or die(mysql_error());
?>
<?php

	if(isset($_POST['bill']))
	{
		require_once('./dbconnect.php');
		
		$sql="SELECT userid from parking_user where emailid='$username'";
		$result = mysql_query($sql) or die(mysql_error());
		//echo $slot_id;
		//echo $username;
		$user_id = mysql_fetch_assoc($result)["userid"];
		$user_id=1;
		$sql = "SELECT TIMEDIFF(exit_time,entry_time) as diff from activity_log where user_id='$user_id' order by exit_time desc limit 1";
		$result=mysql_query($sql);
		
		$sql2 = "SELECT price_per_hour from parking_space where parkingspace_id =".$parking_id;
		$result2=mysql_query($sql2);
		$charge = mysql_fetch_assoc($result2);
		//echo $result;
		 if($result)
		 {
		$temp = mysql_fetch_assoc($result);
		$diff = $temp["diff"];
		$diff= $diff*intval($charge);
		
		//$exit = $temp["exit_time"];
		
		//echo "exit".$exit;	
		$flag=1;
		 }
		else
		{
			$flag=2;
		}
		
		
		
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
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">SmartPark</h3>
      </div>

      <div class="jumbotron">
        <h3>Your booking details are as follows</h3>
        
      

      <div class="row marketing">
        
          <h4> </h4>
		  <?php
			echo '<h4>Slot Number : '.$slot_id." </br>Parking Lot : ".$parking_space_name." </br>Area : ".$parking_space_desc.'</h4>';
		  ?>
		  <form action="" method="post">
		  <div class="form-group">
		  <div class="form-group">
			 	<p><button class="btn btn-lg btn-success" type="submit" name="bill" style="margin-right:10px">Bill Details</button>
		</div>
		<?php
		if($flag==1)
		{
			echo "<p>You have been charged ".$diff." dollars</p>";
		}
		if($flag==2)
		{
			echo '<p>No bill has been generated yet</p>';
		}
		?>
		</div>
		</form>
         
      </div>
		
      <footer class="footer">
        <p>&copy; SmartPark 2015</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
