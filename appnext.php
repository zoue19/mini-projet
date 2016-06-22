<?php

include "src/Movie.php";
include "src/Connexion.php";
include "src/Acteur.php";
include "lib/Connexion.php";
include "src/Realisateur.php";
include "src/Session.php";

//Nom de la classe, pas du fichier
use src\Connexion as ConnexionSrc;
use src\Movie;
use src\Acteur;
use src\Realisateur;
use src\Session;
use lib\Connexion as ConnexionLib;


$myConnexion = new ConnexionSrc(3306,'localhost','cinemal9', 'root', 'troiswa');

$movie = new Movie(null, null, $myConnexion);

//Permet l'appel d'une constante dans ma classe
echo $movie::VERSION;

echo $myConnexion::SGBD;

$acteur = new Acteur();

echo $acteur::LANGUE;

echo $acteur::PAYS;

echo "<br />";


echo "Methode numero 2 (plus simple): ";
echo "<br />";

//La constance appartient à la classe
echo Acteur::PAYS;
echo Movie::VERSION;
echo Acteur::LANGUE;
echo "<br />";


echo Movie::getInformationofMovie();
echo Acteur::getPaysLangue();



$realisateurOne = new Realisateur();

$realisateurOne->setNom("Almodovar");
$realisateurOne->setPrenom("Predro");
$realisateurOne->setDob("12/06/1964");

$realisateurTwo = new Realisateur();

$realisateurTwo->setNom("Allen");
$realisateurTwo->setPrenom("Woody");
$realisateurTwo->setDob("24/01/1947");


var_dump($realisateurOne);
var_dump($realisateurTwo);


echo $realisateurOne->getDobFR();


$sessionOne = new Session();

$sessionOne->setDateSession("2012/12/01");
$sessionOne->setDatecreated("02/01/2008");
$sessionOne->setIdMovie(12);

$sessionTwo = new Session();

$sessionTwo->setDateSession("2000/12/01");
$sessionTwo->setDatecreated("02/01/1425");
$sessionTwo->setIdMovie(4);

$sessionThree = new Session();

$sessionThree->setDateSession("2012/12/04");
$sessionThree->setDatecreated("02/01/1245");
$sessionThree->setIdMovie(1);


var_dump($sessionOne);


echo "<p>Le " .$sessionOne->dateFormat(). " </p>";

echo "L'annee de connexion : " .$sessionOne->getYear();


echo Session::differenceNbJourDateSeances($sessionOne, $sessionTwo);


echo "La nouvelle date apres la soustraction est : " .$sessionOne->soustraireDate('P5D');


Session::tableauObjetSession($sessionOne, $sessionTwo, $sessionThree);



echo Session::dateSuperieureOuPas($sessionOne, new \DateTime ('2014-12-12'));


echo Session::nbSeances($sessionOne, new \DateTime ('2001-01-01'), new \DateTime ('2016-10-10'));


?>