<?php session_start();
  $id=$_SESSION['mat'];
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="ma.radees.radees.png" />
	 <title>Mes demandes</title>
	 <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--Pour que le rendu et le zoom-->
	 <!-- CSS -->
	 <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><img src="ma.radees.radees.PNG" hight="40" width="40"class="rounded float-left"><img src="RADEES_title.PNG" hight="200" width="200"class="rounded float-left"></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="Profil.php">Profil</a>
        <a class="p-2 text-dark" href="demander.php">Demander</a>
        <a class="p-2 text-dark" href="mesdemandes.php">Mes demandes</a>
      </nav>
      <a class="btn btn-outline-success" href="Deconnexion.php">déconnexion</a>
    </div>

	<center>
    <?php
      $serveur="localhost";
			$login="root";
			$pass="";
		  $id=$_SESSION['mat'];

			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$requete1=$connexion->prepare("
					SELECT DATE_DEBUT,DATE_FIN,TYPE_CONGE,SOLDE, ID_CONGE,ETAT FROM CONGE where MATRICULE=$id ORDER BY ID_CONGE DESC");
				$requete1->execute();
				$requete1=$requete1->fetchall();

        echo '<table class="table table-hover">
        <thead>
        <tr>
          <th scope="col">Date de début</th>
          <th scope="col">Date de fin</th>
          <th scope="col">Type de congé</th>
          <th scope="col">Solde</th>
          <th scope="col">...</th>
        </tr>
        </thead>
        <tbody>';
        for ($i=0; $i <count($requete1) ; $i++) { 
          if ($requete1[$i][5]== 1) {
            echo'<tr class="table-success">';
            }elseif ($requete1[$i][5]== -1) {
              echo'<tr class="table-danger">';
            }else{
              echo '<tr>';}
          for ($j=0; $j <4 ; $j++) {
            $rr=$requete1[$i][$j]; 
            echo "<td> $rr </td>";
          }
          $array[$i]=$requete1[$i][4];
          if ($requete1[$i][5]== 1 || $requete1[$i][5]== -1) {
            echo"<td></td>";
          }else{
            echo'<form method="POST" action="Modifieragent.php?IDC='.$array[$i].'">
            <td> <button type="submit" class="btn btn-outline-secondary">Modifier</button> </td>
            </form>';
          }
        }
          echo "</tr>";
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