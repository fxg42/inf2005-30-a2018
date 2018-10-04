<?php
// Les inputs et selects sont générés dynamiquement à partir de ces valeurs.
$aeroports = [ "yul" => "Montreal", "yyz" => "Toronto", "yvr" => "Vancouver", "yxe" => "Saskatoon", ];
$preferences = [ "econo" => "Économique", "econoplus" => "ÉconomiquePlus", "affaire" => "Affaire", ];

// Contient les erreurs de validations
$erreurs = [];

// Contient les valeurs saisies par l'utilisateur
$aeroportChoisi = '';
$preferencesChoisies = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // On lit les données saisies par l'utilisateur.
  $aeroportChoisi = $_POST['aeroport'] ?? '';
  // les inputs "preferences" sont lues dans un array.
  $preferencesChoisies = $_POST['preferences'] ?? [];

  // On valide que la valeur de l'aeroport choisi est vraiment dans la tableau
  // de valeurs possibles. Sinon, on ajoute un message d'erreur.
  if (! array_key_exists($aeroportChoisi, $aeroports)) {
    $erreurs[ ] = "le code d'aeroport choisi est invalide";
  }

  // On valide que l'utilisateur a choisi au moins une préférence.
  // Sinon, on ajoute un message d'erreur.
  if (count($preferencesChoisies) == 0) {
    $erreurs[ ] = 'le choix de préférence est obligatoire';
  }

  // TODO: Ajoutez une validation qui vérifie si les codes de préférences
  // choisies sont dans la liste des codes de préférences possibles.

  //
  // ATTENTION: Afin de garder l'exemple plus court, le pattern
  // Post-Redirect-Get n'est pas observé.
  //
}
//
//
// Pour valider les chaînes de caractères, vous pouvez utiliser les fonctions
// suivantes:
// - strlen
// - trim, ltrim, rtrim
// - strtolower
// - strtoupper
// - preg_match
//
// La documentation de toutes ces fonctions est disponible sur le site de PHP:
// - http://php.net/manual/en/ref.strings.php
// - http://php.net/manual/en/function.preg-match.php
//
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>validations</title>
  </head>
  <body>
    <!-- S'il y a des messages d'erreur, on les affiche dans un paragraphe -->
    <?php foreach ($erreurs as $erreur): ?>
      <p class="erreur"><?= $erreur ?></p>
    <?php endforeach; ?>
    <form method="post">
      <div>
        <!-- On génère dynamiquement la liste de checkbox de préférences -->
        <?php foreach ($preferences as $code => $desc): ?>
          <label><?= $desc ?>
            <!-- Si le code fait parties des valeurs préalablement choisies, on coche le checkbox -->
            <input type="checkbox"
                   name="preferences[]"
                   value="<?= $code ?>"
                   <?= (in_array($code, $preferencesChoisies) ? 'checked' : '') ?>
                   >
          </label>
        <?php endforeach; ?>
      </div>
      <div>
        <select name="aeroport">
          <!-- On génère dynamiquement le boite de sélection -->
          <?php foreach ($aeroports as $iata => $ville): ?>
            <!-- Si le code iata correspond à l'aeroport préalablement choisi, on sélectionne l'option --> 
            <option value="<?= $iata ?>" <?= ($iata == $aeroportChoisi ? 'selected' : '') ?> >
              <?= $ville ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <button type="submit">Envoyer</button>
      </div>
    </form>
  </body>
</html>
