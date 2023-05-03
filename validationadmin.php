<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="ma.radees.radees.png" />
   <title>Validation</title>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--Pour que le rendu et le zoom-->
  <!-- CSS -->
   <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>
<body>
    <script src="bootstrap-4.3.1-dist/js/jquery-3.3.1.slim.min" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="bootstrap-4.3.1-dist/js/popper.min" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
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
          SELECT NOM ,PRENOM ,DATE_DEBUT,DATE_FIN,TYPE_CONGE,SOLDE,ID_CONGE,ETAT,MATRICULE FROM CONGE NATURAL join(AGENT) where Post='Chef' ORDER BY ID_CONGE DESC");
        $requete1->execute();
        $requete1=$requete1->fetchall();
        $MAT=$requete1[0][8];
        echo '<table class="table table-hover">
          <thead>
          <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date de début</th>
            <th scope="col">Date de fin</th>
            <th scope="col">Type de congé</th>
            <th scope="col">Solde</th>
            <th Scope="col">Validation</th>
          </tr>
          </thead>
          <tbody>';

        for ($i=0; $i <count($requete1) ; $i++) {

          if ($requete1[$i][7]== 1) {
            echo'<tr class="table-success">';
          }elseif ($requete1[$i][7]== -1) {
            echo'<tr class="table-danger">';
          }else{
            echo '<tr>';}

          for ($j=0; $j <6 ; $j++) {
            $rr=$requete1[$i][$j];
            echo "<td> $rr </td>";
          }  
          $arraycng[$i]=$requete1[$i][6]; 
          $arraysolde[$i]=$requete1[$i][5];
          if ($requete1[$i][7]== 1 || $requete1[$i][7]== -1) {
            echo"<td>   </td>";
          }else{  
              echo '<td><div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Action
             </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="Accepter.php?ID='.$arraycng[$i].'& E=1">Accepter</a>
            <a class="dropdown-item" href="Refuser.php?ID='.$arraycng[$i].' & S='.$arraysolde[$i].' & MAT='.$MAT.' & E=1 ">Refuser</a>
            <a class="dropdown-item" href="Modifier.php?ID='.$arraycng[$i].'& E=1">Modifier</a>
            </div>
            </div>
            </td>';
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