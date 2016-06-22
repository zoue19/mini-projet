<?php include "header.php" ?>

<div class="row">

<?php include "sidebar.php" ?>

<h3>Page Acteur</h3>

<?php

$id = $_GET['id'];

$nombrefilmActeur = getActorsById($id, $connexion);

?> L'acteur <?php echo $nombrefilmActeur["nomActeur"]; ?>


a joué dans <?php echo $nombrefilmActeur["nombreFilm"]; ?> films <br/>


<?php

$filmActeur = getFilmName($id, $connexion);

foreach ($filmActeur as $key => $value) { ?>
	
			<img src="  <?php echo $value['imageFilm']; ?>" width="200" height="auto" /><br/>
			<?php echo $value["titreFilm"]; ?><br/>
			<?php } ?>


</div>





<?php include "footer.php" ?>