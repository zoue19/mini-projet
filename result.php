<?php include "header.php"; ?>

<?php include "sidebar.php"; ?>

<?php

$search = $_POST;

if(!empty($search)){

$movies = searchMovies($connexion, $search['search']); 

	if(!empty($movies)){ ?>

		<?php foreach ($movies as $movie) { ?>
			<div class="col-md-6" >
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $movie['title']; ?></h3>
					</div>
					<div class="panel-body">
						<p><?php echo $movie['description']; ?></p>
						<p><?php echo $movie['synopsis']; ?></p>
						<p><?php echo $movie['annee']; ?></p>
						<p><?php echo $movie['budget']; ?></p>
					</div>
				</div>
			</div>
		<?php } ?>

	<?php } ?>

<?php } ?>

<?php 
$cineSearch = searchCinema ($connexion, $search['search']);

if(!empty($cineSearch)){ ?>
	
	<?php foreach ($cineSearch as $cine) { 
		echo $cine['title'];
	}


} ?>