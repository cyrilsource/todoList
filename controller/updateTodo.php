<?php


require('../config.php');
require('../modele/database.php');

if (!empty($_POST['submit']) && !empty($_POST['description']) && isset($_POST['date_echeance']) && !empty($_POST['theme_id'])&& !empty($_POST['categorie_id']) && !empty($_POST['todo_id']))  {

	$description = $_POST['description'];
	$date_echeance = $_POST['date_echeance'];
	$theme_id = $_POST['theme_id'];
	$categorie_id = $_POST['categorie_id'];
	$todo_id = $_POST['todo_id'];
	

	updateTodo(getPDOLink($config), array(
		'description' => $description,
		'date_echeance'=> $date_echeance,
		'todo_id' => $todo_id
			
	));
	
	
		
	header('Location: ../vue/editTodo.php?idTheme='.$theme_id.'&idCategorie='.$categorie_id.'');
	
}

else {

	include('header.php');
	?>
	
	<h2>Erreur</h2>
	
	<?php  include('footer.php'); 
	
}
