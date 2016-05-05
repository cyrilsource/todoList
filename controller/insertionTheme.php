<?php

require('../config.php');
require('../modele/database.php');


if (!empty($_POST['submit']) && !empty($_POST['nom']))  {
	$nom = $_POST['nom'];
	
	
	
	addTheme(getPDOLink($config), array(
		'nom' => $nom,
			
	));
	
}


header('Location: ../vue/editTheme.php');