<?php

if (isset($_GET['id_theme']))  {
	
	//définir variable id pour la clause where du nom de theme à afficher 
	
	$idTheme = $_GET['id_theme'];
	
	require('../config.php');
	require('../modele/database.php');
	
	//appel du theme qu'on voudrait modifier
	$singleThemes = getSingleTheme(getPDOLink($config), $idTheme);
	include('header.php');
	?>
	
	<?php foreach ($singleThemes as $singleTheme) { ?>
	<div class="container">
		<form class="form-horizontal" action="../controller/updateTheme.php" method="post">
			<fieldset>
			<!-- Form Name -->
			<legend>Modifier le nom du theme</legend>
			
			<!-- Text input-->
			<div class="form-group">
			  	<label class="col-md-4 control-label" for="titre">Nom</label>  
			 	<div class="col-md-5">
			  		<input id="nom" name="nom" type="text" value="<?php echo($singleTheme['nom']) ?>" class="form-control input-md" autofocus required>
				</div><!--.col-md-5-->
			</div><!--.form-group-->
				<input type="hidden" name="theme_id" value="<?php echo($idTheme); ?>" />
				
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
