<?php
require 'ouvrages.php';
use function Ouvrages\{findAll, findById, replace, create, removeById};

//
// Lecture de tous les ouvrages.
//
echo "<h1>Liste de tous les ouvrages</h1>";
echo "<pre>";
print_r(findAll());
echo "</pre>";

//
// Lecture d'un seul ouvrage.
//
echo "<h1>Ouvrage id = 1</h1>";
echo "<pre>";
print_r(findById(1));
echo "</pre>";

//
// Création d'un nouvel ouvrage.
//
$nouveau = [
  "isbn" => null,
  "titre" => "React in Action",
  "sousTitre" => null,
  "auteurs" => "Thomas, Mark T.",
  "supports" => [ "kindle" ],
  "editeur" => "Manning Publications",
  "edition" => null,
  "anneeParution" => 2017
];

$idNouvelOuvrage = create($nouveau);
$nouvelOuvrage = findById($idNouvelOuvrage);
echo "<h1>Nouvel ouvrage</h1>";
echo "<pre>";
print_r($nouvelOuvrage);
echo "</pre>";

//
// Modification d'ou ouvrage.
//
$ouvrage = findById($idNouvelOuvrage);
$ouvrage['anneeParution'] = 2018;
replace($ouvrage['id'], $ouvrage);

$ouvrage = findById($idNouvelOuvrage);
echo "<h1>Nouvel ouvrage modifié</h1>";
echo "<pre>";
print_r($ouvrage);
echo "</pre>";

//
// Suppression d'un ouvrage
//
removeById($idNouvelOuvrage);
echo "<h1>Ouvrage supprimé</h1>";
echo "<pre>";
print_r(findById($idNouvelOuvrage));
echo "</pre>";
