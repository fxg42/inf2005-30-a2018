<?php

function moyenne($xs) {
  $sum = 0;
  foreach ($xs as $x) {
    $sum += $x;
  }
  return $sum/count($xs);
}

function maximum($xs) {
  $max = $xs[0];
  foreach ($xs as $x) {
    if ($x > $max) {
      $max = $x;
    }
  }
  return $max;
}

function minimum($xs) {
  $min = $xs[0];
  foreach ($xs as $x) {
    if ($x > $min) {
      $min < $x;
    }
  }
  return $min;
}

function ecartType($xs) {
  $moyenne = moyenne($xs);
  $sum = 0;
  foreach ($xs as $x) {
    $sum += ($x - $moyenne) ** 2;
  }
  return sqrt($sum/(count($xs) - 1));
}

function mediane($xs) {
  sort($xs);
  $count = count($xs);
  if ($count % 2 == 0) {
    return moyenne([ $xs[floor($count/2)], $xs[floor($count/2) - 1] ]);
  } else {
    return $xs[floor($count/2)];
  }
}

