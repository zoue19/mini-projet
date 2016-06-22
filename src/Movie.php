<?php

namespace src;


setlocale(LC_MONETARY, "fr_fr");

class Movie{

	protected $titre;

	protected $synopsis;

	protected $annee;

	protected $daterelease;

	protected $budget;

	protected $visible = true;

	protected $distributeur;

	protected $connexion;

	protected $id;

	protected $prixTtc;


	const VERSION = "1.0";




   public function __construct($annee = null, $distributeur = null, Connexion $connexion = null, $id = null){

	$this->annee = $annee;
	$this->distributeur = $distributeur;
	if($connexion){		
	$this->connexion = $connexion->connect();
	}
	$this->id = $id;
	//j'utilise la méthode de la classe connexion car on a lié les deux classes
	//j'initialise ma connexion à la bdd par l'intermédiaire de mon objet $connexion
	//dependance entre la classe movie et connexion
	//on peut appeler des méthodes (=connect() qui se trouve dans Connexion)dans des classes en fait, oui oui c'est possible

	}



	public function getTitre(){
		return $this->titre;
	}

	public function getSynopsis(){
		return $this->synopsis;
	}

	public function getAnnee(){
		return $this->annee;
	}

	public function getDaterelease(){
		return $this->daterelease;
	}

	public function getBudget(){
		return $this->budget;
	}

	public function getConnexion(){
		return $this->connexion;
	}

	public function getId(){
		return $this->id;
	}

	 public function getPrixTtc()
   {
       return $this->prixTtc;
   }



	public function setTitre($titre){
		$this->titre = $titre;
	}

	public function setSynopsis($synopsis){
		$this->synopsis = $synopsis;
	}

	public function setAnnee($annee){
		$this->annee = $annee;
	}

	public function setDaterelease($daterelease){
		$this->daterelease = $daterelease;
	}

	public function setBudget($budget){
		$this->budget = $budget;
	}

