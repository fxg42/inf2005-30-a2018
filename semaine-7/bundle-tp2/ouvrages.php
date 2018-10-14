<?php
namespace Ouvrages;

function read() {
  return json_decode(file_get_contents('./ouvrages.json'), true);
}

function write($ary) {
  file_put_contents('./ouvrages.json', json_encode($ary));
}

function findAll() {
  $ouvrages = read();
  usort($ouvrages, function ($a, $b) { return $a['id'] <=> $b['id']; });
  return $ouvrages;
}

function findById(int $id) {
  $found = array_values(array_filter(read(), function ($c) use ($id) { return $c['id'] == $id; }));
  return count($found) ? $found[0] : null;
}

function replace(int $id, $ouvrage) {
  $without = array_values(array_filter(read(), function ($c) use ($id) { return $c['id'] != $id; }));
  $without[] = $ouvrage;
  write($without);
}

function create($ouvrage) {
  $ouvrages = read();
  $highestId = array_reduce(array_column($ouvrages, 'id'), 'max') ?? 0;
  $ouvrage['id'] = $highestId + 1;
  $ouvrages[] = $ouvrage;
  write($ouvrages);
  return $ouvrage['id'];
}

function removeById($id) {
  $without = array_values(array_filter(read(), function ($c) use ($id) { return $c['id'] != $id; }));
  write($without);
}
