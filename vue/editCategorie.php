<?php

if (isset($_GET['id'])) {

	$idTheme = $_GET['id'];
	
	require('../config.php');
	require('../modele/database.php');
	
	// fonctions bdd
	$pdo = getPDOLink($config);
	$categories = getCategories($pdo, $idTheme);
	
	
	include('header.php'); ?>
	
	<div class="container">
	
	<a href="editTheme.php"><h2><strong>&larr;</strong></h2></a>
		<div class="categories">
			<?php foreach ($categories as $categorie) {?>
			
			<?php } ?>
		<h2><?php echo $categorie['theme']; ?></h2>
		<h3>Categories</h3>
			<table class="table table-bordered table-striped table-condensed">
			   <tbody>
					<?php foreach ($categories as $categorie) {?>
					<tr>
					<td><a href="editTodo.php?idTheme=<?php echo($idTheme); ?>&idCategorie=<?php echo($categorie['idCategorie']); ?>"><h4><?php echo($categorie['categorie']) ?></h4></a></td>
					<td><a href="editUpdateCategorie.php?id_theme=<?php echo($idTheme) ?>&id_categorie=<?php echo($categorie['idCategorie']); ?>">modifier</a></td>
					<td><a href="../controller/deleteCategorie.php?id_theme=<?php echo($idTheme) ?>&id_categorie=<?php echo($categorie['idCategorie']); ?>" >supprimer</a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div><!--.categories-->
		<form class="form-horizontal" action="../controller/insertionCategorie.php" method="post">
		<fieldset>
		
		<!-- Form Name -->
		<legend>Editer une nouvelle catégorie</legend>
		
		<!-- Text input-->
		<div class="form-group">
		 	 <label class="col-md-4 control-label" for="titre">Nom</label>  
		  	<div class="col-md-5">
		 	 	<input id="nom" name="nom" type="text" placeholder="nom" class="form-control input-md" autofocus required>
			</div><!--.col-md-5-->
		</div><!--.form-group-->
			<input type="hidden" name="theme_id" value="<?php echo($idTheme); ?>" />
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