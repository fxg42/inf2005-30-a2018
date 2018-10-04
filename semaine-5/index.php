<?php
session_start();
// On teste si la session contient la clé 'codeutilisateur'.
if (! isset($_SESSION['codeutilisateur'])) {
  // Si non, l'utilisateur n'est pas loggé.
  //
  // On sauvegarde dans la session la page où l'utilisateur voulait aller.
  // Il sera redirigé ici lorsqu'il aura ouvert sa session.
  // On aurait aussi pu utiliser les cookies pour ceci:
  //     setcookie('redirecturl', $_SERVER['PHP_SELF']);
  $_SESSION['redirecturl'] = $_SERVER['PHP_SELF'];
  
  // On redirige l'utilisateur vers la page de login avec un message d'erreur
  // approprié.
  //
  // La fonction `http_build_query` sert à constuire une chaîne de paramètres
  // d'URL. Elle est utile lorsqu'il y a plusieurs paramètres ou lorsqu'ils sont
  // complexes à encoder correctement.
  $params = http_build_query([ 'erreur' => 'droitacces' ]);
  header("Location: login.php?{$params}");
  exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Page sécurisée</title>
  </head>
  <body>
    <h1>Page sécurisée</h1>
    <h2>Bonjour, <?= ucfirst($_SESSION['codeutilisateur']) ?>!</h2>
    <p>Ceci est du contenu sécurisé</p>
    <p><a href="logout.php">Fermer la session.</a></p>
  </body>
</html>
