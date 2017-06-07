<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>graphes</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <!-- google chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']}); 
    // Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChartDelaiTraitement);

    function drawChartDelaiTraitement() {
      var jsonData = $.ajax({
          url: "inc/chartData.php?projet=" + $('#projet_id').val(),
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
	  var options = {
          title: 'Avancement du projet (Delai Reglementaire VS delai de traitement)',
          is3D: 'true',
          height: 900
        };
		
      var chart = new google.visualization.BarChart(document.getElementById('chart1'));
      chart.draw(data, options);
    }
    </script>

</head>
<body style='margin-bottom:0px;'>
    <?php 
       if(isset($_GET['projet']) && !empty($_GET['projet'])){
         echo "<input id='projet_id' type='text' value='$_GET[projet]' />";
       }
     ?>
<div class="wrapper">
  <!--menu vertical -->

    <div class="main-panel">
      <?php
        $page_title = "Graphes";
        $page_active = 2;
      ?>
		  
        <!--menu top-->
         <?php 
			require_once('inc/menu.top.php');
            ?>
        <div class="content">
		 <div class="container-fluid" >
            <div id='chart1' style='border-top:1px solid black;background:white;text-align:center;'></div>
		</div>
        </div>

       <!--footer -->
	    <?php 
		require_once('inc/footer.inc.php');
		?>

    </div>
</div>

</body>
    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

</html>
