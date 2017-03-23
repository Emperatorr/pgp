<?php session_start();
try
	 {
		session_destroy();
	    header('location:index.php');	
	 }catch(Exception $e){die('Erreur:'.$e->getMessage());}

?>