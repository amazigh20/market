<?php

include_once("db.php");


$resultat = $con->query("SELECT * FROM produits,categories where categories.ID_cat = produits.ID_cat and produits.ID_cat=3 ORDER BY produits.ID_cat,date_publication DESC");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./css/style1.css">
	<title>Gestion des produits</title>
</head>

<body>
	<nav>
		<ul>
			<li> <a class="menu" href="accueil.php"><img class="menu" src="./img/accueil.png" alt="Accueil">Accueil</a>
			</li>
			<li> <a class="menu" href="ajoutProduit.php"><img class="menu" src="./img/ajouter.png" alt="ajouter">Ajouter
					un produit</a> </li>
			<button id="btn" onclick="window.location='connexion.php'">Se Deconnecter</button>
			<br>
		</ul>
	</nav>
    <hr color='white'>
	<nav class="cat">
		<ul class="cat">
            <li class="cat"><a class="cat" name="" href="GestionProduits.php"><img class="cat" src="./img/all.png" alt="categories">afficher tout</a></li>
			<li class="cat"><a class="cat" name="info" href="categorie.informatique.php"><img class="cat" src="./img/computer.png" alt="informatique">informatique</a></li>
			<li class="cat"><a class="cat" name="phone" href="categorie.phone.php"><img class="cat" src="./img/phone.png" alt="téléphonie">Téléphonie</a></li>
			
		</ul>
		
	</nav>
	<table width='80%' border=0>
		
		<tr id='menu' bgcolor='#232f3e'>
			<td><b>
					<font color="white">Catégorie</font>
				</b></td>
			<td><b>
					<font color="white">Designation</font>
				</b></td>
			<td><b>
					<font color="white">Contenu</font>
				</b></td>
			<td><b>
					<font color="white">Prix (DZD)</font>
				</b></td>
			<td><b>
					<font color="white">Date & heure</font>
				</b></td>
			<td><b>
					<font color="white">Modifier</font>
				</b></td>
			<td><b>
					<font color="white">Supprimer</font>
				</b></td>

		</tr>
		<?php
		while($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
		
		echo "<tr>";
		echo "<td><b><font color='red'><p id='categorie'>".($row['categorie'])."</p></font><b></th>";
		
		echo "<td><p id='designation'>".$row['designation']."</p></td>";
		
		echo "<td><p id='contenu'>".$row['contenu']."</p></td>";
		echo "<td><p id='prix'>".number_format($row['prix'],2, ',', ' ')."</p></td>";	
		echo "<td><p id='date_publication'>".$row['date_publication']."</p></td>";
		echo "<td><a href=\"Maj.php?ref_Prod=$row[ref_Prod]\"><img class ='edit' src='./img/edit.png'></a></td>";
		echo "<th><a href=\"delete.php?ref_Prod=$row[ref_Prod]\" onClick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')\"><img class ='del' src='./img/del.png'/></a></th>";		
		
	}
	?>
	</table>
</body>

</html>