<?php

include_once("db.php");

if(isset($_POST['Maj']))
{	
	$ref_Prod = $_POST['ref_Prod'];
	$designation = htmlspecialchars($_POST['designation']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $prix = htmlspecialchars($_POST['prix']);	
	
	
	if(empty($designation) || empty($contenu) || empty($prix) || empty($ref_Prod)) {
				
		if(empty($designation)) {
			echo "<font color='red'>le champ designation est vide.</font><br/>";
		}
		
		if(empty($contenu)) {
			echo "<font color='red'>le champ contenu est vide.</font><br/>";
		}
		
		if(empty($prix)) {
			echo "<font color='red'>le prix est vide.</font><br/>";
		}		
	} else {	
	
		$sql = "UPDATE produits SET designation=:designation, contenu=:contenu, prix=:prix WHERE ref_Prod=:ref_Prod";
		$query = $con->prepare($sql);
				
		$query->bindparam(':ref_Prod', $ref_Prod);
		$query->bindparam(':designation', $designation);
		$query->bindparam(':contenu', $contenu);
		$query->bindparam(':prix', $prix);
		$query->execute();
		
		
		header("Location: GestionProduits.php");
	}
}
?>
<?php

$ref_Prod = $_GET['ref_Prod'];


$sql = "SELECT * FROM produits WHERE ref_Prod=:ref_Prod";
$query = $con->prepare($sql);
$query->execute(array(':ref_Prod' => $ref_Prod));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$designation = $row['designation'];
	$contenu = $row['contenu'];
	$prix = $row['prix'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./css/style1.css">	
	<title>Modification produit</title>
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
		 <input type="hidden" name="ref_Prod" value="<?php echo $_GET['ref_Prod'];?>"/>
		 <label for="designation">Désignation du produit :</label>
         <input type="text" autocomplete=off name="designation" 
		 placeholder="designation du produit" value="<?php echo $designation;?>"/><br />
		 <label for="contenu du produit">Description du produit :</label>   
		 
		 <textarea name="contenu" placeholder="Description du produit" value=""><?php echo $contenu;?></textarea>

    	 <label for="prix">Prix du produit (DZD) :</label>
		 <input type="text" name="prix" placeholder="Le prix du produit" value="<?php echo $prix;?>">  
		 <button id="btn" type="submit" name="Maj">Modifier</button><br />
		 
      </fieldset>
	  
</body>
</html>
