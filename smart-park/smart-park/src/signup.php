<?php
$flag=0;
?>
<?php
if(isset($_POST['signup']))
{
require_once('./dbconnect.php');
session_start(); 

$username = $_POST['username']; 
$email = $_POST['email'];
$password = $_POST['password']; 
$category = $_POST['category'];
$vendor = $_POST['vendor'];
 
echo  $username;
echo $email;
echo $password;
echo $category;
echo $vendor;

$sql="INSERT INTO parking_user (name,emailid,password,category,type) VALUES ('$username','$email','$password','$category','$vendor')";
if(mysql_query($sql)) 
{
	 header("Location:http://localhost/smart-park/smart-park/src/login.php");
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
            <li role="presentation" class="active"><a href="login.php">Home</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">SmartPark</h3>
      </div>
      <div class="jumbotron">
		<h3 class="welcome-text">Sign Up</h3>
        <!-- <h1>Welcome to SmartPark! <br/>Please login to continue.</h1> -->
        <!-- <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p> -->
        <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
		<div class="login-form">
		  <form action="" method="post">
		  <p>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Name</label>
			  <input type="text" class="form-control" name="username" required>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >User ID / Email</label>
			  <input type="text" class="form-control" name="email" required>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Password</label>
			  <input type="password" class="form-control" name="password" required>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Category</label>
			  <input type="text" class="form-control" name="category" required>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Vendor</label>
			  <input type="password" class="form-control" name="vendor" required>
			</div>
			<div class="form-group">
			 	<p><button class="btn btn-lg btn-success" type="submit" name="signup">Sign Up</button></p>
			</div>
		  </p>
		  
		</div>
		</form>
      </div>
	  
      <!-- <div class="row marketing"> -->
      <!--   <div class="col-lg-6"> -->
      <!--     <h4>Subheading</h4> -->
      <!--     <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p> -->

      <!--     <h4>Subheading</h4> -->
      <!--     <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p> -->

      <!--     <h4>Subheading</h4> -->
      <!--     <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p> -->
      <!--   </div> -->

      <!--   <div class="col-lg-6"> -->
      <!--     <h4>Subheading</h4> -->
      <!--     <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p> -->

      <!--     <h4>Subheading</h4> -->
      <!--     <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p> -->

      <!--     <h4>Subheading</h4> -->
      <!--     <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p> -->
      <!--   </div> -->
      <!-- </div> -->

      <footer class="footer">
        <p>&copy; SmartPark 2015</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
