
<html>
	<head>
	<meta charset="UTF-8" />
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css" />
	</head>
	<style>
		body {text-align:center;width: 80%;}
		li {list-style: none;}
		iframe {width:100%;height:auto;}
		.panel-body > ul{text-align: center;list-style-type: none;list-style-position: inside;margin:0;padding:0;}
	/*	form, .well {margin-left: 150px;padding:30px;}*/
	</style>

	<body>

<!-- ////////////Fonction de connexion à la BDD///////////// -->

	<?php include "functions.php";
	//appel de la fonction BDD
	$connexion = connectionBdd('localhost','cinemal9', 'root', 'troiswa');
	//Ma variable $connexion contient ma connection en base de données
	?>











