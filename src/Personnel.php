<?php

namespace src;


class Personnel{

	protected $nom;
	protected $prenom;
	protected $dob;
	protected $salaire;




	public function getNom(){
		return $this->nom;
	}

	public function getPrenom(){
		return $this->prenom;
	}

	public function getDob(){
		return $this->dob;
	}

	public function getSalaire(){
	return $this->salaire;
	}



	public function setNom($nom){
		$this->nom = $nom;
	}

	public function setPrenom($prenom){
		$this->prenom = $prenom;
	}

	public function setDob($dob){
		$this->dob = $dob;
	}

	public function setSalaire($salaire){
		$this->salaire = $salaire;
	}






	public function commenterMovie(Movie $movie){

		return "<p>
		{$this->nom}
		{$this->prenom}
		a commente le film {$movie->getTitre()}
		</p>";

	}






















}


?>