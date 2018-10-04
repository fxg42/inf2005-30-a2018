<?php
session_start();
// S'il s'agit d'une soumission de formulaire, la requête HTTP entrante sera un
// POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validation de la combinaison codeutilisateur/motdepasse
  if ($_POST['codeutilisateur'] == 'alice' && $_POST['motdepasse'] == 's3cret') {
    // On sauvergarde le codeutilisateur. C'est la clé qui indiquera que
    // l'utilisateur est loggé.
    $_SESSION['codeutilisateur'] = $_POST['codeutilisateur'];

    // On redirige vers l'url d'origine ou s'il n'y en a pas, à la page index.
    // L'URL d'origine a été sauvegardée si l'utilisateur a accédé directement à
    // la page index.php sans passer par la page de login.
    $redirectUrl = $_SESSION['redirecturl'] ?? 'index.php';
    header("Location: {$redirectUrl}");
    exit;
  } else {
    // On sauvegarde le code utilisateur dans les cookies du fureteur.
    setcookie('codeutilisateur', $_POST['codeutilisateur']);
    // et on redirige vers la page de login avec un message d'erreur dans l'url.
    header("Location: login.php?erreur=login");
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Ouverture de session</title>
  </head>
  <style>
    p.erreur { color: red; }
    p.succes { color: limegreen; }
  </style>
  <body>
    <h1>Veuillez ouvrir une session</h1>
    <?php if ($_GET['erreur'] == 'login'): ?>
      <p class="erreur">La combinaison est incorrecte.</p>
    <?php endif; ?>
    <?php if ($_GET['erreur'] == 'droitacces'): ?>
      <p class="erreur">Vous devez ouvrir une session.</p>
    <?php endif; ?>
    <?php if ($_GET['succes'] == 'logout'): ?>
      <p class="succes">Votre session est fermée.</p>
    <?php endif; ?>
    <form method="post">
      <div>
        <label for="codeutilisateur">Code utilisateur</label>
        <!-- la valeur du codeutilisateur est prise des cookies si elle est présente -->
        <input type="text" id="codeutilisateur" name="codeutilisateur" value="<?= $_COOKIE['codeutilisateur'] ?>">
      </div>
      <div>
        <label for="motdepasse">Mot de passe</label>
        <input type="password" id="motdepasse" name="motdepasse">
      </div>
      <button type="submit">Ouvrir la session</button>
    </form>
  </body>
</html>
