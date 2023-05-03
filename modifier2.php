<?php
session_start();
			$serveur="localhost";
			$login="root";
			$pass="";
			$id=$_SESSION['id'];
			$mat=$_SESSION['M'];

			$N_DATE_D=strtotime($_POST["ndd"]);
			$N_DATE_F=strtotime($_POST["ndf"]);
			$N_SOLDE=(($N_DATE_F - $N_DATE_D)/86400);/*le diviser la durée par 86400 pour avoir le nombre de jours, parce que le résultat est en seconde! (60*60*24)*/
			$N_DATE_D = date('Y-m-d H:i:s', $N_DATE_D);
			$N_DATE_F = date('Y-m-d H:i:s', $N_DATE_F);
			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$requete0=$connexion->prepare("SELECT NB_J , POST from AGENT where MATRICULE=$mat");
				$requete0->execute();
				$requete0=$requete0->fetchall();
				$NBJ=$requete0[0][0];

				$requete1=$connexion->prepare("SELECT SOLDE from CONGE where ID_CONGE=$id");
				$requete1->execute();
				$requete1=$requete1->fetchall();
				$SOLDE=$requete1[0][0];
				if ($N_SOLDE<=0){
					if ($requete0[0][1]==Chef){
						header("location:Modifier.php?X=2 & E=1 & D=$id");
					}else{
						header("location:Modifier.php?X=2 & E=0 & D=$id");
					}
				}elseif ($N_SOLDE>$SOLDE) {
					if ($NBJ==0) {	
						if ($requete0[0][1]==Chef){
							header("location:Modifier.php?X=0 & E=1 & D=$id");
						}else{
							header("location:Modifier.php?X=0 & E=0 & D=$id");
						}
					}elseif ($N_SOLDE>30) {
						if ($requete0[0][1]==Chef){
							header("location:Modifier.php?X=1 & E=1 & D=$id");
						}else{
							header("location:Modifier.php?X=1 & E=0 & D=$id");
						}
					}else{
						$NN_SOLDE=$NBJ-$N_SOLDE;
						if ($NN_SOLDE <0) {
							header("location:modifier.php?X=$NBJ & D=$id");
						}else{
							$requete2=$connexion->prepare("UPDATE conge
							SET DATE_DEBUT=\"$N_DATE_D\" , DATE_FIN=\"$N_DATE_F\" , SOLDE=$N_SOLDE , ETAT=true where ID_CONGE=$id");
						$requete2->execute();
						$requete3=$connexion->prepare("UPDATE AGENT SET NB_J=$NN_SOLDE where MATRICULE=$mat");
						$requete3->execute();
							if ($requete0[0][1]==Chef) {
								header("location:validationadmin.php");
							}else{header("location:validationchef.php");
							}
						}
					}
				}else{
					$requete4=$connexion->prepare("UPDATE conge SET DATE_DEBUT=\"$N_DATE_D\" , DATE_FIN=\"$N_DATE_F\" , TYPE_CONGE=\"$N_TYPE\" , SOLDE=$N_SOLDE , ETAT=true where ID_CONGE=$id");
					$requete4->execute();
					$NV_NBJ=$SOLDE-$N_SOLDE;
					$requete5=$connexion->prepare("UPDATE AGENT SET NB_J=$NV_NBJ where MATRICULE=$mat");
					$requete5->execute();
					if ($requete0[0][1]==Chef) {
						header("location:validationadmin.php");
					}else{
						header("location:validationchef.php");}
				}
			}
			catch(PDOEXEPTION $e){
				echo'echec:'.$e->get_message();
			}
?>