<!DOCTYPE html>
<html>
<head>
	<title>TP : BLOG</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Mon super blog !</h1>

<p>Derniers billets du blog :</p>

<?php

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}

	$blog = $bdd->query('SELECT *, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM billets ORDER BY id DESC');

	while ($billets = $blog->fetch())
	{
		echo '<h3 class="news">' . $billets[titre] . ' Le ' . $billets[date_fr] . '</h3>' . '<div class="news"> <p>' . $billets[contenu] . '<br>' . '<a href="commentaires.php?billet=' . $billets['id'] . '"' . '>Commentaires</a> </div>';
	}

	$blog->closeCursor();
	
?>

</body>
</html>