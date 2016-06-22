<?php //début fonction


	// Connecter à la base de données
	function connectionBdd($nomHost, $nomBdd, $login, $password, $charset = "utf8"){

		//Lancer une connection
		//host : localhost
		//dbname: nom de la base de données
		//login
		//Mdp
		$bdd = new PDO("mysql:host={$nomHost};dbname={$nomBdd};charset={$charset}",$login, $password);

		//retourne la connection de base de données
		return $bdd;
	}

	//Retourne les 6 meilleurs films selon la note de presse
	function getSixBestMovies($connexion){

		//Requête SQL et éxécution avec la fonction query()
		$req = $connexion->query(
			'SELECT id, title 
			 FROM movies 
			 ORDER BY note_presse DESC 
			 LIMIT 6'
		);

		//Récupération du résultat sous forme de tableau associatif
		$resultat = $req->fetchAll();

		//Retourne le tableau du résultat
		return $resultat;

	}

	//Lister les commentaires pour un film
	function getAllCommentsByMoviesId($connexion, $id){

		$req = $connexion->query(
			"SELECT content, note, created_at
			 FROM comments
			 WHERE comments.movies_id = {$id}"
		);

		//Récupération du résultat sous forme de tableau associatif
		$resultat = $req->fetchAll();

		//Retourne le tableau du résultat
		return $resultat;

	}

	//Insérer un commentaire dans la BDD
	//prepare() permet d'utiliser les requêtes de type insertion, modification ou suppression
	function insererCommentInMovie($id, $connexion){

		$req = $connexion->prepare("
			INSERT INTO comments(content, note, movies_id)
			VALUES(:content, :note, :movies_id)
		");

// $_POST['content'] => nom de mon champs contenu dans le formulaire
		$req->execute([
			'content' => $_POST['contenu'],
			'note' => $_POST['note'],
			'movies_id' => $id,
		]);
	}


	//Lister les commentaires pour un film
	function getAllMediaByMoviesId($connexion, $id){

		$req = $connexion->query(
			"SELECT nature, picture, video
			 FROM medias
			 WHERE medias.movies_id = {$id}"
		);

		//Récupération du résultat sous forme de tableau associatif
		$resultat = $req->fetchAll();

		//Retourne le tableau du résultat
		return $resultat;

	}

	//Insérer un média dans la BDD
	//prepare() permet d'utiliser les requêtes de type insertion, modification ou suppression
	function insererMediaInMovie($id, $connexion){

		$req = $connexion->prepare("
			INSERT INTO medias(nature, picture, video, movies_id)
			VALUES( :nature, :picture, :video, :movies_id)
		");

// $_POST['content'] => nom de mon champs contenu dans le formulaire
		$req->execute([
			'nature' => $_POST['nature'],
			'picture' => $_POST['picture'],
			'video' => $_POST['video'],
			'movies_id' => $id,
		]);
	}




	//Fonction qui affiche les 6 derniers commentaires avec leur contenu et date de création
	//Ajouter la note des commentaires sur l'affichage des 6 derniers commentaires

	function getSixLastComments($connexion){

		$req = $connexion->query(
			'SELECT content, created_at, note
			 FROM comments
			 ORDER BY created_at DESC
			 LIMIT 6'
		);

		$resultat = $req->fetchAll();

		return $resultat;

	}


 // + Fonction qui retourne les 3 prochains films Français en VO ou VOST
 //    avec Le nom, synospsy, la date de sortie, le budget et la durée + image + note_presse

	function getThreeNextMovies($connexion){

		$req = $connexion->query(
	       "SELECT title, synopsis, date_release, budget, duree, image, note_presse, id
	    	FROM movies
	    	WHERE bo = 'VO' 
	    	OR bo = 'VOST'
	    	ORDER BY date_release DESC
	    	LIMIT 3"
		);

		$resultat = $req->fetchAll();

		return $resultat;

	}


 //   + Afficher les 5 derniers utilisateurs qui se sont connectés il y a moins d'une semaine
 //     avec leur avatar, leur pseudo, leur email, leur téléphone, leur ville, leur date de connection  


	function getFiveLastUsers($connexion){

		$req = $connexion->query(
			"SELECT avatar, username, email, tel, ville, created_at
			FROM user
			ORDER BY TIMESTAMPDIFF(DAY, last_login, NOW()) < 7
			LIMIT 5"
		);

		$resultat = $req->fetchAll();

		return $resultat;

	}



   // + Bonus: Modifier la requete des 3 prochains films pour afficher également le nom des catégories associées
   
   // + Afficher les 3 derniers medias qui ont une video validées iframe

	function getThreeVideos($connexion){
		$req = $connexion->query(
			"SELECT `video`, movies.title AS mtitle
			FROM `medias`
			INNER JOIN movies
			ON medias.movies_id = movies.id
			WHERE video REGEXP 'iframe'
			LIMIT 3"
		);

		$resultat = $req->fetchAll();

		return $resultat;

	}

	
   
   // + Afficher les 4 catégories qui ont le plus de films 
   //  avec leurs nom, leurs description et le nb de film

	function getFourCategories($connexion){
		$req = $connexion->query(
		"SELECT categories.title AS titreCategorie, COUNT(movies.title) AS nombreFilm, categories.description AS descriptionCategorie, movies.title AS titreMovies, categories.id AS catId
		FROM categories
		INNER JOIN movies
		ON movies.categories_id = categories.id
		GROUP BY categories.title
		ORDER BY COUNT(movies.title) DESC
		LIMIT 4"
		);

		$resultat = $req->fetchAll();

		return $resultat;
	}

      
   // + Ajouter l'affichage d'image des films dans l'affichage 3 prochains films (2eme exercice)

    // + Afficher en Grid les 3 acteurs les plus populaires (ceux qui ont joué dans le plus de films)

    function getBestActors($connexion){
    	$req = $connexion->query(

		"SELECT COUNT(*),actors.lastname as actors, actors.id AS acteur
		FROM actors

		INNER JOIN actors_movies
		ON actors_movies.actors_id = actors.id

		INNER JOIN movies
		ON actors_movies.movies_id = movies.id

		GROUP BY actors.lastname
		ORDER BY COUNT(*) DESC
		LIMIT 3"

    	);

    	$resultat = $req->fetchAll();

		return $resultat;

    }


    //Fonction pour récupérer tout le détail d'un film via son ID

    function getDetailMovieById($id, $connexion){
    	$req = $connexion->query(
    		"SELECT *
    		FROM movies
    		WHERE id = {$id}"
        );

    	// fetch() permet de récupérer une ligne et non un tableau
        $resultat = $req->fetch();

		return $resultat;

    }



    function getDetailCartegorieById($id, $connexion){

    	$req = $connexion->query(
    		"SELECT COUNT(movies.title) AS nbmovies, categories.title AS titrecat
    		FROM movies
    		INNER JOIN categories
    		ON categories.id = movies.categories_id
    		WHERE categories.id = {$id}
    		GROUP BY titrecat"
    	);

    	$resultat = $req->fetch();

		return $resultat;


    }

     function getPicture($id, $connexion){

    	$req = $connexion->query(
    		"SELECT movies.image AS movieImage
    		FROM movies
    		WHERE movies.categories_id = {$id}"
    	);

    	$resultat = $req->fetchAll();

		return $resultat;


    }

     function getActorsById($id, $connexion){

    	$req = $connexion->query(
    		"SELECT COUNT(movies.title) AS nombreFilm, actors.lastname AS nomActeur
    		FROM movies
    		INNER JOIN actors_movies
    		ON actors_movies.movies_id = movies.id
    		INNER JOIN actors
    		ON actors_movies.actors_id = actors.id
    		WHERE actors.id = {$id}
    		GROUP BY nomActeur
    		"
    	);

    	$resultat = $req->fetch();

		return $resultat;


    }

    function getFilmName($id, $connexion){

    	$req = $connexion->query(
    		"SELECT movies.title AS titreFilm, movies.image AS imageFilm
    		FROM movies
    		INNER JOIN actors_movies
    		ON movies.id = actors_movies.movies_id
    		INNER JOIN actors
    		ON actors_movies.actors_id = actors.id
    		WHERE actors.id = {$id}"
    	);

    	$resultat = $req->fetchAll();

		return $resultat;


    }

    function getBestDirectors($connexion){

    	$req = $connexion->query(
    		"SELECT directors.lastname AS nomRealisateur, COUNT(movies.title) AS nombreFilm, directors.id AS directorId
    		FROM directors
    		INNER JOIN directors_movies
    		ON directors.id = directors_movies.directors_id
    		INNER JOIN movies
    		ON directors_movies.movies_id = movies.id
    		GROUP BY nomRealisateur
    		ORDER BY nombreFilm DESC
    		LIMIT 6"
    	);

    	$resultat = $req->fetchAll();

		return $resultat;


    }


		function getFilmDirector($id, $connexion){

    	$req = $connexion->query(
    		"SELECT movies.title AS titreFilm, directors.lastname AS directorName, movies.image AS photo
    		FROM directors
    		INNER JOIN directors_movies
    		ON directors.id = directors_movies.directors_id
    		INNER JOIN movies
    		ON directors_movies.movies_id = movies.id
    		WHERE directors.id = {$id}"
    	);

    	$resultat = $req->fetchAll();

		return $resultat;


    }


    function getComments($id, $connexion){

    	$req = $connexion->query(
    		"SELECT content
    		FROM comments
    		WHERE state = 1
    		AND comments.movies_id = {$id}
    		"
    	);

    	$resultat = $req->fetchAll();

		return $resultat;


    }


    function getCountComments($id, $connexion){

    	$req = $connexion->query(
    		"SELECT COUNT(content) AS nbCom, note
    		FROM comments
    		WHERE comments.movies_id = {$id}
    		"
    	);

    	$resultat = $req->fetchAll();

		return $resultat;


    }

    function getCategorie($id, $connexion){

    	$req = $connexion->query(
    		"SELECT categories.title AS categorieTitle
    		FROM categories
    		INNER JOIN movies
    		ON movies.categories_id = categories.id
    		WHERE movies.id = {$id} 
    		"
    	);


    	$resultat = $req->fetch();

		return $resultat;

    }


    function recupCategorie($id, $connexion){

    	$req = $connexion->query(
    		"SELECT categories_id 
    		FROM movies
    		WHERE movies.id = {$id} 
    		"
    	);

    	$resultat = $req->fetchAll();

		return $resultat;

    }


  function recupFilmCategorie($idCat, $connexion){

    	$req = $connexion->query(
    		"SELECT movies.title AS moviesTitle
    		FROM movies
    		WHERE movies.categories_id = {$idCat} 
    		"
    	);

    	$resultat = $req->fetchAll();

		return $resultat;

    }




	function insererAllContact($connexion){

		$req = $connexion->prepare("
			INSERT INTO contact(sujet, url, email, contenu)
			VALUES(:sujet, :url, :email, :contenu)
		");

		$req->execute([
			'sujet' => $_POST['sujet'],
			'url' => $_POST['url'],
			'email' => $_POST['email'],
			'contenu' => $_POST['contenu'],
		]);
	}

    //Fonction du moteur de recherche
	function searchMovies($connexion, $wordSearch){
		$req = $connexion->query(
		"SELECT id, title, synopsis, annee, budget, description
		FROM movies

		WHERE title REGEXP '{$wordSearch}'
		OR description REGEXP '{$wordSearch}'
		OR synopsis REGEXP '{$wordSearch}'
		OR budget REGEXP '{$wordSearch}'
		OR annee REGEXP '{$wordSearch}'
		"
		);

		$resultat = $req->fetchAll();

		return $resultat;

	};

	function searchCinema ($connexion, $cinema){
		$req = $connexion->query(
		"SELECT title, ville
		FROM cinema
		WHERE title REGEXP '{$cinema}'
		OR ville REGEXP '{$cinema}'
		"
		);

		$resultat = $req->fetchAll();

		return $resultat;

	};


	function NextThreeSessionsById ($connexion, $id){
		$req = $connexion->query(
		"SELECT sessions.date_session AS dateSession
		FROM sessions
		INNER JOIN movies
		ON sessions.movies_id = movies.id
		WHERE movies.id =  {$id}
		LIMIT 3
		"
		);

		$resultat = $req->fetchAll();

		return $resultat;

	};
   
       


  
  // + Afficher l'ensemble des tags dans un nuage de tags: Le nb de tags fera la police du tags
  
  // +  Bonus: Afficher un bloc Statistiques avec le NB. de films, le Nb. de catégories, 
  // 					le nb. d'acteurs et le nombre de réalisateurs et Nb. de commentaires.
  //           . Pour cela,  utiliser la fonction fetch() plutot que fetchAll() 





?><!-- fin fonction -->