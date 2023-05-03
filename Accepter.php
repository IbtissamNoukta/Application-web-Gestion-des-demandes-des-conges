<?php
session_start();
$id=$_GET['ID'];
$E=$_GET['E'];
accepter($id,$E);




function accepter($id,$E)
{
	$serveur="localhost";
	$login="root";
	$pass="";


	try{
		$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
		$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$requete=$connexion->prepare("
			UPDATE conge
			SET ETAT = 1 where ID_CONGE=$id");
		$requete->execute();
		if ($E==1) {
			header("location:validationadmin.php");
		}else{header("location:validationchef.php");}
	
	
	}
	catch(PDOEXEPTION $e){
		echo'echec:'.$e->get_message();
	}
}
			?>