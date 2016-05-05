<?php


require('../config.php');
require('../modele/database.php');

if (!empty($_POST['submit']) && !empty($_POST['nom'])  && !empty($_POST['theme_id'])&& !empty($_POST['categorie_id']))  {
	$nom = $_POST['nom'];
	
	$theme_id = $_POST['theme_id'];
	$categorie_id = $_POST['categorie_id'];
	
	updateCategorie(getPDOLink($config), array(
		'nom' => $nom,
		'categorie_id' => $categorie_id
			
	));
	
	
		
	header('Location: ../vue/editCategorie.php?id='.$theme_id.'');
	
}

else {

	include('header.php');
	?>
	
	<h2>Erreur</h2>
	
	<?php  include('footer.php'); 
	
}
