<?php include "header.php"; ?>


<div class="row">

	<?php include "sidebar.php"; ?>

	<h3>Page Movie</h3>



	<?php

	$id = $_GET['id'];
	// $_GET est un tableau associatif déjà existant en PHP qui permet de récupérer les variables transmises en URL

	// Je récupére mes données de formlaire
	//_POST : tableau associatif de mes données de formulaire

	$donnes = $_POST;

	//Si mes données ne sont pas vides, si j'ai soumi mon formulaire
	if(!empty($donnes)){
	   //Insérer un commentaire en BDD
	   insererCommentInMovie($id, $connexion);

	   echo "
	   <div class='alert alert_success' >
	   Votre commentaire a bien été ajouté
	   </div>";
	}

	if(!empty($donnes)){
	   //Insérer un commentaire en BDD
	   insererMediaInMovie($id, $connexion);

	   echo "
	   <div class='alert alert_success' >
	   Votre média a bien été ajouté
	   </div>";
	}


	


	$film = getDetailMovieById($id, $connexion);

	?>
	<div class="well" >

	<h3 class="text-danger"><?php echo $film['title']; ?></h3>
	<p><?php echo $film['synopsis']; ?></p>
	<p><?php echo $film['description']; ?></p>
	<p><?php echo $film['date_release']; ?></p>

	</div>

<?php

	$séances = NextThreeSessionsById ($connexion, $id); ?>

	<h3> Les 3 prochaines séances de ce film : </h3>

	<?php

	foreach ($séances as $séance) { 
		echo $séance['dateSession']; ?> <br/>
	<?php } ?>




	<h3>Liste des commentaires</h3>

	<?php

	$commentaires = getAllCommentsByMoviesId($connexion, $id);
	foreach ($commentaires as $comment) {   ?>
		
		<p><?php echo $comment['content']  ?></p>
		<p><strong><?php echo $comment['note']  ?>
		</strong> / 5 </p>

	<?php } ?>
	

</div>

<hr/>

<div class="row">
	<div class="col-lg-12 col-md-12 ">

<!-- Formulaires avec la méthode POST : envoie les données par la navigateur et non l'URL -->

		<form action="movie.php?id=<?php echo $id ?>" method="POST" >

		<!-- Name obligatoire et unique pour récupérer les info côté serveur -->

			<label for="note"> Note </label>
			<input name="note" type="text" required="required" id="note" class="form-control"/>

			<label for="contenu"> Contenu </label>
			<textarea name="contenu" required="required" id="contenu" class="form-control"></textarea>


			<button class="btn btn-success" type="submit">Ajouter ce commentaire</button>

		</form>

	</div>
</div>

	<h3>Liste des médias</h3>

	<?php

	$medias = getAllMediaByMoviesId($connexion, $id);
	foreach ($medias as $media) {   ?>
		
		<p><?php echo $media['nature']  ?></p>
		<img src=" <?php echo $media['picture'] ?>" width="300" height="auto"></img>
		<p><?php echo $media['video']  ?></p>

	<?php } ?>


<form action="movie.php?id=<?php echo $id ?>" method="POST" >

		<!-- Name obligatoire et unique pour récupérer les info côté serveur -->

			<label for="nature"> Quel nature est le votre média ? </label>
			<select name="nature" id="nature" class="form-control">
				<option value="1">Image</option>
				<option value="2">Video</option>
			</select>

			<label for="picture"> Picture </label>
			<textarea name="picture" id="picture" class="form-control"></textarea>

			<label for="video"> Video </label>
			<textarea name="video" id="video" class="form-control"></textarea>


			<button class="btn btn-success" type="submit">Ajouter votre média</button>

		</form>

<h3>Liste des commentaires associés à ce film :</h3>

	<?php

	$comments = getComments($id, $connexion);
	foreach ($comments as $comment) {   ?>
		
		<p><?php echo $comment['content']  ?></p>

	<?php } ?>

<h3>Nombre de commentaires associés à ce film :</h3>

	<?php

	$countComments = getCountComments($id, $connexion);
	foreach ($countComments as $comment) {  

		if($comment['note'] == 5){ 
		echo str_repeat("<span class='glyphicon glyphicon-star' aria-hidden='true'></span>", $comment['note']); ?>
	<?php }
		else{ ?>
		<p><?php echo $comment['nbCom']  ?></p>
	<?php } ?>
		

	<?php } ?>

<h3>La catégorie de ce film</h3>

<?php 

	$categorie = getCategorie($id, $connexion);

	echo $categorie['categorieTitle'];

?>

<h3>Les autres films associés à cette catégorie</h3>


	
<?php 
$table = recupFilmCategorie($film['categories_id'], $connexion);


foreach ($table as $film){
	
	echo $film['moviesTitle'];
}

?>

<?php include "footer.php"; ?>