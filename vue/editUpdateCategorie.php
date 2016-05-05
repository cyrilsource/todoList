<?php

if (isset($_GET['id_theme']) && isset($_GET['id_categorie']))  {
	
	//définir variable id pour la clause where de l'article à afficher
	
	$idTheme = $_GET['id_theme'];
	$idCategorie = $_GET['id_categorie'];
	
	
	require('../config.php');
	require('../modele/database.php');
	
	// fonction pour faire appel à la catégorie qu'on voudrait modifier
	$singleCategories = getSingleCategorie(getPDOLink($config), $idCategorie);
	include('header.php');
	?>
	<div class="container">
		<a href="editTodo.php?idTheme=<?php echo($idTheme); ?>&idCategorie=<?php echo($idCategorie); ?>"><h2><strong>&larr;</strong></h2></a>
			<div class="categories">
			
		<?php foreach ($singleCategories as $singleCategorie) { ?>
		
		<form class="form-horizontal" action="../controller/updateCategorie.php" method="post">
			<fieldset>
			<!-- Form Name -->
			<legend>Modifier la todo</legend>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="titre">Nom</label>  
			  <div class="col-md-5">
			  	<input id="nom" name="nom" type="text" value="<?php echo($singleCategorie['nom']) ?>" class="form-control input-md" autofocus required> 
			  </div><!--.col-md-5-->
			 </div><!--.form-group-->
			 	
			 	<!-- on envoie les id theme et id categorie avec le formulaire -->
				<input type="hidden" name="theme_id" value="<?php echo($idTheme); ?>" />
				<input type="hidden" name="categorie_id" value="<?php echo($singleCategorie['id']) ?>" />
				
				<input id="submit" name="submit" class="pull-right btn btn-primary btn-lg" type="submit" value="Publier" />
			</fieldset>
		</form>
		
	
	</div><!--.container-->
	
	<?php }
	
	include('footer.php');
}
else{

	include('header.php');
	?>
	
	<h2>Erreur</h2>
	
	<?php  include('footer.php'); 
	
}
