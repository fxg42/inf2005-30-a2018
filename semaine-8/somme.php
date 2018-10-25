<?php
$somme = 0;
$xs = $_GET["x"] ?? [];
foreach($xs as $x) {
  $somme += $x;
}
echo $somme;
