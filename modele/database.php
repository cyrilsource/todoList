<?php  
//connexion à la bdd et affichage des erreurs
function getPDOLink($config) {
	try {
		$dsn = 'mysql:dbname='.$config['database'].'; host='.$config['host'].';charset=utf8';
		$pdo = new PDO($dsn, $config['username'], $config['password']);
		
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}
	catch (PDOException $exception) {
		//envoi d'un email en cas d'erreur
		mail('cyrilbron78@gmail.com', 'BDD Error', $exception->getMessage());
		exit('BDD Error Connection');
	}
}

//fonction pour ajouter un thème dans la bdd
function addTheme(PDO $pdo, $data) {
	$nom = $data['nom'];
	
	$req = $pdo->prepare("INSERT INTO Theme(nom) VALUES (:nom)");
	$req->execute(array(':nom'=>$nom));
}


//fonction pour afficher tous les themes sur editTheme.php
function getThemes(PDO $pdo) {
	$sql = "SELECT id, nom FROM Theme";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}

//fonction pour un theme sur editUpdateTheme.php
function getSingleTheme(PDO $pdo,$idTheme) {
	$sql = "SELECT id, nom FROM Theme WHERE id = ".$idTheme."";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}

//fonction pour mettre à jour le nom du theme
function updateTheme(PDO $pdo, $data) {
	$nom = $data['nom'];
	$theme_id = $data['theme_id'];
	$req = $pdo->prepare("UPDATE Theme SET nom = :nom WHERE id = :theme_id");
	$req->execute(array(':nom'=>$nom, ':theme_id'=>$theme_id));
}

//fonction pour supprimer un theme
function deleteTheme(PDO $pdo, $id) {
	$req = $pdo->prepare("DELETE FROM Theme WHERE id = :id");
	$req->execute(array(':id'=>$id));
}



//fonction pour afficher tous les themes sur editCategorie.php
function getCategories(PDO $pdo, $idTheme) {
	$sql = "SELECT Theme.id,
	Theme.nom AS theme,
	Categorie.id AS idCategorie,
	Categorie.nom AS categorie
	FROM Theme
	LEFT JOIN Categorie ON Categorie.theme_id = Theme.id
	WHERE Theme.id = ".$idTheme."";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}

//fonction pour ajouter une categorie dans la bdd
function addCategorie(PDO $pdo, $data) {
	$nom = $data['nom'];
	$theme_id = $data['theme_id'];
	
	$req = $pdo->prepare("INSERT INTO Categorie (nom, theme_id) VALUES (:nom, :theme_id)");
	$req->execute(array(':nom'=>$nom, ':theme_id'=>$theme_id));
}

//fonction pour afficher le contenu d'une categorie sur la page editUpdateCategorie.php
function getSingleCategorie(PDO $pdo, $idCategorie) {
	$sql = "SELECT id,
	nom
	FROM Categorie
	WHERE id = ".$idCategorie."";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}

//fonction pour mettre à jour les t
function updateCategorie(PDO $pdo, $data) {
	$nom = $data['nom'];
	$categorie_id = $data['categorie_id'];
	$req = $pdo->prepare("UPDATE Categorie SET nom = :nom WHERE id = :categorie_id");
	$req->execute(array(':nom'=>$nom, ':categorie_id'=>$categorie_id));
}

//fonction pour supprimer une categorie
function deleteCategorie(PDO $pdo, $id) {
	$req = $pdo->prepare("DELETE FROM Categorie WHERE id = :id");
	$req->execute(array(':id'=>$id));
}



//fonction pour afficher toutes les t de la categorie sur editTodo.php
function getTodos(PDO $pdo, $idCategorie) {
	$sql = "SELECT Categorie.id,
	Categorie.nom AS categorie,
	Todo.id AS todo_id,
	Todo.description As todo,
	DATE_FORMAT(Todo.date_echeance, '%W %e %M %Y') AS date_echeance  
	FROM Categorie
	LEFT JOIN Todo ON Todo.categorie_id = Categorie.id
	WHERE Categorie.id = ".$idCategorie."
	ORDER BY Todo.date_echeance";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}

//fonction pour afficher une t sur la page editupdatetodo.php
function getSingleTodo(PDO $pdo, $idTodo) {
	$sql = "SELECT id,
	description,
	date_echeance
	FROM Todo
	WHERE id = ".$idTodo."";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}


//fonction pour ajouter une t dans la bdd
function addTodo(PDO $pdo, $data) {
	$description = $data['description'];
	$date_echeance = $data['date_echeance'];
	$theme_id = $data['theme_id'];
	$categorie_id = $data['categorie_id'];
		$req = $pdo->prepare("INSERT INTO Todo (description, date_echeance, theme_id, categorie_id) VALUES (:description, :date_echeance, :theme_id, :categorie_id)");
	$req->execute(array(':description'=>$description, 'date_echeance'=>$date_echeance, ':theme_id'=>$theme_id, ':categorie_id'=>$categorie_id));
}

//fonction pour mettre à jour les t
function updateTodo(PDO $pdo, $data) {
	$description = $data['description'];
	$date_echeance = $data['date_echeance'];
	$todo_id = $data['todo_id'];
	$req = $pdo->prepare("UPDATE Todo SET description = :description, date_echeance = :date_echeance WHERE id = :todo_id");
	$req->execute(array(':description'=>$description, ':date_echeance'=>$date_echeance,  ':todo_id'=>$todo_id));
}


//fonction pour supprimer un t
function deleteTodo(PDO $pdo, $id) {
	$req = $pdo->prepare("DELETE FROM Todo WHERE id = :id");
	$req->execute(array(':id'=>$id));
}



//pour afficher les categories et le nombre de t par categorie
function getTodoLists(PDO $pdo, $idTheme) {
	$sql = "SELECT Categorie.id AS categorie_id,
	Categorie.nom AS categorie,
	Theme.nom AS theme,
	Theme.id AS theme_id,
	COUNT(*) AS nb_todo
	FROM Todo 
	LEFT JOIN Categorie ON Categorie.id = Todo.categorie_id
	LEFT JOIN Theme ON Theme.id = Todo.theme_id
	WHERE Categorie.theme_id = ".$idTheme."
	GROUP BY categorie, categorie_id,  theme, theme_id;";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}

//pour afficher les t du jour
function getdayTodo(PDO $pdo) {
	$sql = "SELECT Todo.description,
	Todo.date_echeance,
	Todo.id AS todo_id,
	Categorie.nom AS categorie,
	Categorie.id AS categorie_id,
	Theme.id AS theme_id
	FROM Todo
	INNER JOIN Categorie ON Categorie.id = Todo.categorie_id
	INNER JOIN Theme ON Theme.id = Todo.theme_id
	WHERE date_echeance = CURDATE();";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}

//pour afficher les t de la semaine
function getWeekTodo(PDO $pdo) {
	$sql = "SELECT DATE_FORMAT(date_echeance, '%W') AS day,
		GROUP_CONCAT(Todo.description, ' (', Categorie.nom,') ' SEPARATOR '/') AS todo,
		COUNT(Todo.date_echeance)
		FROM Todo
		INNER JOIN Categorie ON Categorie.id = Todo.categorie_id
		INNER JOIN Theme ON Theme.id = Todo.theme_id
		WHERE date_echeance
		BETWEEN DATE_ADD(CURDATE(), INTERVAL 1-DAYOFWEEK(CURDATE()) DAY)
	    AND DATE_ADD(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY)
	    GROUP BY date_echeance 
		ORDER BY date_echeance;";
	$result =$pdo->query($sql);
	return $result->fetchAll();
}


