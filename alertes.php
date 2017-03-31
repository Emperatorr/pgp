<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Alerte de projets</title>

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

</head>
<body style='margin-bottom:0px;'>

<div class="wrapper">
  <!--menu vertical -->

    <div class="main-panel">
      <?php 
        $idProjet = 0;
        if(isset($_GET['projet']) && !empty($_GET['projet'])) { 
            $_SESSION['idProjet'] = htmlspecialchars($_GET['projet']) ;
        }
        
	   ?>
      <?php
        $page_title = "Les alertes du projet ". $_GET['projet'] ;
        $page_active = 2;
      ?>
		  
          <!--menu top-->
		   <?php 
			require_once('inc/menu.top.php');

			require_once('bd/Projet.php');
            require_once('bd/Alert.php');
			require_once('bd/connection_bd.php');
			require_once('bd/CRUD.php');
            require_once('bd/fonctions.inc.php');
			
            $obj_bdd = new CRUD ($bdd);
            ?>
        <div class="content">
		   <div class="container-fluid center " >	
		<?php 
           $results = $obj_bdd -> selectAlertByIdProjet($_SESSION['idProjet']) ;

           if($results != null) {
            echo "
               <table class='table'>
                <thead>
                <tr>
                    <th>Type d'alerte</th>
                    <th>Date d'envoi</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                ";


               foreach($results AS $alert) {
                   $typeAlert = $alert -> getTypeAlert();
                   $dateAlert = $alert -> getDateAlert() ;
                   $messageAlert = 	$alert -> getMessageAlert() ;
                   
                   $class = "";
                   $type = "";
                   if($typeAlert == 1) {
                       $class = "alert" ;
                       $type = "Alerte de Risque" ;
                   }elseif ($typeAlert == 2){
                       $class = "depasser" ;
                       $type = "Alerte de Depassement" ;
                   }
                   echo "
                        <tr class='$class'>
                            <td> $type </td>
                            <td> $dateAlert </td> 
                            <td> $messageAlert </td>
                        </tr>
                    ";
               }
            echo"
              </tbody>
            </table>
            ";


           } else {
             echo"
               <div class='col-lg-12 center' style = 'margin-top: 20px;'>
                <p>pas d'alertes pour ce projet, tout est dans les normes !</p>
		       </div>
               ";
           }

		?>
          <div class="col-lg-12 center" style = 'margin-top: 20px;'>
		     <a href='data.php'  class="btn btn-info pull-right" style ="margin-left:10px;">Retour à la liste des projets</a>
          </div>
        
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

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

 
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
</html>
