<?php

require('../config.php');
require('../modele/database.php');


if (!empty($_POST['submit']) && !empty($_POST['description']) && isset($_POST['date_echeance']) && !empty($_POST['theme_id'])&& !empty($_POST['categorie_id']))  {

	$description = $_POST['description'];
	$date_echeance = $_POST['date_echeance'];
	$theme_id = $_POST['theme_id'];
	$categorie_id = $_POST['categorie_id'];
	
		
	// les différentes variables que nous allons insérer dans la bdd
	addTodo(getPDOLink($config), array(
		'description' => $description,
		'date_echeance'=> $date_echeance,
		'theme_id' => $theme_id,
		'categorie_id' => $categorie_id
			
	));
	
}


header('Location: ../vue/editTodo.php?idTheme='.$theme_id.'&idCategorie='.$categorie_id.'');