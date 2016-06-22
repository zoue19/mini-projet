<?php include "header.php" ?>


<div class="row">

<?php include "sidebar.php" ?>

<h3>Page Catégorie</h3>

<?php

$id = $_GET['id'];

$categorie = getDetailCartegorieById($id, $connexion);

?>
Le titre de la catégorie : <?php echo $categorie['titrecat']; ?> <br/>
Nombre de films dans cette catégorie : <?php echo $categorie['nbmovies'];
?> <br/>

<?php 

$id = $_GET['id'];

$image = getPicture($id, $connexion);

foreach ($image as $key => $value){ ?>

<img src="<?php echo $value['movieImage']?> " width="200" height="auto"/> 
	
<?php } ?>




</div>


<?php include "footer.php" ?>