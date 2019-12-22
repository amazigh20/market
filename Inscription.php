<?php

include_once("db.php");
// connexion à la base de données "Market"

if(isset($_POST['Inscription'])) {
   $nom = htmlspecialchars($_POST['nom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $adresse = htmlspecialchars($_POST['adresse']);
   $email = htmlspecialchars($_POST['email']);
   $email2 = htmlspecialchars($_POST['email2']);
// htmlspecialchars C'est pour eviter que l'utilsateur insert des caractères HTML
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
// sha1 ça permet de crypter le MDP
   if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['pseudo']) AND !empty($_POST['adresse']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 50) {
         if($email == $email2) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $con->prepare("SELECT * FROM utilisateur WHERE email = '".$email."'");
               $reqmail->execute(array($email));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $con->prepare("INSERT INTO utilisateur(nom,prenom,pseudo,adresse,email,mdp) VALUES('".$nom."', '".$prenom."', '".$pseudo."', '".$adresse."','".$email."', '".$mdp."')");
                     $insertmbr->execute(array($nom,$prenom,$pseudo,$adresse,$email,$mdp));
                     header('Location: connexion.php');
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse E-mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse E-mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses E-mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 50 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
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
   <script src="./js/control.js" defer></script>
   <title>Inscription</title>
</head>

<body>
   <nav id="ins">
      <ul>
         <li> <a class="menu" href="accueil.php"><img class="menu" src="./img/accueil.png" alt="">Accueil</a> </li>
         <button id="btn2" onclick="window.location='connexion.php'">Se connecter</button>
      </ul>
   </nav>
   <form method="POST" action="">
      <fieldset id="section">
         
         <legend align="center"><img class="icones" src="./img/add_person.png" alt=""></legend>
         <label for="Nom">Nom :</label>
         <input type="text" autocomplete=off placeholder="Votre Nom" id="nom" name="nom" />
         <label for="Prenom">Prénom :</label>
         <input type="text" autocomplete=off placeholder="Votre Prénom" id="prenom" name="prenom" />
         <label for="pseudo">Pseudonyme :</label>
         <input type="text" autocomplete=off placeholder="Votre pseudo" id="pseudo" name="pseudo" 
         onblur="control_pseudo()"  />
         <label for="adresse">Adresse :</label>
         <input type="adresse" autocompleet=off placeholder="Votre Adresse" id="adresse" name="adresse" />
         <label for="email">Adresse Email :</label>
         <input type="email" autocomplete=off placeholder="Tapez votre E-mail" id="email" name="email" 
         onchange="correcte_email()" />
         <label for="email2">Confirmation de l'Email :</label>
         <input type="email" autocomplete=off placeholder="Confirmez votre E-mail" id="email2" name="email2"
            onblur="control_email()" />
         <label for="mdp">Mot de passe :</label>
         <input type="password" autocomplete=off placeholder="Votre mot de passe" id="mdp" name="mdp" />
         <label for="mdp2">Confirmation du mot de passe :</label>
         <input type="password" autocomplete=off placeholder="Confirmez votre mdp" id="mdp2" name="mdp2"
            onblur="control_mdp()" />
         <button id="btn" name="Inscription">S'inscrire</button>
         <br>
         
         <?php
            if(isset($erreur)) {
               echo '<font color="black" >* '.$erreur.'</font>';
            }
            ?>
      </fieldset>
 
   </form>
</body>

</html>