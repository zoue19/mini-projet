<?php

namespace src;

class Acteur extends Personnel{


	protected $image;

	protected $biographie;

	protected $nationalite = "française";

	protected $roles = "acteur de film";

	protected $recompenses;

	protected $filmJoues = [];

	protected $connexion;

	const LANGUE = "FR";

	const PAYS = "France";




	// public function __construct(Connexion $connexion = null){
	
	// $this->connexion = $connexion->connect();

	// }





	public function getImage(){
		return $this->image;
	}

	public function getBiographie(){
		return $this->biographie;
	}

	public function getNationalite(){
		return $this->nationalite;
	}

	public function getRoles(){
		return $this->roles;
	}

	public function getRecompenses(){
		return $this->recompenses;
	}

	public function getFilmJoues(){
		return $this->filmJoues;
	}

	public function getConnexion(){
		return $this->connexion;
	}







	public function setImage($image){
		$this->image = $image;
	}

	public function setBiographie($biographie){
		$this->biographie = $biographie;
	}

	public function setNationalite($nationalite){
		$this->nationalite = $nationalite;
	}

	public function setRoles($roles){
		$this->roles = $roles;
	}
		public function setRecompenses($recompenses){
		$this->recompenses = $recompenses;
	}

	public function setFilmJoues($filmJoues){
		$this->filmJoues = $filmJoues;
	}

	public function setConnexion($connexion){
		$this->connexion = $connexion;
	}


//Créer une méthode qui permet d'insérer' en base de données l'acteur courant

	public function saveBddActeurCourant(){

		$req = $this->connexion->prepare(
			"INSERT INTO actors(biography, dob, firstname, image, lastname, nationality, recompenses, roles)
			VALUES(:biography, :dob, :fistname, :image, :lastname, :nationality, :recompenses, :roles)
			");
		$req->execute([
			'biography' => $this->biographie,
			'dob' => $this->dob,
			'fistname' => $this->prenom,
			'image' => $this->image,
			'lastname' => $this->nom,
			'nationality' => $this->nationalite,
			'recompenses' => $this->recompenses,
			'roles' => $this->roles
			]);

	}


//Créer une méthode qui retourne le nb. d'acteurs qui ont joué dans un film


	   public function countActors($film){

   		$req = $this->connexion->query(
   			"SELECT COUNT(*)
			FROM actors
			INNER JOIN actors_movies
			ON actors.id = actors_movies.actors_id
			INNER JOIN movies
			ON actors_movies.movies_id = movies.id
			WHERE movies.title = '{$title}'
			");

   		$resultat = $req->fetchAll();

   		return $resultat;

   }


//Créer une méthode qui permet de modifier l'image de l'acteur envoyé en paramètre

   






















public static function getPaysLangue(){

	return "<div>  La langue parlee est : ".self::LANGUE." et le pays est : ".self::PAYS." </div>";

}

   


}

?>