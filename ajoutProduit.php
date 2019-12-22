<?php

include_once("db.php");

if(isset($_POST['ajoutProduit'])) {	
   $designation = htmlspecialchars($_POST['designation']);
   $contenu = htmlspecialchars($_POST['contenu']);
   $prix = htmlspecialchars($_POST['prix']);
   $ID_cat = htmlspecialchars($_POST['ID_cat']);
		
	
	if(empty($designation) || empty($contenu) || empty($prix) || empty($ID_cat)) {
				
		if(empty($designation)) {
			$erreur1 = "<font color='red'>le champ designation est vide.</font><br/>";
		}
		
		if(empty($contenu)) {
			$erreur2 = "<font color='red'>le champ contenu est vide.</font><br/>";
		}
		
		if(empty($prix)) {
			$erreur3 = "<font color='red'>le champ prix est vide.</font><br/>";
		}
		if(empty($ID_cat)) {
			$erreur1 = "<font color='red'>Veuillez choisir une categorie.</font><br/>";
		}
		
		
	} else { 
			
		$sql = "INSERT INTO produits(ID_cat,designation, contenu, prix) VALUES(:ID_cat, :designation, :contenu, :prix)";
		$query = $con->prepare($sql);
				
		$query->bindparam(':designation', $designation);
		$query->bindparam(':contenu', $contenu);
		$query->bindparam(':prix', $prix);
		$query->bindparam(':ID_cat', $ID_cat);
		
		$query->execute();
		
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./css/style1.css">
    <title>Ajouter produit</title>
</head>
<body>
<nav>
      <ul>
      <li> <a class="menu" href="accueil.php"><img class="menu" src="./img/accueil.png" alt="">Accueil</a> </li>
      <li> <a class="menu" href="GestionProduits.php"><img class="menu" src="./img/produits.png" alt="produits">Produits</a> </li>  
         <button id="btn" onclick="window.location='connexion.php'" >Se Deconnecter</button>
                 
      </ul>
   </nav>
    
	<form method="POST" action="" name=form1>
      <fieldset id="section">

         <legend align="center"><img class="icones" src="./img/add.png" alt=""></legend>
         <label for="designation">Désignation du produit :</label>
         <input type="text" autocomplete=off name="designation" 
         placeholder="designation du produit"/><br />
         <label for="contenu du produit">Description du produit :</label>          
		 <textarea type="text" name="contenu" placeholder="contenu du produit"></textarea>
		 <label for="ID_cat">Catégories :</label>
		 <select name="ID_cat">
			 <option value="1">Informatique</option>
			 <option value="2">Téléphonie</option>
			 <option value="3">Sport & Loisirs</option>
		 </select>
         <label for="prix">Prix du produit (DZD) :</label>
         <input type="text" name="prix" placeholder="Le prix du produit">   
		 <button id="btn" type="submit" name="ajoutProduit">Ajouter</button><br />
		 
      </fieldset>
	  </form>
</body>
</html>
