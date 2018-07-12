<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!--LIENS DES BIBLIOTHEQUES JQUERY HIGHCHARTS EN LIGNE-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>

	<!--LIENS DES BIBLIOTHEQUES JQUERY HIGHCHARTS BOOTSTRAP EN LOCAL-->
	<!--<script type="text/javascript" src="Bibliotheques/jquery.js" ></script>-->
	<!--<script type="text/javascript" src="Bibliotheques/highcharts/code/highcharts.js" ></script>-->
	<script type="text/javascript" src="Bibliotheques/bootstrap/js/bootstrap.js" ></script>

	<!--FEUILLE DE STYLE CSS-->
	<link rel="stylesheet" type="text/css" href="Bibliotheques/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">

	<meta name="viewport" content="width=device-width, initial-scale=1" >
</head>
<body>
	<header>
		<div class="container">
			<img src="IMG/logo-soluris.png">
		</div>
	</header>

	<nav>
		<div class="container" id="nav">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Accueil</a></li>
					<li><a href="index.php?action=import">Importer un fichier</a></li>
					<li><a href="index.php?action=graphique">Générer un graphique</a></li>
					<li><a href="index.php?action=affichebdd">Afficher la Base</a></li>
				</ul>
		</div>
	</nav>
	
	<section class="corps">
	<div class="container" id="corps">