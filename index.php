
<!-- Inclusion du header contant : le fichier functions.php et l'appel de la BDD -->
	<?php include "header.php"; ?>

<!-- Titre du site -->
	<div class="page-header">
	  <h1>Cinéma BDD <small>PHP</small></h1>
	</div>



<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8">
  
 <!-- ////////////Fonction des 6 derniers films///////////// -->
	<?php
	$lastMovies = getSixBestMovies($connexion);
	?>
	<div class="row">

		<?php include "sidebar.php"; ?>

		<div class="col-lg-6 col-md-6 text-center">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">Mes 6 derniers films</h3>
				</div>
				<div class="panel-body">
					<ul>
					<?php
						foreach ($lastMovies as $movie) { ?>
						<li><?php echo $movie['title']; ?></li>
					<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

		<!-- ///////////////Fonction des 3 derniers films////////// -->


	<?php 

	$lastThreeMovies = getThreeNextMovies($connexion);

	?>
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Films en VO/VOST </h3>
				</div>
				<div class="panel-body">
					<ul>

						<?php foreach ($lastThreeMovies as $key => $value) { ?>
					
						<li>
							<!-- transmettre dynamiquement l'ID de mes films das mon URL : movie.php -->
							<h4> <a href="movie.php?id=<?php echo $value['id'] ?>" > <?php  echo  $value['title'] ?></a> </h4>
							<img src="<?php echo $value['image'] ?>" width='80 'height='auto'/>
							<p>Durée du film : <?php echo $value['duree'] ?> heures</p>

							<?php if($value['note_presse'] >4){ ?>
							<span class="label label-info"> <?php echo $value['note_presse'] ?> / 5 </span>
						    <?php }else if($value['note_presse'] <= 4 && $value['note_presse'] > 2){ ?>
							<span class="label label-danger"> <?php echo $value['note_presse'] ?> / 5 </span>
						    <?php }else{ ?>
						    <span class="label label-success"> <?php echo $value['note_presse'] ?> / 5 </span>
						    <?php } ?>

							<p><?php  echo  $value['synopsis'];  ?></p>
							<p>Date de sortie du film : <?php  echo  $value['date_release'];  ?></p>
							<p>Budget : <?php  echo  $value['budget'] ?> euros </p>
						</li><hr> 
						<?php } ?> <!-- fin de ma boucle -->
					</ul>
				</div>
			</div>
		</div>
	</div>
  
  </div>
    <!-- ////////////Fonction des 6 derniers commentaires///////////// -->
	<?php
	$lastSixComments = getSixLastComments($connexion);
	?>

	<div class="col-lg-4 col-md-4 text-center">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Mes 6 derniers commentaires</h3>
			</div>
			<div class="panel-body">
				<ul>
				<?php
					foreach ($lastSixComments as $value) { ?>
					<li><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>     Commentaire  :  <?php echo $value['content']; ?></li>
					<li><span class="glyphicon glyphicon-user" aria-hidden="true"></span>     Date de création  :  <?php echo $value['created_at']; ?></li>
					<li><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>     Note  :  <?php echo $value['note']; ?></li><hr>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

  </div>




<div class="row">
    <div class="col-lg-9 col-md-9"></div>


	<!-- ///////////////Fonction des 5 derniers users////////// -->

	<?php  $lastUsers = getFiveLastUsers($connexion) ?>
	<div class="col-lg-6 col-md-6 ">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h3 class="panel-title">Utilisateurs VIP</h3>
			</div>
			<div class="panel-body">
				<ul>

					<?php foreach ($lastUsers as $value) { ?>
				
					<li>
						<img src="<?php echo $value['avatar'] ?>" width='50 'height='auto'/>
						<a href="#" class="btn btn-warning">Nom utilisateur : <?php echo $value['username'] ?> </a>
						<p> <?php  echo  $value['ville'] ?> </p>
						<p>Coordonnées : <?php  echo  $value['tel']. $value['email']  ?></p>
						<p><?php  echo  $value['created_at'] ?></p>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

<!-- ///////////////Fonction des 3 videos////////// -->

	<?php  $lastVideos = getThreeVideos($connexion) ?>
	<div class="col-lg-6 col-md-6 ">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Videos</h3>
			</div>
			<div class="panel-body">
				<ul>

					<?php foreach ($lastVideos as $value) { ?>
				
					<li>
						<?php echo $value['mtitle'] ?>
						<?php echo $value['video'] ?>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

<!-- ///////////////Fonction des 4 catégories////////// -->

	<?php  $categories = getFourCategories($connexion) ?>
	<div class="col-lg-6 col-md-6 ">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Catégories principales</h3>

			</div>
			<div class="panel-body">
				<ul>

					<?php foreach ($categories as $value) { ?>
				
					<li>
						<a href="categorie.php?id=<?php echo $value['catId'] ?>"><span class="label label-info"> <?php  echo  $value['titreCategorie'] ?> </a> </span>

						<span class="label label-success">  Nombre de films :  <?php  echo  $value['nombreFilm'] ?> </span>
						<span class="label label-warning">  Description : <?php  echo  $value['descriptionCategorie'] ?> </span>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

<!-- ///////////////Fonction des meilleurs acteurs////////// -->

	<?php  $actors = getBestActors($connexion) ?>
	<div class="col-lg-12 col-md-12 ">
		<div class="panel panel-primary">
			<div class="panel-heading">
		       <h3 class="panel-title">Meilleurs acteurs</h3>

			
			<?php foreach ($actors as $value) { ?>
				<div class="panel-body">
			<div class="col-lg-4 col-md-4 ">
			
		
					<a href="acteur.php?id=<?php echo $value['acteur'] ?>"><?php  echo  $value['actors'] ?></a>
			
			    </div>
			<?php } ?>
	
           
           </div>
     </div>
    </div>

    <!-- ///////////////Fonction des  6 meilleurs réalisateurs////////// -->

	<?php  $realisateurs = getBestDirectors($connexion) ?>
	<div class="col-lg-12 col-md-12 ">
		<div class="panel panel-success">
			<div class="panel-heading">
		<h3 class="panel-title">Meilleurs réalisateurs</h3>

			
			<?php foreach ($realisateurs as $value) { ?>
			<div class="panel-body">
			<div class="col-lg-4 col-md-4 ">
		
		    <a href="realisateur.php?id= <?php echo $value['directorId'] ?>"><?php  echo  $value['nomRealisateur'] ?></a><br/>
			<?php  echo  $value['nombreFilm'] ?><br/>

			
			</div>
			<?php } ?>
	
           
        </div>
    </div>

  </div> 
</div>



<?php include "footer.php"; ?>