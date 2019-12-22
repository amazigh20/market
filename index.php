<?php
session_start();
$con = mysqli_connect("localhost","root","root","market");
	if (mysqli_connect_errno()){
		echo "Connextion a MySQL echouée: " . mysqli_connect_error();
		die();
		}
		
$status="";
if (isset($_POST['ref_Prod']) && $_POST['ref_Prod']!=""){
$ref_Prod = $_POST['ref_Prod'];
$resultat = mysqli_query($con,"SELECT * FROM `produits` WHERE `ref_Prod`='$ref_Prod'");
$row = mysqli_fetch_assoc($resultat);
$designation = $row['designation'];
$contenu = $row['contenu'];
$ref_Prod = $row['ref_Prod'];
$prix = $row['prix'];


$panierArray = array(
	$ref_Prod=>array(
	'designation'=>$designation,
	'ref_Prod'=>$ref_Prod,
	'prix'=>$prix,
	'quantite'=>1,)
);

if(empty($_SESSION["panier"])) {
	$_SESSION["panier"] = $panierArray;
	$status = "<div class='box'>Produit ajouté au panier</div>";
}else{
	$array_keys = array_keys($_SESSION["panier"]);
	if(in_array($ref_Prod,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Produit déjà ajouté au panier!</div>";	
	} else {
	$_SESSION["panier"] = array_merge($_SESSION["panier"],$panierArray);
	$status = "<div class='box'>Produit ajouté au panier</div>";
	}

	}
}
?>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./css/style1.css">
	<title>Accueil</title>
</head>

<body>
	<nav>
		
		<ul>
			<li> <a class="menu" href="index.php"><img class="menu" src="./img/accueil.png" alt="">Accueil</a> </li>
			<button id="btn" onclick="window.location='inscription.php'" name="Inscription">S'inscrire</button>
			<button id="btn2" onclick="window.location='connexion.php'" name="connexion">Se connecter</button>
				
		</ul>
	</nav>
	<div style="width:800px; margin:100 auto;">

		<?php
if(!empty($_SESSION["panier"])) {
$panier_count = count(array_keys($_SESSION["panier"]));
?>
		<div class="Div_Panier">
		<a class="cart" href="panier2.php"><img class="cart" src="./img/cart1.png" /> <span><?php echo $panier_count; ?></span></a>
		</div>
		<?php
}

$resultat = mysqli_query($con,"SELECT * FROM `produits`");
while($row = mysqli_fetch_assoc($resultat)){
		echo "<div class='Div_Produits'><fieldset class='prod'>
		<form id='prod' method='post' >
		<input type='hidden' name='ref_Prod' value=".$row['ref_Prod']." />
		<div class='designation'>".$row['designation']."</div>
		<hr>
		<div class='image'><img class='produit' src='./img/best.png' /></div>
		<div class='contenu'><p class='contenu'>".$row['contenu']."</p></div>
		<hr>
		<div class='prix'>".number_format($row['prix'],2, ',', ' ')." DZD</div>
		<button id='ajp' type='submit' class='acheter'>Ajouter au panier</button>
		</fieldset>
		
		</form>
		   </div>";
  }
mysqli_close($con);
?>

		<div style="clear:both;"></div>

		<div class="message_box" style="margin:10px 0px;">
			<?php echo $status; ?>
		</div>

		<br /><br />

	</div>
</body>

</html>