	public function setConnexion($connexion){
		$this->connexion = $connexion;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setPrixTtc($prixTtc)
   {
       $this->prixTtc = $prixTtc;

       return $this;
   }




	public function Info(){

	return "<div class='jumbotron'>
			Titre: {$this->titre}
			Synopsis: {$this->synopsis}
			Annee: {$this->annee}
			Date de création: {$this->daterelease}
			Budget: {$this->budgetMovie()}
			</div>";
  
	}





	public function budgetMovie(){

		return "Le budget du film est de :" . money_format('%i', $this->budget). " €";


	}


	public function compareTwoFilm(Movie $objet2){

		if($this->budget > $objet2->budget){
			return "<span>{$this->titre}</span>";
		}else if($this->budget < $objet2->budget){
			return "<span>{$objet2->titre}</span>";
		}

	}



	public function nbMots(){

	$countWords = str_word_count($this->synopsis);

	return "<p>Nombre de mots dans le Synopsis du film {$this->titre} : <span class='badge'>{$countWords}</span> mots</p>";

	}



	public function getDistributeur(){

		if($this->distributeur == "Warner Bros" && $this->visible == true){
			return "<p>Oui, le distributeur est Warner Bros et il est visible</p>";
		}else{
			return "<p>Non, le distributeur n'est pas Warner Bros et il n'est pas visible</p>";
		}

	}


	public function getTableaudeFilms($tab = []){

		$nbFilm = "";
		$addition = 0;

		foreach ($tab as $key => $value) {
			if ($value->budget <= 10000){
				$nbFilm++;
				$addition = $addition + $value->budget;
				$moyenne = $addition / $nbFilm;
			}
		}
	return "Le nombre de films qui ont un budget inférieur à 1 000 000 euros est de : " . $nbFilm . "  et le total de l'addition de mes budgets : " . $addition . " euros. La moyenne de ces films est de :  " .$moyenne. " euros";
	}


	public function insererMovieInDb(){

		$req = $this->connexion->prepare("
			INSERT INTO movies(title, synopsis, annee, budget, date_release)
			VALUES(:titre, :synopsis, :annee, :budget, :date)
			");
		$req->execute([
			'titre' => $this->titre,
			'synopsis' => $this->synopsis,
			'annee' => $this->annee,
			'budget' => $this->budget,
			'date' => $this->daterelease
			]);

	}


	public function getLastThreeFrMovie($bo = "VOST", $distributeur = "HBO"){

		$req = $this->connexion->query(

			"SELECT title 
			FROM `movies` 
			WHERE languages= 'fr'
			AND visible = 1
			AND distributeur = '{$distributeur}'
			AND bo = '{$bo}'
			ORDER BY date_release DESC
			LIMIT 3
			");


		$resultat = $req->fetchAll();


		return $resultat;

	}

	public function insertMultipleMovies($tabObjetsMovies = []){

		foreach ($tabObjetsMovies as $key => $value) {
			$value->insererMovieInDb();
		}

   }

   public function existMovieInDb(){

   	$req = $this->connexion->query(
   		"SELECT title
   		FROM movies
   		WHERE title = '{$movie->title}'"
   	);

   	$resultat = $req->fetch();

   	if($resultat == $this->title){

   		return true;

   	}

   		return false;

   }


   public function modifierFilmFromId($id, Movie $movie){

   	$req=$this->prepare(
   	"UPDATE movies
   	SET (title = :title, synopsis = :synopsis, annee = :annee, date_release = :date_release, budget = :budget)
   	WHERE id = :id"
   	);

   	$req->execute([
    'titre' => $this->title,
	'synopsis' => $this->synopsis,
	'annee' => $this->annee,
	'date' => $this->date_release,
	'budget' => $this->budget

   	]);


   }



   public function retrouverFilmbyTitle($titre){

	   	$req = $this->connexion->query(
	   		"SELECT title
	   		FROM movies
	   		WHERE title = '{$titre}'
	   		");

	   	$resultat = $req->fetch();

	   	if($resultat == false){

	   		return false;

	   	}

	   		return true;

   }


   public function nombreFilmsTableMvies($minBudget, $maxBudget){

   		$req = $this->connexion->query(
   			"SELECT COUNT(*)
			FROM movies
			WHERE budget BETWEEN '{$minBudget}' AND '{$maxBudget}'
			");

   		$resultat = $req->fetch();

   		return $resultat;

   }


   public function retourVersLeFutur(Movie $movie){

//now est un mot clé permettant d'avoir la date d'aujourd'hui
   	$now = new DateTiem('now');
   	var_dump($now);
   	var_dump($now->format('d/m/Y'));

//Permet de générer un nouvel objet DateTime selon un format d'entrée
   	$dateFr = DateTime::createFromFormat('d/m/Y',"16/03/1988");
   	
   	var_dump(dateFr);
   	var_dump($dateFr->format('Y-m-d'));

   }

//SELF : classe (alors que this : objet)
//Cette méthode ne traite qu'avec des constantes. Je ne peux pas utiliser this

   public static function getInformationofMovie(){

   	return "<div>  La verison par defaut de tous mes films ".self::VERSION." </div>";

   }



	//  public function sortiCetteAnne(Connexion $connect, Movie $objet){


	//       $req = $connect->connect()->query(
	//         "SELECT date_release 
	//         FROM movies
	//         WHERE YEAR(date_release) == '{$objet->format('Y')}' 
	//         ");

	//       $resultat = $req->fetchAll();

	//       return $resultat;
	  
	// }




	public function prixTotal($tab = []){

			$addition = 0;
			$datetime = new \DateTime();
			$date = $datetime->format('Y-m-d');

		foreach ($tab as $value) {
			
		$addition = $addition + $value->prixTtc;
				

			if($value->daterelease > $date){

			return "<p>Le total de l'addition de mes DVDROM et Blue-Ray sortis a partir de demain est de : " . $addition . " euros. </p>";
			}

			return "<p>Non</p>";

			}


		}










}


?>