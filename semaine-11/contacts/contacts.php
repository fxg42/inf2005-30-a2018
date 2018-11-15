<?php
$contacts = [
  ["id" => 1, "nom" => "Alice", "tel" => "123-123-1233", "email" => "alice@uqam.ca" ],
  ["id" => 2, "nom" => "Bob", "tel" => "456-456-4566", "email" => "bob@uqam.ca" ],
];

print(json_encode($contacts));
