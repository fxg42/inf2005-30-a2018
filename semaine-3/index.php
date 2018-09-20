<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <?php
  $user = "INF2005";
  echo "<h1>Bonjour, " . $user . "</h1>";
  echo "<h1>Bonjour, $user</h1>"; // Équivalent avec interpolation de strings
  echo "<h1>Bonjour, {$user}</h1>"; // aussi équivalent avec interpolation de strings
  ?>
  <hr>
  <h2>
<?php
  echo $user;
?>
  </h2>
  <h2><?= $user ?></h2> <!-- Équivalent! -->
</body>
</html>
