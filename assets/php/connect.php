<?php

require 'env.php';

// connect

try {

  // DB connection

  $connection = new PDO(DB_HOST, DB_USER, DB_PASS);

  // error modes

  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  // start session

  session_start();
}

catch (PDOException $error) {

  echo 'Error : ' . $error->getMessage();
}

// kill session

if (isset($_GET['logout'])) {

  session_destroy();

  header('Location:index.php');
}
