<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzloJtoo1HH766PCHEDoU66HMxEE_TW6k&callback=initMap"></script>
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
    <!--<script src="js/ie-emulation-modes-warning.js"></script>-->

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
            <li role="presentation"><a href="login.php">Home</a></li>
			<li role="presentation" class="active"><a href="vendorSpaceRegister.php">Vendor</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">SmartPark</h3>
      </div>
      <div class="jumbotron">
		<h3 class="welcome-text">Vendor Parking Space Registration</h3>
        <!-- <h1>Welcome to SmartPark! <br/>Please login to continue.</h1> -->
        <!-- <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p> -->
        <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
		<div class="register-form">
		  <form action="vendorRegisterComplete.php" method="post">
		  <p>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Parking Space Name</label>
			  <input type="text" class="form-control" name="parkingname" required></input>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Parking Space Area</label>
			  <input type="text" class="form-control" name="areaname" id="areanameid" required></input>
        <input  disabled type="text" id="lat" name="lat" class="form-control" required></input>
        <input  disabled type="text" id="lng" name="lng" class="form-control" required></input>
			</div>
			<div class="form-group">
			  <label class="control-label" for="inputDefault" >Number of Slots</label>
			  <input type="number" name="numberofslots" class="form-control" min="1" max="100" required></input>
			</div>
			<div class="form-group">
			 	<p><button class="btn btn-lg btn-success" type="submit" name="register">Register</button></p>
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
	<script async>
		var autocomplete = new google.maps.places.Autocomplete((document.getElementById('areanameid')));
		      //autocomplete.bindTo('bounds', $scope.map);
		       autocomplete.addListener('place_changed', function() {			    
			    var place = autocomplete.getPlace();
			    if (!place.geometry) {
			    	//$('#addLifeEventModal').modal('show');
			      	alert("Address entered is not valid, please enter again");
			    } else {			 
            var geocoder = new google.maps.Geocoder();
               geocoder.geocode( { 'address': place.formatted_address},  function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var destination1 = {
                          lat:results[0].geometry.location.lat(),
                          lng:results[0].geometry.location.lng()
                        };
                        document.getElementById('lat').value =  destination1.lat;     
                        document.getElementById('lng').value =  destination1.lng; 
                      } else {
                      alert("Invalid destination address, please enter again");
                    }
                  });
                
				  	alert(place.formatted_address);
			    	//$scope.correctDestinationAddress = place;
			    }
    });


	</script>
  </body>
</html>
