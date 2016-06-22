<?php



namespace src;



class Session{

	protected $dateSession;

	protected $datecreated;

	protected $idMovie;


	const NBBILLETS = 100;
	const THREED = true;




 //   public function __construct($annee = null, $distributeur = null, Connexion $connexion = null, $id = null){

	// $this->annee = $annee;
	// $this->distributeur = $distributeur;
	// $this->connexion = $connexion->connect();
	// $this->id = $id;
	
	// }



	public function getDateSession(){
		return $this->dateSession;
	}

	public function getDatecreated(){
		return $this->datecreated;
	}

	public function getIdMovie(){
		return $this->idMovie;
	}

	


	public function setDateSession($dateSession){
		$this->dateSession = $dateSession;
	}

	public function setDatecreated($datecreated){
		$this->datecreated = $datecreated;
	}

	public function setIdMovie($idMovie){
		$this->idMovie = $idMovie;
	}




	public function dateFormat(){

		$myDate = new \DateTime($this->datecreated);
		return $myDate->format('d/m/Y H:i:s');

	}


	public function getYear(){

		$myYear = new \DateTime($this->dateSession);
		return $myYear->format('Y');

	}




	public static function differenceNbJourDateSeances(Session $objetOne, Session $objetTwo){

		$dateTimeOne = new \DateTime($objetOne->getDateSession() );
		$dateTimeTwo = new \DateTime($objetTwo->getDateSession() );
		
		$interval = $dateTimeOne -> diff($dateTimeTwo);

	return "<p> Le nombre de jours restants avant la prochaine seance : " .$interval-> format('%a jours'). "</p>";

	}


 	public static function seanceAfter(\DateTime $dateAfter,
            Connexion $co){

    $req = $co->connect()->query(
     "SELECT id
      FROM sessions
      WHERE date_session > {$dateAfter->format('Y-m-d')}"
    );

    return $req->fetchAll();

    }



    public function soustraireDate($interval){

	    $date = new \DateTime($this->dateSession); 

		$date->sub(new \DateInterval($interval));

		return $date->format('Y-m-d') . "\n";

    }



    public static function tableauObjetSession($tabObjets= []){

    	$date = new \DateTime($tabObjets->getDateSession);
        $annee = $date->format("Y");

    	if($annee == 2012){

    	return $date;

    	}

    	return "<p>Aucune date de session est egale a 2012</p>";
    }



    public static function dateSuperieureOuPas(Session $ojetSession, \DateTime $objetDatetime){

		$objetDatetime->format('Y-m-d H:i:s');

		$dateSession = $objetSession->getDateSession;


    	if($dateSession < $objetDatetime){

    		return true;

    	}

    		return false;

    }


    public static function nbSeances(Session $objetSession, \DateTime $dateOne, \DateTime $dateTwo){

    $datedelaSeance = $objetSession->getDateSession();
    $seance = new \DateTime($datedelaSeance);


	    if (($seance > $dateOne) && ($seance < $dateTwo)){
	      return "<p>La seance est comprise entre mes deux dates DateTime</p>";

	    }else{
	      return "<p>NON, la seance n'est pas comprise entre mes 2 dates !</p>";  
	    }


    }



  	//Compter LE NOMBRE de séances !!!!

  	public static function returnSessionSelect($dateTimeOne, $dateTimeTwo, $connect){
        $req = $connect->connect()->query(
        "SELECT id, date_session
        FROM sessions
        WHERE date_session > '{$dateTimeTwo}' 
        AND date_session < '{$dateTimeOne}'"
      );

      $resultat = $req->fetchAll();

      foreach($resultat as $result){
        echo "<div class='alert alert-warning'><hr/> Voici la Session : <span class=badge>".$result['id']."</span> // <p class='alert alert-info'>".$result['date_session'].'</p></div>';
      }
    }






	}


?>