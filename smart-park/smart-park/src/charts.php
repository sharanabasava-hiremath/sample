<?php
		require_once('./dbconnect.php');
		//echo "check";
	 	if (isset($_POST['submit'])) {
			//echo "submitted";
		 	date_default_timezone_set('America/Los_Angeles');

		 	$endDate = date("Y-m-d",strtotime($_POST["endDate"]));	 	
		 	$startDate = date("Y-m-d",strtotime($_POST["startDate"]));	 	
		 	$units = $_POST["units"];
		 	$unitsDisplay = $_POST["units"];
		 	if($units=="month") {
		 		$unitsDisplay = "monthname";
		 	}
		 	if(strtotime($_POST["endDate"])<strtotime($_POST["startDate"])) {
		 		echo 'Invalid date selection';
		 	} else {
		 		//require instead of code
				if($_POST['locationid']==-1) {
				 	
		 		
				$sql = "SELECT ".$unitsDisplay."(exit_time) as d, sum(charge) as charge, count(*) as total_vehicles FROM activity_log INNER JOIN slot ON slot.slot_id = activity_log.slot_id INNER JOIN parking_space l ON l.parkingspace_id = slot.parkingspace_id
							WHERE activity_log.entry_time >= '".$startDate."'
							AND activity_log.exit_time <= '".$endDate."'
							AND activity_log.charge IS NOT NULL
							GROUP BY ".$units."(d) ORDER BY ".$units."(d);";
				}
				else{
					$sql = "SELECT ".$unitsDisplay."(exit_time) as d, sum(charge) as charge, count(*) as total_vehicles FROM activity_log INNER JOIN slot ON slot.slot_id = activity_log.slot_id INNER JOIN parking_space l ON l.parkingspace_id = slot.parkingspace_id
							WHERE activity_log.entry_time >= '".$startDate."'
							AND activity_log.exit_time <= '".$endDate."'
							AND activity_log.charge IS NOT NULL
							AND l.parkingspace_id = ".$_POST['locationid']."
							GROUP BY ".$units."(d) ORDER BY ".$units."(d);";
					
				}

				//echo $query;
				$result = mysql_query($sql) or die(mysql_error());
				$resultData = array();
				while ($row = mysql_fetch_assoc($result)) 
				{
					array_push($resultData, $row);
				}
				//var_dump($resultData);
	 	}
	 }
?>	
<html>
<head>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="js/highcharts.js"></script>
	<script src="js/exporting.js"></script>
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
    
<script type="text/javascript">

		var chartData = <?php echo json_encode($resultData); ?>;
		var categoryNames = new Array();
		var values = new Array();
		var total = new Array();
		for(var i=0; i<chartData.length; i++) {
			categoryNames.push(chartData[i]['d']);
			values.push(parseInt(chartData[i]['charge']));	
			total.push(parseInt(chartData[i]['total_vehicles']));
		}
		//console.log(JSON.stringify(categoryNames));
		
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Revenue Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: categoryNames,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Total revenue',
            data: values
        }]
    });
	$('#container2').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Vehicle Count Statistics'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            categories: categoryNames,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            /*y: 80,*/
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Total Vehicles',
            data: total
        }]
    })
    });
		</script>	
		
</head>
<body>
<div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="login.php">Home</a></li>
			<li role="presentation"><a href="vendorSpaceRegister.php">Vendor</a></li>
            <li role="presentation"><a href="about.php">About</a></li>
            <li role="presentation"><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">SmartPark</h3>
      </div>
      <div class="jumbotron">
			<div id="container" style="width:600px; height: 400px; margin: 0 auto"></div>
				<div id="container2" style="width:600px; height: 400px; margin: 0 auto"></div>
				</div>
 <footer class="footer">
        <p>&copy; SmartPark 2015</p>
      </footer>

    </div>
</body>
</html>