<?php

require('../config.php');
require('../modele/database.php');


if (!empty($_POST['submit']) && !empty($_POST['nom'])&& !empty($_POST['theme_id']))  {

	$nom = $_POST['nom'];
	$theme_id = $_POST['theme_id'];
	
	addCategorie(getPDOLink($config), array(
		'nom' => $nom,
		'theme_id' => $theme_id
			
	));
	
}


header('Location: ../vue/editCategorie.php?id='.$theme_id.'');