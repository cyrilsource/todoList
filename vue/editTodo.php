<?php

if (isset($_GET['idTheme']) && isset($_GET['idCategorie'])) {

	$idTheme = $_GET['idTheme'];
	$idCategorie = $_GET['idCategorie'];
	
	require('../config.php');
	require('../modele/database.php');
	
	// fonction bdd
	$pdo = getPDOLink($config);
	$todos = getTodos($pdo, $idCategorie);
	

	include('header.php'); ?>
	
	<div class="container">
		<a href="editCategorie.php?id=<?php echo($idTheme); ?>"><h2><strong>&larr;</strong></h2></a>
		<div class="categories">
		<!-- boucle pour faire apparaitre la categorie sélectionnée -->
			<?php foreach ($todos as $todo) {?>	
			<?php } ?>
			<h2><?php echo $todo['categorie']; ?></h2>
			<h3>Todo List</h3>
			<table class="table table-bordered table-striped table-condensed">
		   		<tbody>
				   	<!-- boucle pour faire apparaitre toutes les t de la categorie -->
					<?php foreach ($todos as $todo) { ?>
					<tr>
						 <td><h4><?php echo($todo['todo']); ?></h4></td> 
						<td><h4><?php echo($todo['date_echeance']); ?></h4></td>		   		  
						<td><a href="../controller/deleteTodo.php?idTodo=<?php echo($todo['todo_id']); ?>&idTheme=<?php echo($idTheme) ?>&idCategorie=<?php echo($idCategorie) ?>">supprimer</a></td>
						<td><a href="editUpdateTodo.php?idTodo=<?php echo($todo['todo_id']); ?>&idTheme=<?php echo($idTheme) ?>&idCategorie=<?php echo($idCategorie) ?>">modifier</a></td>
					</tr>
					
					<?php } ?>
				</tbody>
			</table>
		</div><!--.categories-->
		<!-- formulaire pour éditer une nouvelle t -->
		<form class="form-horizontal" action="../controller/insertionTodo.php" method="post">
			<fieldset>
			<!-- Form Name -->
			<legend>Editer une nouvelle todo</legend>
			<!-- Text input-->
			<div class="form-group">
				  <label class="col-md-4 control-label" for="titre">description</label>  
				  <div class="col-md-5">
				  <input id="description" name="description" type="text" placeholder="description" class="form-control input-md" autofocus required>
				 </div><!--.col-md-5-->
			 </div><!--.form-group-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="titre">date d'échéance</label>  
				  <div class="col-md-5">
				  		<input id="date_echeance" name="date_echeance" type="date" placeholder="" class="form-control input-md">
				</div><!--.col-md-5-->
			</div>
				<!-- on transmet les id theme et idi categorie à l'aide ces champs hidden du formulaire -->
				<input type="hidden" name="theme_id" value="<?php echo($idTheme); ?>" />
				<input type="hidden" name="categorie_id" value="<?php echo($idCategorie); ?>" />
				
				<input id="submit" name="submit" class="pull-right btn btn-primary btn-lg" type="submit" value="Publier" />
			</fieldset>
		</form>
		
	
	</div><!--.container-->
	
	<?php
	include('footer.php');
}

else {
	include('header.php');
	?>
	
	<h2>Cette page n'existe pas</h2>
	
	<?php  include('footer.php'); 
}