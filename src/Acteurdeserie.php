<?php


namespace src;

class Acteurdeserie extends Acteur{



 protected $nomDeSerie;
 protected $surnom;



	public function getNomDeSerie(){
		return $this->nomDeSerie;
	}

	public function getSurnom(){
	return $this->surnom;
	}


	public function setNomDeSerie($nomDeSerie){
		$this->nomDeSerie = $nomDeSerie;
	}

	public function setSurnom($surnom){
		$this->surnom = $surnom;
	}



























}


?>