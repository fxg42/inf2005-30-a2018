<?php
session_start();
// On efface les clés dans la session...
session_unset();
// On détruit l'entrée dans la bd et retire le cookie
session_destroy();
// Puis on redirige l'utilisateur vers la page de login avec un message de
// succes.
header('Location: login.php?succes=logout');
