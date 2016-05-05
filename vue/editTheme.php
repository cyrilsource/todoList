<?php 

require('../config.php');
require('../modele/database.php');

$pdo = getPDOLink($config);
$themes = getThemes($pdo);

include('header.php');

?>
<div class="container">
	<form class="form-horizontal" action="../controller/insertionTheme.php" method="post">
		<fieldset>
			<legend>Editer un thème</legend>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="titre">Nom</label>  
			  <div class="col-md-5">
			  	<input id="nom" name="nom" type="text" placeholder="nom" class="form-control input-md" autofocus required>  
			  </div><!--.col-md-5-->
			</div><!--.form-group-->
			
				<input id="submit" name="submit" class="pull-right btn btn-primary btn-lg" type="submit" value="Publier" />
		</fieldset>
	</form>
</div><!--.container-->
<div class="container">
	<div class="page-header">
		<h3>mes thèmes</h3>
	</div><!--.page-header-->
	<table class="table table-bordered table-striped table-condensed">
	   <tbody>
<?php  foreach ($themes as $theme){ ?>

		<tr>
		<td><a href="editCategorie.php?id=<?php echo($theme['id']); ?>"><h4><?php echo($theme['nom']); ?></h4></a></td>
		<td><a href="editUpdateTheme.php?id_theme=<?php echo($theme['id']); ?>">modifier</a></td>
		<td><a href="../controller/deleteTheme.php?id_theme=<?php echo($theme['id']); ?>">supprimer</a></td>
		</tr>

<?php } ?>
		</tbody>
	</table>
</div><!--.container-->


<?php
include('footer.php');