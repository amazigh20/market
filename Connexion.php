<?php

include_once("db.php");

if(isset($_POST['FormConnexion'])) {

   $emailconnect = htmlspecialchars($_POST['email']);
   $mdpconnect = sha1($_POST['mdp']);
   if(!empty($emailconnect) AND !empty($mdpconnect)) {
      $requser = $con->prepare("SELECT * FROM utilisateur WHERE email = ? AND mdp = ?");
      $requser->execute(array($emailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == true) {
         $userinfo = $requser->fetch();
         $_SESSION['ID_User'] = $userinfo['ID_User'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['email'] = $userinfo['email'];
         header('Location: accueil.php?id='.$_SESSION['ID_User']);
      } else {
         $erreur = "Mauvaise adresse Email ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
   
?>
<html>

<head>
   <title>Connexion</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="./css/style1.css">
</head>

<body>
<nav>
      <ul>
      <li> <a class="menu" href="index.php"><img class="menu" src="./img/accueil.png" alt="">Accueil</a> </li>
         <button id="btn" onclick="window.location='inscription.php'" name="Inscription">S'inscrire</button>       
      </ul>
   </nav>
   <form action="" method="POST">
      <fieldset id="section">
         
         <legend align="center"><img class ="icones" src="./img/person.png" alt=""></legend>
         <label for="email">Adresse Email :</label>
         <input type="email" autocomplete=off placeholder="Tapez votre E-mail" id="email" name="email" />
         <label for="mdp">Mot de passe :</label>
         <input type="password" autocomplete=off placeholder="Votre mot de passe" id="mdp" name="mdp" />
         
         <button id="btn2connexion" name="FormConnexion">Se connecter</button>
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