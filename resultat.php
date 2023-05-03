<?php 
print  "<center><form method = 'post' action = 'chaima.php' >";
    if(isset($_POST['choisis'])){
    	echo"votre selection";
    	echo "<table border = '1' , cellpadding='6', textalign='center'><tr>";
    	foreach ($_POST['choisis'] as $value) {
		echo " <td>".$value."</td>";
    	}
    	}
    	echo "</tr></table> ";

    	echo "resultat du tirage <table border = '1' , cellpadding='6', textalign='center'><tr>";
    	    $tab=realise_tirage();
    	    	foreach ($tab as $val) {

   				 echo "<td>".$val."</td>";
				}
    echo "</tr></table> ";
//-------------------
    $a=0;
      foreach ($tab as $val) {
      	  foreach ($_POST['choisis'] as $value) {
      	  	if ($val==$value) {
      	  		$a++;
      	  	}
      	  }}
    echo "vous avez eu " .$a. " bon numero";

           print "<br><br><button type = 'submit' >retour a la grille</button><br></forme></center>";





    	


function realise_tirage() {
$tab = array();
$busy = false; //numéro unique

for ($i=0; $i<6; $i++) {
do {
$nb = rand(1,49);
foreach ($tab as $val) {
if ($busy = ($val == $nb))
break;
}
} while ($busy);
$tab[] = $nb;
}
return $tab;
}

?>