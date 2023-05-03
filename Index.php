<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="ma.radees.radees.png" />
	<title>Connexion</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!--Pour que le rendu et le zoom 
	<!- CSS -->
	<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>

<body>
	<center><br>
    <header class="geapp-header-bar center-block">
        <img class="logo" src="radees-logo.png"/>
    </header><br><br>
      <div class="container">
  			<div class="row">
    			<div class="col-md-6 offset-md-3">
       			<table class="table table-bordered">
       				<thead>
       	    		<tr class="table-success">
      						<th scope="col"><center>Connectez Vous</center></th>
                  </tr>
              </thead>
<tbody>
  <tr>
    <th scope="row">
      <div class="container">
		    <div class="panel-body">
					<form method="POST" action="verifierpass.php">
            <input type="text" class="form-control" name="mat" placeholder="Matricule"> <br><br>
            <input type="password" class="form-control" name="pass" placeholder="Mot De Passe"><br><br>
              <?php
                session_start();
                if(isset($_GET['incorrect'])){
                  if ($_GET['incorrect']==1) { echo'<div class="alert alert-danger" role="alert">informations incorrectes</div>';
                }
                  }
              ?>
								<div class="checkbox">
                	<label>
                    <input type="checkbox" name="remember" checked> Connexion automatique
                	</label>
              	</div>
		 					  <button type="submit" class="btn btn-lg btn-success btn-block">Se connecter</button>
		 			</form>
   			</div>
      </div>
   	</th>
	 </tr>
	</tbody>
            </table>	
          </div>
  			</div>
		  </div>
	</center>
</body>
</html>
