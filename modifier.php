<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="ma.radees.radees.png" />
	 <title>Modifier</title>
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
  <?php
    session_start();
    $E=$_GET['E'];
    if ($E==1) {
      echo '<nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="profiladmin.php">Profil</a>
        <a class="p-2 text-dark" href="validationadmin.php">Validation</a>
        <a class="p-2 text-dark" href="consulter.php">consultation des demandes validées</a>
          </nav>';
    }else{echo '<nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="Profilchef.php">Profil</a>
        <a class="p-2 text-dark" href="demanderchef.html">Demander</a>
        <a class="p-2 text-dark" href="mesdemandeschef.php">Mes demandes</a>
        <a class="p-2 text-dark" href="validationchef.php">Validation</a>
          </nav>';}
  ?>
        <a class="btn btn-outline-success" href="Deconnexion.php">déconnexion</a>
  </div>
  <center>

  <?php
    if (isset($_GET['ID'])) {
      $_SESSION['id']=$_GET['ID'];
      $id=$_SESSION['id'];
    }else{
      $id= $_GET['D'];
    }


      $serveur="localhost";
      $login="root";
      $pass="";

      try{
        $connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
        $connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $requete1=$connexion->prepare("
          SELECT NOM ,PRENOM ,DATE_DEBUT,DATE_FIN,TYPE_CONGE,SOLDE,ID_CONGE,MATRICULE FROM CONGE NATURAL join(AGENT) where ID_CONGE=$id");
        $requete1->execute();
        $requete1=$requete1->fetchall();
        $_SESSION['M']=$requete1[0][7];
        }
        catch(PDOEXEPTION $e){
          echo'echec:'.$e->get_message();
        }
  ?>
    <form method="POST" action="modifier2.php">
      <div class="container">
      <div class="alert alert-warning" role="alert"><h5>Modification</h5></div>
        
      <div class="form-group row">
        <label for="Nom" class="col-sm-2 col-form-label"><h6>Nom</h6></label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="Nom" value= <?php echo $requete1[0][0] ?> >
        </div>
        <label for="Prenom" class="col-sm-2 col-form-label"><h6>Prénom</h6></label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="Prenom" value=<?php echo $requete1[0][1] ?> >
        </div>
        <label for="Type" class="col-sm-2 col-form-label"><h6>Type de congé</h6></label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="Type" value="<?php echo $requete1[0][4]?>" >
        </div>
        <label for="Type" class="col-sm-2 col-form-label"><h6>Nombre des jours actuels</h6></label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="Type" value=<?php echo $requete1[0][5]?> >
        </div>
      </div>
      <div class="form-group row">
        <label for="Type" class="col-sm-2 col-form-label"><h6>Date de début</h6></label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="Type" value=<?php echo $requete1[0][2]?> >
        </div>
        <label for="inputdatedeb" class="col-sm-2 col-form-label"><h6>Nouvelle date de début</h6></label>
        <div class="col-sm-10">
          <input type="Date" class="form-control" id="inputdatedeb" name="ndd">
        </div>
        <label for="Type" class="col-sm-2 col-form-label"><h6>Date de fin</h6></label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="Type" value=<?php echo $requete1[0][3]?> >
        </div>
        <label for="inputdatefin" class="col-sm-2 col-form-label"><h6>Nouvelle date de fin</h6></label>
        <div class="col-sm-10">
          <input type="Date" class="form-control" id="inputdatefin" name="ndf">
        </div>
      </div>
  <?php
      if(isset($_GET['X'])){
        if ($_GET['X']==0) 
          { echo'<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
            Impossible, le solde de jours est terminee<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
          }elseif ($_GET['X']==1) 
          { echo'<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
            Impossible, de dépassé 30 jours<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
          }elseif($_GET['X']==2)
          {echo'<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
            Impossible, dates incorrects<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
          }else
          { echo'<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
            Impossible il reste '.$_GET['X'].' jours<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';}

      }
  ?>
  <button type="submit" class="btn btn-success">Accepter</button>
      </div>
    </form>
  </center>
</body>
</html>