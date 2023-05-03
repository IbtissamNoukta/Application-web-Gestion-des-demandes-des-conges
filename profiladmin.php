<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="ma.radees.radees.png" />
	 <title>Profil</title>
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
		  $id=$_SESSION['mat'];
			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->query('SET NAMES utf8');
				$requete1=$connexion->prepare("
					SELECT MATRICULE,NOM,PRENOM,POST FROM AGENT where MATRICULE=$id");
				$requete1->execute();
				$requete1=$requete1->fetchall();
				
				$MAT=$requete1[0][0];
				$NOM=$requete1[0][1];
				$PRENOM=$requete1[0][2];
				$POST=$requete1[0][3];
			}
			catch(PDOEXEPTION $e){
				echo'echec:'.$e->get_message();
			}
		?>
      <div class="container">
        <div class="row">

          <div class="col-sm-12">
            <table class="table table-bordered table table-striped">
              <thead>
                <tr>
                  <th scope="col" colspan="2"><center>Informations personnel</center></th>
      
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Matricule</td>
                  <td><?php echo $MAT ?></td>
                </tr>
                <tr>
                  <td>nom</td>
                  <td><?php echo $NOM ?></td>
                </tr>
                <tr>
                  <td>Prénom</td>
                  <td><?php echo $PRENOM ?></td>
                </tr>
                <tr>
                  <td>Post</td>
                  <td><?php echo $POST ?></td>
                </tr>
                <tr>
                  <td>Servive</td>
                  <td>--</td>
                </tr>
                <tr>
                  <td>Division</td>
                  <td>--</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </center>
</body>
</html>