<?php

namespace src;

class BlueRay extends Movie{  

 protected $typeDeMedia="Disque Optique";
 protected $codage=['MEPG-4','H.264','VC-1'];
 protected $lecture=[36,45,67];    

 /**
    * Get the value of Type De Media
    *
    * @return mixed
    */
   public function getTypeDeMedia()
   {
       return $this->typeDeMedia;
   }    /**
    * Set the value of Type De Media
    *
    * @param mixed typeDeMedia
    *
    * @return self
    */
   public function setTypeDeMedia($typeDeMedia)
   {
       $this->typeDeMedia = $typeDeMedia;        return $this;
   }    /**
    * Get the value of Codage
    *
    * @return mixed
    */
   public function getCodage()
   {
       return $this->codage;
   }    /**
    * Set the value of Codage
    *
    * @param mixed codage
    *
    * @return self
    */
   public function setCodage($codage)
   {
       $this->codage = $codage;        return $this;
   }    /**
    * Get the value of Lecture
    *
    * @return mixed
    */
   public function getLecture()
   {
       return $this->lecture;
   }    /**
    * Set the value of Lecture
    *
    * @param mixed lecture
    *
    * @return self
    */
   public function setLecture($lecture)
   {
       $this->lecture = $lecture;        return $this;
   }  /*Créer une methode permettant de modifier le prix selon 2 paramètres: une promotion (en €: valuer de 0 par défaut)
   ou une réduction (en %, valeur de 0% par defaut) sur tous les DVD ou BlueRay */public function modifPromo($euro=0, $reduc=0){
    }


    public function insererBlueRayInDb(){

    $req = $this->connexion->prepare(
      "INSERT INTO movies(title, synopsis)
      VALUES(:titre, :synopsis)
      ");

    $req->execute([
      'titre' => $this->titre,
      'synopsis' => $this->synopsis,
      ]);


  }


















  }
?>