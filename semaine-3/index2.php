<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
    pre {
      background-color: #eee;
      padding: 1em;
      border-radius: 2em;
    }
  </style>
</head>
<body>
  <!--
  PHP est un langage *dynamiquement* typé:
    Le type d'une variable est déterminé au moment où la variable est utilisée.

  PHP est un langage *faiblement* typé:
    Si le type d'une variable n'est pas celui attendu, l'interpréteur tente de
    faire une conversion implicite de type (nommé _Type Juggling_)...
  
  Types possibles...
    int, float, bool, string, array, callable, classes

  Qu'est-ce que "false" ("falsy")
    0 0.0 null false "" "0" []
 
  Opérateurs:
    + - * / %
    **
    =
    && || and or xor
    < > <= >=
    <=>  négatif... ou 0... ou positif
    += -= *= /= %=
    ++
    - -
    ??
    ____ ? ____ : ___
  -->

  <pre><?php
    $x = 12;
    $y = 34;

    echo $x + $y;
    echo "\n";

    if ($x) {
      echo "dans le if";
    } elseif ($y) {
      echo "dans le elseif";
    } else {
      echo "dans le else";
    }

    /*
    switch ($x) {
      case 12:
        break;
      default:
        break;
    }

    while ($x) {
    }

    do {
    } while();

    for ($i = 0; $i < 100; $i++) {
    }
    */

    $aeroports = [ "yul", "yyz", "yvr", "ymx" ];
    echo "\n";
    echo strtoupper($aeroports[0]);
    echo "\n";

    $aeroports[] = "yyy"; // push...
    //var_dump($aeroports); // debug!

    foreach($aeroports as $item) {
      echo $item;
      echo "\n";
    }


    $aeroports2 = [
      "yul" => "Montreal",
      "yvr" => "Vancouver",
      "yyz" => "Toronto",
    ];
    $aeroports2["yul"]; // Montréal

    $aeroports2["ymx"] = "Mirabel";

    foreach($aeroports2 as $cle => $valeur) {
      echo $cle;
      echo $valeur;
      echo "\n";
    }

    function plus1 ($x = 1) {
      return $x + 1;
    }

    plus1();
    plus1(10);





  ?></pre>

</body>
</html>
