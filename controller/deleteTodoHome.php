<?php

if (isset($_GET['idTodo']) && isset($_GET['idTheme']) && isset($_GET['idCategorie'])) {
	
	$idTodo = $_GET['idTodo'];
	$idTheme = $_GET['idTheme'];
	$idCategorie = $_GET['idCategorie'];

	require('../config.php');
	require('../modele/database.php');

	deleteTodo(getPDOLink($config), $idTodo);
		
	header('Location: ../vue/index.php');
	
}

else {

	include('header.php');
	?>
	
	<h2>Erreur</h2>
	
	<?php  include('footer.php'); 
	
}
