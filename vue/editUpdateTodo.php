<?php

if (isset($_GET['idTodo']) && isset($_GET['idTheme']) && isset($_GET['idCategorie'])) {
	
	$idTodo = $_GET['idTodo'];
	$idTheme = $_GET['idTheme'];
	$idCategorie = $_GET['idCategorie'];
	
	require('../config.php');
	require('../modele/database.php');
	
	// appel de la t qu'on voudrait modifier
	$singleTodos = getSingleTodo(getPDOLink($config), $idTodo);
	include('header.php');
	?>
	<!-- retour en arrière -->
	<a href="editTodo.php?idTheme=<?php echo($idTheme); ?>&idCategorie=<?php echo($idCategorie); ?>"><h2><strong>&larr;</strong></h2></a>
		<div class="categories">
		
	<?php foreach ($singleTodos as $singleTodo) { ?>
		
		<form class="form-horizontal" action="../controller/updateTodo.php" method="post">
			<fieldset>
			<!-- Form Name -->
			<legend>Modifier la todo</legend>
			
			<!-- Text input-->
			<div class="form-group">
				  <label class="col-md-4 control-label" for="titre">description</label>  
				  <div class="col-md-5">
				  <input id="description" name="description" value="<?php echo($singleTodo['description']); ?>" type="text"  class="form-control input-md" autofocus required>
				 </div><!--.col-md-5-->
			 </div><!--.form-group-->
			<div class="form-group">
			  	<label class="col-md-4 control-label" for="titre">date d'échéance</label>  
			  	<div class="col-md-5">
			  		<input id="date_echeance" name="date_echeance" value="<?php echo($singleTodo['date_echeance']); ?>" type="date" placeholder="" class="form-control input-md">
				</div><!--.col-md-5-->
			</div><!--.form-group-->
			
				<!-- on fait passer les id avec les champs hidden du formulaire -->
				<input type="hidden" name="todo_id" value="<?php echo($singleTodo['id']); ?>" />
				<input type="hidden" name="theme_id" value="<?php echo($idTheme); ?>" />
				<input type="hidden" name="categorie_id" value="<?php echo($idCategorie); ?>" />
				
				<input id="submit" name="submit" class="pull-right btn btn-primary btn-lg" type="submit" value="Publier" />
			</fieldset>
		</form>
		
	
	</div>
	
	<?php }
	
	include('footer.php');
}
else{

	include('header.php');
	?>
	
	<h2>Erreur</h2>
	
	<?php  include('footer.php'); 
	
}
