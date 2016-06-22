<?php


namespace src;



class Dvd extends Movie{

	protected $prixTtc;
  protected $taxe = 19.6;
  protected $capacite = [4,6,8];
  protected $fabricant = [Phillips, Sony, Toshiba];
	protected $diametre = [12,25,8];
	protected $poids;
	protected $coucheDouble;
  protected $daterelease;
   /**
    * Get the value of Prix Ttc
    *
    * @return mixed
    */
   public function getPrixTtc()
   {
       return $this->prixTtc;
   }

    /**
    * Set the value of Prix Ttc
    *
    * @param mixed prixTtc
    *
    * @return self
    */
   public function setPrixTtc($prixTtc)
   {
       $this->prixTtc = $prixTtc;

       return $this;
   }

  public function getDaterelease()
    {
      return $this->daterelease;
    }

  public function setDaterelease($daterelease)
  {
    $this->daterelease = $daterelease;
  }

  

   /**
    * Get the value of Taxe
    *
    * @return mixed
    */
   public function getTaxe()
   {
       return $this->taxe;
   }

   /**
    * Set the value of Taxe
    *
    * @param mixed taxe
    *
    * @return self
    */
   public function setTaxe($taxe)
   {
       $this->taxe = $taxe;

       return $this;
   }

   /**
    * Get the value of Capacite
    *
    * @return mixed
    */
   public function getCapacite()
   {
       return $this->capacite;
   }

   /**
    * Set the value of Capacite
    *
    * @param mixed capacite
    *
    * @return self
    */
   public function setCapacite($capacite)
   {
       $this->capacite = $capacite;

       return $this;
   }

   /**
    * Get the value of Fabricant
    *
    * @return mixed
    */
   public function getFabricant()
   {
       return $this->fabricant;
   }

   /**
    * Set the value of Fabricant
    *
    * @param mixed fabricant
    *
    * @return self
    */
   public function setFabricant($fabricant)
   {
       $this->fabricant = $fabricant;

       return $this;
   }

   /**
    * Get the value of Diametre
    *
    * @return mixed
    */
   public function getDiametre()
   {
       return $this->diametre;
   }

   /**
    * Set the value of Diametre
    *
    * @param mixed diametre
    *
    * @return self
    */
   public function setDiametre($diametre)
   {
       $this->diametre = $diametre;

       return $this;
   }

   /**
    * Get the value of Poids
    *
    * @return mixed
    */
   public function getPoids()
   {
       return $this->poids;
   }

   /**
    * Set the value of Poids
    *
    * @param mixed poids
    *
    * @return self
    */
   public function setPoids($poids)
   {
       $this->poids = $poids;

       return $this;
   }

   /**
    * Get the value of Couche Double
    *
    * @return mixed
    */
   public function getCoucheDouble()
   {
       return $this->coucheDouble;
   }

   /**
    * Set the value of Couche Double
    *
    * @param mixed coucheDouble
    *
    * @return self
    */
   public function setCoucheDouble($coucheDouble)
   {
       $this->coucheDouble = $coucheDouble;

       return $this;
   } 




   public function comparerDeuxBudgets(Movie $objetOne, Movie $objetTwo){

	   	if($objetOne->getBudget() < $objetTwo->getBudget() ){

	   		return "Le DVD 2 - " .$objetOne->getTitre() ." - a un plus gros budget";

	   	}

	   		return "Le DVD 1 " .$objetTwo->getTitre() ." a un plus gros budget";

		}

	


	public function totalMoyenneBudget($tab = []){

	var_dump($tab);

		$totalBudget = 0 ;
		$moyenneBudget = 0;

		foreach ($tab as $key => $value) {
			$totalBudget = $totalBudget + $value->getBudget();
			$moyenneBudget = $totalBudget / 5;
		}


	return "<p>Le budget total des 5 DVD est de : " .$totalBudget. "  euros et la moyenne de mon budget : " .$moyenneBudget. " euros</p>"; 


	}



	public function insererDVDInDb(){

		$req = $this->connexion->prepare(
			"INSERT INTO movies(title, synopsis, annee, budget, date_release)
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


  public function nbMoisDvd(Dvd $objetOne, Dvd $objetTwo){


    $datetime1 = new \DateTime($objetOne->daterelease);
    $datetime2 = new \DateTime($objetTwo->daterelease);

    $interval = $datetime1->diff($datetime2);

    return  "Le nombre de mois entre les deux dates est de ".$interval->format('%m mois');




  }


      

   



  



















}
	


?>

