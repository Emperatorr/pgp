<?php
	 $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	 $bdd = new PDO('mysql:host=localhost;dbname=pgp','root','', $pdo_options);  
	 // $bdd = new PDO('mysql:host=localhost;dbname=mines','root','lansana1234', $pdo_options);  
?>