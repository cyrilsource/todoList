<?php

if (isset($_GET['id_theme'])) {
	
	$idTheme = $_GET['id_theme'];
	
	require('../config.php');
	require('../modele/database.php');
	
	deleteTheme(getPDOLink($config), $idTheme);
		
	header('Location: ../vue/editTheme.php');
	
}

else {

	include('header.php');
	?>
	
	<h2>Erreur</h2>
	
	<?php  include('footer.php'); 
	
}
