<?php require 'assets/php/connect.php';

// register button was hit

if (!empty($_POST)) {

  $success = false;
  $emailused = false;
  $pseudoused = false;

  // fields ok

  if (!in_array('', $_POST)) {

    $email = htmlspecialchars($_POST['email']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $pass = htmlspecialchars($_POST['password']);
    $pass2 = htmlspecialchars($_POST['password2']);

    // query email

    $getUserByEmailReq = "SELECT * FROM user WHERE email = :email";
    $getUserByEmailExecute = $connection->prepare($getUserByEmailReq);
    $getUserByEmailExecute->bindValue(':email', $email, PDO::PARAM_STR);

    $success = $getUserByEmailExecute->execute();
    $emailused = $getUserByEmailExecute->fetchColumn();

    // query pseudo

    if (!$emailused && filter_var($email, FILTER_VALIDATE_EMAIL)) {

      $getUserByPseudoReq = "SELECT * FROM user WHERE pseudo = :pseudo";
      $getUserByPseudoExecute = $connection->prepare($getUserByPseudoReq);
      $getUserByPseudoExecute->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

      $success = $getUserByPseudoExecute->execute();
      $pseudoused = $getUserByPseudoExecute->fetchColumn();

      // create user

      if (!$pseudoused && $pass == $pass2) {

        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $addUserReq = "INSERT INTO user (email, pseudo, password) VALUES (:email, :pseudo, :password)";
        $addUserExecute = $connection->prepare($addUserReq);

        $addUserExecute->bindValue(':email', $email, PDO::PARAM_STR);
        $addUserExecute->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $addUserExecute->bindValue(':password', $hash, PDO::PARAM_STR);
        $success = $addUserExecute->execute();
      }
    }
  }

  // warning

  header('Location:register.php?' . ($emailused ? 'email' : ($pseudoused ? 'pseudo' : ($success ? 'success' : 'error'))));

  unset($_POST);
}
