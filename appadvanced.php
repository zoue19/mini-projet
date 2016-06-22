<?php

include "src/Personnel.php";
include "src/Acteur.php";
include "src/Realisateur.php";
include "src/Acteurdeserie.php";
include "src/Acteurfilm.php";
include "src/Movie.php";
include "src/Dvd.php";
include "src/Connexion.php";
include "src/DvdRom.php";
include "src/BlueRay.php";

use src\Acteur;
use src\Realisateur;
use src\Acteurdeserie;
use src\Acteurfilm;
use src\Movie;
use src\Dvd;
use src\Connexion;
use src\DvdRom;
use src\BlueRay;


$actor = new Acteur();
$actor -> setNom('Boyer');
$actor -> setPrenom('Julien');
$actor -> setDob('1988-03-16');
$actor -> setBiographie('Thug Life');
$actor -> setSalaire(123000000);


var_dump($actor);

$realisateur = new Realisateur();
$realisateur -> setNom('Almodovar');
$realisateur -> setPrenom('Pedro');
$realisateur -> setDob('1956-12-12');
$realisateur -> setVille('Barcelone');
$realisateur -> setSalaire(21245456454);

var_dump($realisateur);

$acteurserie = new Acteurdeserie();
$acteurserie -> setNomDeSerie('Gotham');
$acteurserie -> setSurnom('Batman');
$acteurserie -> setDob('1985-12-02');
$acteurserie -> setPrenom('Bob Eponge');
$acteurserie -> setPrenom('Yann');


var_dump($acteurserie);

$acteurfilm = new acteurfilm();
$acteurfilm -> setCv('Voici son CV');
$acteurfilm -> setOscars('Grammy Awards','NRJ Music Awards');
$acteurfilm -> setNom('Smith');


var_dump($acteurfilm);

$movie = new Movie();
$movie->setTitre('Moby Dick');

echo $acteurfilm->commenterMovie($movie);
echo $acteurserie->commenterMovie($movie);


$connexion = new Connexion(3306,'localhost','cinemal9', 'root', 'troiswa');


$dvdOne = new Dvd(null,null,$connexion);
$dvdOne->setPrixTtc(14);
$dvdOne->setCapacite(4);
$dvdOne->setFabricant('Sony');
$dvdOne->setDiametre(25);
$dvdOne->setPoids(1);
$dvdOne->setCoucheDouble(true);
$dvdOne->setTitre('Un jour en France');
$dvdOne->setSynopsis('Un long film sur la France et la vie quotidienne');
$dvdOne->setAnnee(2010);
$dvdOne->setBudget(1000200);
$dvdOne->setDaterelease('2010-12-04');


var_dump($dvdOne);


$dvdTwo = new Dvd(null,null,$connexion);
$dvdTwo ->setPrixTtc(8);
$dvdTwo ->setCapacite(6);
$dvdTwo ->setFabricant('Philips');
$dvdTwo ->setDiametre(12);
$dvdTwo ->setPoids(2);
$dvdTwo ->setCoucheDouble(false);
$dvdTwo->setTitre('Deux Amis');
$dvdTwo->setSynopsis('Il était une fois...');
$dvdTwo->setAnnee(2015);
$dvdTwo->setBudget(45000);
$dvdTwo->setDaterelease('2010-04-17');


var_dump($dvdTwo);


$dvdThree = new Dvd(null,null,$connexion);
$dvdThree -> setPrixTtc(25);
$dvdThree -> setCapacite(8);
$dvdThree -> setFabricant('Phillips');
$dvdThree -> setDiametre(12);
$dvdThree -> setPoids('200g');
$dvdThree -> setCoucheDouble(true);
$dvdThree->setTitre('Amélie Poulain');
$dvdThree->setSynopsis('Blablablablaaaaa');
$dvdThree->setAnnee(1998);
$dvdThree->setBudget(253685);
$dvdThree->setDaterelease('2016-12-17');


var_dump($dvdThree);

$dvdFour = new Dvd();
$dvdFour -> setPrixTtc(42);
$dvdFour -> setCapacite(4);
$dvdFour -> setFabricant('Sony');
$dvdFour -> setDiametre(25);
$dvdFour -> setPoids('326g');
$dvdFour -> setCoucheDouble(true);
$dvdFour->setTitre('Les Geek');
$dvdFour->setSynopsis('Ordinateur blablabla');
$dvdFour->setAnnee(2016);
$dvdFour->setBudget(695847);

