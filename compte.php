<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Tableau de bord</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">

  <!--menu vertical -->
    <div class="main-panel">
		  <!--menu top-->
		   <?php 
		    $page_title = 'Mon Compte';
			require_once('inc/menu.top.php');
			
			require_once('bd/User.php');
			require_once('bd/connection_bd.php');
			require_once('bd/CRUD.php');
			$obj_bdd = new CRUD ($bdd);
			
			?>
        <div class="content">
		 <div class="container-fluid" style="margin-left:25%;" >
		<?php 
			if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
			$user =  $obj_bdd -> selectUserById($_SESSION['idUser']);
				
			$prenomUser = ((isset($_POST['prenomUser']) && !empty($_POST['prenomUser'])) ? $_POST['prenomUser'] : ((isset($user) && !empty($user)) ? $user -> getPrenomUser() : '' ));
			$nomUser = ((isset($_POST['nomUser']) && !empty($_POST['nomUser'])) ? $_POST['nomUser'] : ((isset($user) && !empty($user)) ? $user -> getNomUser() : '' ));
			$emailUser = ((isset($_POST['emailUser']) && !empty($_POST['emailUser'])) ? $_POST['emailUser'] : ((isset($user) && !empty($user)) ? $user -> getEmailUser() : '' ));
			$telephoneUser = ((isset($_POST['telephoneUser']) && !empty($_POST['telephoneUser'])) ? $_POST['telephoneUser'] : ((isset($user) && !empty($user)) ? $user -> getTelephoneUser() : '' ));
			
			


			if(isset($_POST['action']) && $_POST['action'] =='Update'){
				$user -> setPrenomUser($prenomUser);
				$user -> setNomUser($nomUser);
				$user -> setEmailUser($emailUser);
				$user -> setTelephoneUser($telephoneUser);
				
				$data_updated = $obj_bdd -> updateUser($user) ;
				
			if($data_updated == true){
				 echo"
				   <div class='col-lg-8 col-md-push-1'>
					<div class='col-md-12'>
						<div class='alert alert-success'>
							<strong><span class='glyphicon glyphicon-ok'></span>Vos informations ont été mise à jour avec succès</strong><br/>
							<strong><span class='glyphicon glyphicon-ok'></span> Le formulaire a été rechargé avec succès</strong>
						</div>
					</div>
				</div>";
			}
					
			}



			
			?>
		
		 <form role="form" action='compte.php' method ='POST'>
            <div class="col-lg-8">
                <div class="form-group">
                    <label for="prenomUser">Prenom </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="prenomUser" id="prenomUser" placeholder="Entrer votre prenom" required <?php echo"value='$prenomUser'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="nomUser">Nom</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nomUser" id="nomUser" placeholder="Entrer votre nom" required  <?php echo"value='$nomUser'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="emailUser">Votre email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="Entrer votre email" required  <?php echo"value='$emailUser'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telephoneUser">Telephone</label>
                    <div class="input-group">
                        <input type="text" maxlength = '12' class="form-control" id="telephoneUser" name="telephoneUser" placeholder="Entrer votre telephone"  <?php echo"value='$telephoneUser'" ;?> >
                        <span class="input-group-addon"></span>
                    </div>
                </div>
				
				<input type ='hidden' name = 'action' value = 'Update' />
				
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>
	<?php 
	
	} else {
		header('location:index.php');
		
	}
	?>
		 </div> <!-- content fluid -->
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
