<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Importation de données</title>

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
        $page_title = "Importer des données";
        $page_active = 2;
      ?>
		  
          <!--menu top-->
		   <?php 
			require_once('inc/menu.top.php');

			require_once('bd/Projet.php');
			require_once('bd/connection_bd.php');
			require_once('bd/CRUD.php');
            require_once('bd/fonctions.inc.php');
			$obj_bdd = new CRUD ($bdd);
            ?>
        <div class="content">
		 <div class="container-fluid" style="margin-left:25%;" >	
		<?php 
         if(isset($_FILES['fichier']) && !empty($_FILES['fichier'] )) {
             $extension = array('XML','xml');
             $name = "fichier_xml";
             $chemin = "import/" ;

             $res = uploadFile($_FILES['fichier'], $name, $chemin, $extension, null); 
              // print_r($res);

             if(isset($res['_code']) && $res['_code']== 0) {
                 $uploadeFile = $res['_uploadedFile'];
                 $res_process = processXML($uploadeFile, $obj_bdd); 

                  echo"
				   <div class='col-lg-8 col-md-push-1'>
					<div class='col-md-12'>
						<div class='alert alert-success'>
							<strong><span class='glyphicon glyphicon-ok'></span> Fichier importé avec succès </strong><br/>
							<strong><span class='glyphicon glyphicon-ok'></span> $res_process[insert] projets inserés avec succès </strong>
                            <strong><span class='glyphicon glyphicon-ok'></span> $res_process[update] projets mis à jour avec succès </strong>
						</div>
					</div>
				</div>";
             } else {
                echo "
                  <div class='error_message'>
                       code d'erreur :  $res[_code] <br/>
                       message : $res[_message] 
                  </div>
                    ";
             }
         }
		?>
		<form role="form" action='import.php' method='POST' enctype="multipart/form-data">
            <div class="col-lg-8 center">
				 <div class="form-group">
                    <label for="fichier">Fichier XML a importer </label>
                    <div class="input-group">
                        <input type="file" class="form-control" name="fichier" id="fichier" placeholder="Fichier" required >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Soumettre" class="btn btn-info pull-right">
            </div>
        </form>
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
