<?php include "header.php"; ?>


<div class="row">

	<?php include "sidebar.php"; ?>

	<h3>Page Réalisateurs</h3>

	<?php

	$id = $_GET['id'];


	$film = getFilmDirector($id, $connexion);

		foreach ($film as $key => $value) {
			echo $value['titreFilm'];
		}
	

	?>

	

</div>


<?php include "footer.php"; ?>

