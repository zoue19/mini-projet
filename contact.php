
<?php include "header.php"; ?>

<?php include "sidebar.php"; ?>


<h3>Page de contact</h3>

<?php 
$donnes = $_POST;

// if(!empty($donnes)){

// 	  insererAllContact($connexion);

// 	   echo "
// 	   <div class='alert alert_success' >
// 	   Votre message a bien été envoyé
// 	   </div>";
// 	}

if(preg_match("/^[a-z]{3,}$/", $donnes['contenu'])){
  // save in db
  // insererAllContact($connexion);
  echo "<div class='alert alert-success'>
          Votre contact a bien été envoyé
        </div>";
}else{
  echo "<div class='alert alert-danger'>
           Votre contenu est invalide !
        </div>";
}

?>

<form action="contact.php" method="POST" class="form-group">


	<label for="sujet"> Sujet du message</label>
		<select name="sujet" id="sujet" class="form-control">
			<option value="1">Information</option>
			<option value="2">Candidature</option>
		</select>


  <div class="form-group">
    <label for="url">URL du site</label>
    <input name="url" type="url" class="form-control" id="url" placeholder="URL du site">
  </div>

    <div class="form-group">
    <label for="email">Email address</label>
    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
  </div>

  <div class="form-group">
	<label for="video"> Contenu </label>
	<textarea name="contenu" id="contenu" class="form-control"></textarea>
  </div>


  <button type="submit" class="btn btn-default">Submit</button>

</form>


<?php include "footer.php"; ?>