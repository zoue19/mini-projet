<?php

namespace src;

/*Classe représentative de ma Connection en bdd*/
class Connexion{

//je déclare mes attributs en "protected"
	/**
	* Attribut host
	*/
	protected $host = "localhost";

	/**
	* Attribut login
	*/
	protected $login;

	/**
	* Attribut mot de passe
	*/
	protected $password;

	/**
	* Attribut charset : valeur par défaut
	*/
	protected $charset = "utf8";

	/**
	* Attribut nom base de donnée
	*/
	protected $dbName;

	/**
	* Attribut temps de connexion
	*/
	protected $timeout = "5";

	protected $port;

	const SGBD = "Mysql";


//Méthode magique qui permet d'initialiser des propriétés de mon objet
//Constructeur de ma classe
//Oblige lors de la création d'un objet, d'initialiser certaines propriétés comme port et host
//Lors de la création de chaque objet, il faut rentrer ces paramètres

    public function __construct($port, $host = "localhost", $dbName = "", $login, $password){

    	$this->port = $port;
    	$this->host = $host;
    	$this->dbName = $dbName;
    	$this->login = $login;
    	$this->password = $password;

    }



    /**
* Accéder aux attributs : Getter (le récupérer ou le modifier)
	*/
	public function getHost(){
		return $this->host;
	}

	public function getLogin(){
		return $this->login;
	}

	public function getPassword(){
		return $this->password;
	}


	public function getCharset(){
		return $this->charset;
	}

	public function getDbName(){
		return $this->dbName;
	}

	public function getTimeout(){
		return $this->timeout;
	}


//Setter permet de modifier la valeur d'un attribut protégé
	public function setCharset($charset){
		$this->charset = $charset;
	}

	public function setHost($host){
		$this->host = $host;
    }

	public function setLogin($login){
		$this->login = $login;
    }

	public function setPassword($password){
		$this->password = $password;
    }

	public function setDbName($dbName){
		$this->dbName = $dbName;
    }

	public function setTimeout($timeout){
		$this->timeout = $timeout;
    }

//Méthode qui affiche les infos de ma connexion
    public function info(){
    	return "<div class='jumbotron'>
    			Host: {$this->host}
    			Login: {$this->login}
    			Password: {$this->password}
    			</div>";
    }
//$this représente l'objet courant dans la classe


    public function alert($couleur = 'danger',$icone ='plus'){
    	return "<div class='alert alert-{$couleur}' role='alert'>
		    	Charset : {$this->charset} <br />
		    	Nom de base de données : {$this->dbName}
		    	<span class='glyphicon glyphicon-{$icone}' aria-hidden='true'></span>
		    	</div>";
    }

    public function alertBoostrap($tab){

    	foreach ($tab as $key => $value) {
    	
	    	return "<div class='alert alert-danger' role='alert'>
	    			Login : {$value->login}
	    			Mot de passe : {$value->password}
	    			</div>";

    	}
    }

    public function recapInfo($col = 3, $tab){

    	return "<div class='container'>
    				<div class='row'>
    					{$this->info()}
    					<div class='col-md-{$col} jumbotron'>
    						{$this->alertBoostrap($tab)}
    					</div>
    				</div>
    			</div>";

    }

    public function recapInfoTab($tabObjets=[]){

    	$html = "";

    	foreach ($tabObjets as $obj) {
    		$html .= $obj->recapInfo();
    	}

    return $html;
    
    }


    public function mongoMethod(Connexion $objet){

    	if($this->login == $objet->login && $this->password == $objet->password){
    		return true;

    	}else{
    		return false;
    	}

    }

//Permet une connexion à la BDD
//La méthode peut retourner un objet

	public function connect(){

    $connexion = new \PDO("mysql:host={$this->host}; dbname={$this->dbName}; charset={$this->charset}",$this->login,$this->password);

    return $connexion;
    //Objet PDO

	}

	











}










?>