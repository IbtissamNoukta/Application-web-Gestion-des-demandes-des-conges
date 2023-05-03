<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="ma.radees.radees.png" />
    <title>Consulter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--Pour que le rendu et le zoom-->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><img src="ma.radees.radees.PNG" hight="40" width="40"class="rounded float-left"><img src="RADEES_title.PNG" hight="200" width="200"class="rounded float-left"></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="profiladmin.php">Profil</a>
        <a class="p-2 text-dark" href="validationadmin.php">Validation</a>
        <a class="p-2 text-dark" href="consulter.php">consultation des demandes validées</a>
      </nav>
        <a class="btn btn-outline-success" href="Deconnexion.php">déconnexion</a>
    </div>

	<center>

			<?php
			$serveur="localhost";
			$login="root";
			$pass="";
			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$requete1=$connexion->prepare("
					 SELECT MATRICULE , POST, NOM ,PRENOM  ,DATE_DEBUT,DATE_FIN,SOLDE ,TYPE_CONGE FROM CONGE NATURAL join(AGENT) where ETAT = 1 ORDER BY ID_CONGE DESC");
				$requete1->execute();
				$requete1=$requete1->fetchall();

				echo '<table class="table table-hover">
        <thead>
          <tr class="table-active">
            <th scope="col">Matricule</th>
            <th scope="col">Post</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date de début</th>
            <th scope="col">Date de fin</th>
            <th scope="col">Solde</th>
            <th scope="col">Type de congé</th>
          </tr>
        </thead>
        <tbody>';

        for ($i=0; $i <count($requete1) ; $i++) {
            echo "<tr>";
          for ($j=0; $j <8 ; $j++) {
            $rr=$requete1[$i][$j];
            echo "<td> $rr </td>";
          }  
            echo "</tr>";
        }
        
          }
          catch(PDOEXEPTION $e){
            echo'echec:'.$e->get_message();
          }
?>

        </tbody>
      </table>
  </center>
</body>
</html>