var_dump($dvdFour);

$dvdFive = new Dvd();
$dvdFive ->setPrixTtc(30);
$dvdFive ->setCapacite(8);
$dvdFive ->setFabricant('Toshiba');
$dvdFive ->setDiametre(12);
$dvdFive ->setPoids(4);
$dvdFive ->setCoucheDouble(true);
$dvdFive ->setTitre('Le jour le plus long');
$dvdFive ->setSynopsis('La guerre 39-45');
$dvdFive ->setAnnee(1962);
$dvdFive->setBudget(7845);

var_dump($dvdFive);


$dvdRomOne = new DvdRom(null, null, $connexion);
$dvdRomOne ->setCouleur('#785452');
$dvdRomOne ->setEnregistrable(true);
$dvdRomOne ->setPrixTtc(5);
$dvdRomOne ->setCapacite(8);
$dvdRomOne ->setFabricant('Toshiba');
$dvdRomOne ->setDiametre(12);
$dvdRomOne ->setPoids(4);
$dvdRomOne  ->setTitre('Un titre de film');
$dvdRomOne ->setSynopsis('La guerre 39-45');
$dvdRomOne->setDaterelease('2016-04-17');

$dvdRomTwo = new DvdRom(null, null, $connexion);
$dvdRomTwo ->setCouleur('#000000');
$dvdRomTwo ->setEnregistrable(true);
$dvdRomTwo ->setPrixTtc(10);
$dvdRomTwo ->setCapacite(8);
$dvdRomTwo ->setFabricant('Toshiba');
$dvdRomTwo ->setDiametre(12);
$dvdRomTwo ->setPoids(4);
$dvdRomTwo ->setTitre('X-Men');
$dvdRomTwo ->setSynopsis('Il était une fois.........');
$dvdRomTwo ->setDaterelease('2016-04-17');

$dvdRomThree = new DvdRom(null, null, $connexion);
$dvdRomThree ->setCouleur('#785451');
$dvdRomThree ->setEnregistrable(false);
$dvdRomThree ->setPrixTtc(9);
$dvdRomThree ->setCapacite(8);
$dvdRomThree ->setFabricant('Toshiba');
$dvdRomThree ->setDiametre(12);
$dvdRomThree ->setPoids(4);
$dvdRomThree ->setTitre('Hobite');
$dvdRomThree ->setSynopsis('Blabla');
$dvdRomThree ->setDaterelease('2016-10-10');


var_dump($dvdRomOne, $dvdRomTwo);




echo $dvdOne->comparerDeuxBudgets($dvdOne, $dvdTwo);

echo $dvdOne->totalMoyenneBudget([$dvdOne, $dvdTwo, $dvdThree, $dvdFour, $dvdFive]);

$dvdOne->insererDVDInDb();
$dvdTwo->insererDVDInDb();
$dvdThree->insererDVDInDb();


echo $dvdRomOne->nbMotsSynopsis($dvdRomOne);
echo $dvdRomOne->nbMotsSynopsis($dvdRomTwo);
echo $dvdRomOne->nbMotsSynopsis($dvdRomThree);


$bluerayOne = new BlueRay(null,null,$connexion);
$bluerayOne ->setTitre('Hobite');
$bluerayOne ->setSynopsis('Histoire tres longue dune quete sans fin...');
$bluerayOne->setPrixTtc(15);
$bluerayOne->setDaterelease('2018-12-12');


$bluerayTwo = new BlueRay(null,null,$connexion);
$bluerayTwo ->setTitre('Anneaux');
$bluerayTwo ->setSynopsis('Blabla');
$bluerayTwo->setPrixTtc(15);
$bluerayTwo->setDaterelease('2018-10-17');


var_dump($bluerayOne, $bluerayTwo);

$bluerayOne->insererBlueRayInDb();
$bluerayTwo->insererBlueRayInDb();




// $resultat = $bluerayOne->sortiCetteAnne($connexion, $bluerayOne);

// foreach ($resultat as $value->daterelease){


// 	if($value == date("Y")){

//         echo true;

//     }

//         echo false;

	
// }



echo $dvdOne->nbMoisDvd($dvdOne, $dvdTwo);


echo $dvdRomOne->prixTotal([$dvdRomOne, $dvdRomTwo, $dvdRomThree, $bluerayOne, $bluerayTwo]);



















?>

