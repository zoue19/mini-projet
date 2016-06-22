<?php


namespace src;

class Acteurfilm extends Acteur{



 protected $cv;
 protected $oscars = [];



	public function getCv(){
		return $this->cv;
	}

	public function getOcars(){
	return $this->oscars;
	}


	public function setCv($cv){
		$this->cv = $cv;
	}

	public function setOscars($oscars){
		$this->oscars = $oscars;
	}



























}


?>