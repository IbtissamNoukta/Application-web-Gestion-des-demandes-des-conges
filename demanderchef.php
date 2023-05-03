<!DOCTYPE html>
<head>
  <link rel="icon" type="image/png" href="ma.radees.radees.png" />
	 <title>Demander</title>
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
      <a class="p-2 text-dark" href="Profilchef.php">Profil</a>
      <a class="p-2 text-dark" href="demanderchef.php">Demander</a>
      <a class="p-2 text-dark" href="mesdemandeschef.php">Mes demandes</a>
      <a class="p-2 text-dark" href="validationchef.php">Validation</a>
    </nav>
      <a class="btn btn-outline-success" href="Deconnexion.php">déconnexion</a>
  </div>

  <center>
    <div class="container">
      
      <div class="alert alert-dark" role="alert"><h3>Demande de congé</h3></div>
        <form method="POST" action="ajouter-demande.php">
          <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputdatedeb4"><h6>Date de début</h6></label>
                <input type="date" class="form-control" id="inputdatedeb4" name="dd" placeholder="Date de debut">
            </div>
            <div class="form-group col-md-6">
                <label for="inputdatefin4"><h6>Date de fin</h6></label>
                <input type="date" class="form-control" id="inputdatefin4" name="df" placeholder="Date de fin">
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="inputState"><h6>Type de congé</h6></label>
              <select id="inputType" name="type" class="form-control">
                <option value="" selected>Choisir....</option>
                <option value="Congé annuel">Congé annuel</option>
                <option value="Congé de permanence">Congé de permanence</option>
                <option value="Congé familial">Congé familial</option>
                <option value="R.H.S">R.H.S</option>
              </select>
          </div>
      <br><div>
            <button type="submit" class="btn btn-success">Envoyer</button>
          </div>
            <?php
              if(isset($_GET['D'])){
                if ($_GET['D']==0) 
                  { echo'<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Impossible, vous avez terminé votre solde de jours<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }elseif ($_GET['D']==1) 
                  { echo'<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Impossible, vous avez dépassé 30 jours<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }elseif ($_GET['D']==2) 
                  { echo'<br><div class="alert alert-success alert-dismissible fade show" role="alert">
                  Demande envoyée<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>';
                  }elseif($_GET['D']==3)
                    {echo'<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Impossible, dates incorrectes<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                      </div>';}
                }
                if(isset($_GET['DD']))
                  { echo'<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Impossible, il reste '.$_GET['DD'].' jours<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }
            ?>
          </form>
        </div>
      </div>
    </div>  
  </center>
</body>
</html>