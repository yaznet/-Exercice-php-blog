<!DOCTYPE html>
<html>
<head>
	<title>TP : BLOG</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<h1>Mon super blog !</h1>
	<p><a href="index.php">Retour</a></p>

<?php

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}

	$blog = $bdd->prepare('SELECT *, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM billets WHERE id = ?');
	$blog->execute(array($_GET['billet']));
	$billets = $blog->fetch();

	echo '<h3 class="news">' . $billets[titre] . ' Le ' . $billets[date_fr] . '</h3>' . '<div class="news"> <p>' . $billets[contenu] . '</div>';

	$blog->closeCursor();

?>

	<h2>Commentaires :</h2> 

<?php

	$com = $bdd->prepare('SELECT *, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
	
	$com->execute(array($_GET['billet']));
	
	while ($comments = $com->fetch())
	{
		echo '<p>' . $comments[auteur] . $comments[date_commentaire_fr] . '</p>' . '<p>' . $comments[commentaire] . '</p>';
	}
	
	$com->closeCursor();

?>

</body>
</html>