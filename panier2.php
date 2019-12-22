<?php

session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="Supprimer"){
if(!empty($_SESSION["panier"])) {
	foreach($_SESSION["panier"] as $key => $value) {
		if($_POST["ref_Prod"] == $key){
		unset($_SESSION["panier"][$key]);
		$status = "<div class='box' style='color:red;'>
		Le produit est supprimé de votre panier!</div>";
		}
		if(empty($_SESSION["panier"]))
		unset($_SESSION["panier"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["panier"] as &$value){
    if($value['ref_Prod'] === $_POST["ref_Prod"]){
        $value['quantite'] = $_POST["quantite"];
        break; 
    }
}
  	
}
?>
<html>
<head>
<title>Gestion du panier</title>
<link rel="stylesheet" href="./css/style1.css">
</head>
<body>
<nav>
      <ul>
      <li> <a href="index.php"><img src="./img/accueil.png" alt=""></a> </li>      
	  <button id="btn" onclick="window.location='inscription.php'" name="Inscription">S'inscrire</button>
	  <button id="btn2" onclick="window.location='connexion.php'" name="connexion">Se connecter</button>    
      </ul>
   </nav>
<div style="width:700px; margin:50 auto;">

<h2>Gestion du panier</h2>   

<?php
if(!empty($_SESSION["panier"])) {
$panier_count = count(array_keys($_SESSION["panier"]));
?>
<div class="Div_Panier">
<a class="cart" href="panier2.php"><img class="cart" src="./img/cart1.png" /> <span><?php echo $panier_count; ?></span></a>
</div>

<?php
}
?>

<div class="cart">
<?php
if(isset($_SESSION["panier"])){
    $prix_total = 0;
?>	
<table width='80%' border=0 class="tb">

<tr bgcolor='#f6b926'>
<td>

</td>
<td> DESIGNATION </td><br>
<td>  </td>
<td> QUANTITE </td>
<td> PRIX UNITAIRE </td>
<td> TOTAL </td>
</tr>	
<?php		
foreach ($_SESSION["panier"] as $produits){
?>
<tr>
<td><img src='./img/best.png' width="50" height="40" /></td>
<td><?php echo $produits["designation"]; ?><br />
<form method='POST' action=''>
<input type='hidden' name='ref_Prod' value="<?php echo $produits["ref_Prod"]; ?>" />
<input type='hidden' name='action' value="Supprimer" /></td>
<td><button type='submit' class='Supprimer'><img class ="sup" src="./img/sup.png" alt=""></button></td>

</form>

<td>
<form method='POST' action=''>
<input type='hidden' name='ref_Prod' value="<?php echo $produits["ref_Prod"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantite' class='quantite' onchange="this.form.submit()">
<option style="color:#f6b926; font-size:15;"><?php echo $produits['quantite']; ?>*</option>

<option <?php if($produits["quantite"]==1) echo "selectionné";?> value="1">1</option>
<option <?php if($produits["quantite"]==2) echo "selectionné";?> value="2">2</option>
<option <?php if($produits["quantite"]==3) echo "selectionné";?> value="3">3</option>
<option <?php if($produits["quantite"]==4) echo "selectionné";?> value="4">4</option>
<option <?php if($produits["quantite"]==5) echo "selectionné";?> value="5">5</option>
</select>
</form>
</td>
<td><?php echo $produits["prix"]." DZD "; ?></td>
<td><?php echo $produits["prix"]*$produits["quantite"]; ?></td>
</tr>
<?php
$prix_total += ($produits["prix"]*$produits["quantite"]);
}
?>




</table>	
<div align="right" class="total">


	<strong>TOTAL: <?php echo $prix_total." DZD"; ?></strong>
</div>	
  <?php
}else{
	echo "<h3>Votre Panier est vide !</h3>";
	echo("<div>
			<div id='bubbles' class='bubbles'></div>
			<div id='bubbles' class='bubbles1'></div>
			<div id='bubbles' class='bubbles2'></div>
			</div>");
	echo "<h5 style>Redirection vers l'accueil dans 3s ... </h5>";
	header( "refresh:3;url=index.php" );
	}
?>
</div>



</body>
</html>