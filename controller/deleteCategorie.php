<?php

if (isset($_GET['id_theme']) && isset($_GET['id_categorie'])) {

	$idTheme = $_GET['id_theme'];
	$idCategorie = $_GET['id_categorie'];
	

	require('../config.php');
	require('../modele/database.php');
	
	deleteCategorie(getPDOLink($config), $idCategorie);
		
	header('Location: ../vue/editCategorie.php?id='.$idTheme.'');
	
}

else {

	include('header.php');
	?>
	
	<h2>Erreur</h2>
	
	<?php  include('footer.php'); 
	
}
