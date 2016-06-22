<?php

namespace src;

class DvdRom extends Dvd{  

  protected $couleur;
  protected $enregistrable;    

  /**
    * Get the value of Couleur
    *
    * @return mixed
    */
   public function getCouleur()
   {
       return $this->couleur;
   }    /**
    * Set the value of Couleur
    *
    * @param mixed couleur
    *
    * @return self
    */
   public function setCouleur($couleur)
   {
       $this->couleur = $couleur;        
       return $this;
   }    /**
    * Get the value of Enregistrable
    *
    * @return mixed
    */
   public function getEnregistrable()
   {
       return $this->enregistrable;
   }    /**
    * Set the value of Enregistrable
    *
    * @param mixed enregistrable
    *
    * @return self
    */
   public function setEnregistrable($enregistrable)
   {
       $this->enregistrable = $enregistrable;        
       return $this;
   } 
      //*************************************************
      //INITIALISATION DES fonction 



    public function nbMotsSynopsis($objet){

      $nbMots = str_word_count($objet->getSynopsis() );

      return "<p>Le nombre de mots dans le synopsis de {$objet->getTitre()} est de : ".$nbMots. "</p>";

    }

  
    






























}


?>