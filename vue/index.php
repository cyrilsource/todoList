<?php 

require('../config.php');
require('../modele/database.php');

//fonctions de la bdd
$pdo = getPDOLink($config);
$themes = getThemes($pdo);
$dayTodos = getdayTodo($pdo);
$weekTodos = getWeekTodo($pdo);


include('header.php');
?>
<div class="jumbotron">
  <div class="container">
  	<div class="row">
  		<div class="col-md-4">
		    <h1>TodoList</h1>
		    <p><a class="btn btn-primary btn-lg" href="editTheme.php" role="button">Editer un nouveau thème</a></p>
	    </div><!--.col-md-4-->
	    <div class="col-md-4">
	    	<h2><span class="label label-default">Todo(s) du jour</span></h2>
	    	<!-- on teste si il y a des todos pour aujourd'hui -->
	    	<?php if (count($dayTodos)==0) {?>
	    				<h3>C'est tout bon pour ajourd'hui</h3>
	    				<h3>bonne journée</h3>
	    	
	    	<?php
	    	}
	    	else {
	    		
	    	?>
		    	<!-- on va afficher ici les t de la journée -->
		    	
		   		 <?php foreach ($dayTodos as $dayTodo) { ?>
		    
	    	   		<ul class="list-unstyled">
	    	   			<li class="list-group-item"><h4><?php echo($dayTodo['description']); ?> - <a href="../controller/deleteTodoHome.php?idTodo=<?php echo($dayTodo['todo_id']); ?>&idTheme=<?php echo($dayTodo['theme_id']) ?>&idCategorie=<?php echo($dayTodo['categorie_id']) ?>">supprimer</a></h4><h5>(<a href="editTodo.php?idTheme=<?php echo($dayTodo['theme_id']); ?>&idCategorie=<?php echo($dayTodo['categorie_id']); ?>"><?php echo($dayTodo['categorie']); ?></a>)</h5></li>
	    	   		</ul>
		    	
		    	
		     	<?php } 
		     	
		    } 	?>
	 		
   		</div><!--.col-md-4-->
   		
  		 <div class="col-md-4">
   	    
   	    	<h2><span class="label label-default">Todo(s) de la semaine</span></h2>
   	   		 <?php foreach ($weekTodos as $weekTodo) { ?>
    	   		<ul class="list-unstyled">
    	   			<li class="list-group-item"><h4><?php echo($weekTodo['day']); ?></h4><h5><?php echo($weekTodo['todo']); ?></h5></li>
    	   		</ul>
   	    	 <?php } ?>
   	 
   		</div><!--.col-md-4-->
   
 	 </div><!--.row-->
	</div><!--.container-->
</div><!--.jumbotron-->

<!-- affichage de toute la liste des categories par thème et le nombre de t pour chaque catégorie -->
<div class="container">
	<div class="page-header">
		<h2>Ma todoList</h2>
	</div><!--.page-header-->
	<?php  foreach ($themes as $theme){ ?>
	<?php $idTheme = $theme['id']; ?>
	<a href="editCategorie.php?id=<?php echo($theme['id']); ?>"><h3><?php echo($theme['nom']); ?></h3></a>
	<?php $todos = getTodoLists($pdo, $idTheme); ?>
	<table class="table table-bordered table-striped table-condensed">
		<thead>
		   <tr>
		         <th>Categorie</th>
		         <th>nombre de todo</th>
		         
		   </tr>
		</thead>
		
		   <tbody>
		<?php foreach ($todos as $todo) {?>
			
			<tr>
				<td><a href="editTodo.php?idTheme=<?php echo($todo['theme_id']); ?>&idCategorie=<?php echo($todo['categorie_id']); ?>"><h4><?php echo($todo['categorie']); ?></h4></a></td>	
				<td><h4><?php echo($todo['nb_todo']); ?></h4></td> 
			</tr>
			
		<?php } ?>
			</tbody>
	</table>
	<?php } ?>
</div><!--.container-->




<?php




include('footer.php');
