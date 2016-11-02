
<html>
<head>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="/highcharts.js"></script>
	<script src="/exporting.js"></script>
    <script type="text/javascript">
    $(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#datepicker" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
    $( "#datepicker2" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true //this option for allowing user to select from year range
    });
  }

);
    </script>
</head>
<?php 
				require_once('./dbconnect.php');
				
				$sql = "SELECT parking_space_name, parkingspace_id from parking_space";

				//echo $query;
				$result = mysql_query($sql) or die(mysql_error());
				$resultData = array();
				while ($row = mysql_fetch_assoc($result)) 
				{
					array_push($resultData, $row);
				}
?>

	<body>
		<form method="POST" action="charts.php" id="checkStats" validate>
			<table>
				<tr>
					<td>Start Date</td>
					<td><input type="text" name="startDate" id="datepicker" class="form-control" form="checkStats" required/></td>
				</tr>
				<tr>
					<td>End Date</td>
					<td><input type="text" name="endDate" id="datepicker2" class="form-control" form="checkStats" required/></td>
				</tr>
				<tr>
					<td>Location</td>
					<td> 
						<select name="locationid" style="margin-bottom:2px; " class="form-control" form="checkStats">
		                    <option value="-1">All</option>
		                    <?php for( $i=0; $i<count($resultData);$i++) {
		                    	echo '<option value="'.$resultData[$i]['parkingspace_id'].'">'.$resultData[$i]['parking_space_name'];
		                    	echo '</option>';
		                    }
		                    ?>               
		                  </select>
					</td>
				</tr>
				<tr>
					<td>Units</td>
					<td> 
						<select name="units" style="margin-bottom:2px; " class="form-control" form="checkStats">
		                    <option value="date">Daily</option>
		                    <option value="week">Weekly</option>
		                    <option value="month">Monthly</option>                 
		                    <option value="year">Yearly</option>                 
		                  </select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" class="btn btn-sm" value="Check Statistics">
						<input type="reset" class="btn btn-sm" value="Reset">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>