<?php

include("db.php");


$ref_Prod = $_GET['ref_Prod'];

$sql = "DELETE FROM produits WHERE ref_Prod=:ref_Prod";
$query = $con->prepare($sql);
$query->execute(array(':ref_Prod' => $ref_Prod));


header("Location:GestionProduits.php");
?>
