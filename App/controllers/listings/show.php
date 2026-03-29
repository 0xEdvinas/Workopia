<?php

use Framework\Database;

$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? null;

$listing = $db->query(
  "SELECT * FROM listings WHERE id = :id",
  [
    'id' => $id
  ]
)->fetch();

loadView('listings/show', ['listing' => $listing]);
