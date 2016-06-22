<?php

//j'inclue ma classe...
include "header.php";
include "footer.php";
include "src/Connexion.php";
include "src/Movie.php";
include "src/Acteur.php";



// Objet Connexion
$myConnexion = new Connexion(3306,'localhost','cinemal9', 'root', 'troiswa');




// var_dump($myconnexion);

// echo "<p>
// 	Login {$connexion->getLogin()} <br />
// 	Password {$connexion->getPassword()} <br />
// 	DbName {$connexion->getdbName()} <br />
//     </p>";

// echo $connexion->info();


$connexionTwo = new Connexion(1231,'localhost', 'cinemal9', 'root', 'troiswa');

$connexionTwo->setCharset("utf8");
$connexionTwo->setHost("mySQL");
$connexionTwo->setLogin("admin");
$connexionTwo->setPassword("789456");
$connexionTwo->setdbName("movies7");

echo $connexionTwo->info();

$connexionThree = new Connexion(888,'localhost', 'cinemal9', 'root', 'troiswa');

// var_dump($connexion);

//Créer une méthode dans la classe connexion qui permet d'afficher sous une alerte bootstrap
//le charset et le nom de la BDD de mes connexions

//echo $connexion->alert('success', 'search');
$connexion = new Connexion(3306,'localhost','cinemal9', 'root', 'troiswa');

echo $connexion->alertBoostrap([$connexion, 
	                           $connexionTwo, 
	                           $connexionThree]);

//Créer une méthode qui permet d'afficher dans une colonne (col-X) de Bootstrap
//le jumbotron qui récapitule les informations d'une connexion.
//On mettra en paramètre à cette méthode le numéro de cette colonne qui sera par défaut "3"

echo $connexion->recapInfo(3, [$connexion, 
	                           $connexionTwo, 
	                           $connexionThree]);

//Créer une méthode qui compare 2 objets Connexion et retourne true s'ils ont le même login et mdp
// et false si contraire ;)


echo $connexion->mongoMethod($connexionTwo);


//Créer une classe Movie avec les attributs : titre, synopsis, annee, date release, budget
//Ajouter les getter et les setter et attributs
//Créer une méthode qui affiche toutes les infos d'un objet Movie
//Créer 4 objets de la classe Movie
//La construction permettra d'initialiser l'année à l'année d'aujourd'hui



$movieOne = new Movie(date("Y"), "Warner Bros", $myConnexion, 1);
//Une classe peut communiquer avec une autre

$movieOne->getLastThreeFrMovie("Warner_Bros","VO");

var_dump($movieOne->getLastThreeFrMovie("Warner_Bros","VO"));


$movieOne->setTitre("Deux Amis");
$movieOne->setSynopsis("Deux hommes, une femme, dans les rues de Paris");
$movieOne->setDaterelease("Le 20 Juin 2016");
$movieOne->setBudget(100000000000000000);



// $movieOne->insererMovieInDb();
// var_dump($movieOne);

// $movieOne->insertMultipleMovies([$movie, $movieTwo, $movieThree, $movieFour]);



$movieTwo = new Movie(date("Y"), "UGC", $myConnexion, 2);

$movieTwo->setTitre("Le Seigneur des Anneaux");
$movieTwo->setSynopsis("Deux hommes, une femme, dans les rues de Paris");
$movieTwo->setDaterelease("Le 20 Juin 2016");
$movieTwo->setBudget(10000000000000000000000);

$movieThree = new Movie(date("Y"), "Gaumont", $myConnexion, 32);

$movieThree->setTitre("Mon voisin le tueur");
$movieThree->setSynopsis("Deux hommes, une femme, dans les rues de Paris");
$movieThree->setDaterelease("Le 20 Juin 2016");
$movieThree->setBudget(1520);

$movieFour = new Movie(date("Y"),"Pathé", $myConnexion, 40);

$movieFour->setTitre("Les trois frères");
$movieFour->setSynopsis("Deux hommes, une femme, dans les rues de Paris");
$movieFour->setDaterelease("Le 20 Juin 2016");
$movieFour->setBudget(148);



echo $movieOne->Info();

echo $movieOne->budgetMovie();

echo $movieOne->compareTwoFilm($movieTwo);

echo $movieOne->nbMots();

echo $movieOne->getDistributeur();

echo $movieOne->getTableaudeFilms([$movieOne, $movieTwo, $movieThree, $movieFour]);

// echo $movieOne->modifierFilmFromId(40, $movieOne);

if($movieOne->retrouverFilmbyTitle("Le seigneur des Anneaux") == true){

	echo "<p>le titre du film est bon</p>";

}else{

	echo "<p>le titre du film n'est pas bon</p>";
}

	
foreach ($movieOne->nombreFilmsTableMvies(200, 2000000000000000000) as $value){
	echo "Le nombre de film compris entre 200 euros et 2000000000000000000 euros est de : " .$value;
}


$acteur = new Acteur($connexion);

$acteur->setNom("Mc CaunaGAY");
$acteur->setPrenom("Matthiew");
$acteur->setDob("14/04/1981");
$acteur->setImage("image1");
$acteur->setBiographie("Blond Californien");
$acteur->setNationalite("Améwicain");
$acteur->setRoles("Douglas");
$acteur->setRecompenses("Golden Globe Moustache");
$acteur->setFilmJoues("Un Indien dans la ville");


echo $acteur->saveBddActeurCourant();

foreach ($acteur->countActors("Le seigneur des anneaux") as 
	$value) {
	echo $value;
}







?>