<?php require 'assets/php/connect.php';

if (!empty($_SESSION)) {

  $user = $_SESSION;
  $success = false;
  $passequal = false;

  $user_id = $user['id'];

  // changepass button was hit

  if (isset($_POST['changepass'])) {

    // fields ok

    if (!empty($_POST['passold']) && !empty($_POST['passnew'])) {

      $passold = htmlspecialchars($_POST['passold']);
      $passnew = htmlspecialchars($_POST['passnew']);

      $passequal = $passold == $passnew; // also checked in js

      // query

      $getPasswordReq = "SELECT password FROM user WHERE id = :id";
      $getPasswordExecute = $connection->prepare($getPasswordReq);
      $getPasswordExecute->bindValue(':id', intval($user_id), PDO::PARAM_INT);

      $success = $getPasswordExecute->execute();
      $getPasswordData = $getPasswordExecute->fetch();

      $success = false;
      $hash = $getPasswordData['password'];

      // password ok

      if (password_verify($passold, $hash)) {

        $hash = password_hash($passnew, PASSWORD_DEFAULT);

        $editPasswordReq = "UPDATE user SET password = :password WHERE id = :id";
        $editPasswordExecute = $connection->prepare($editPasswordReq);
        $editPasswordExecute->bindValue(':password', $hash, PDO::PARAM_STR);
        $editPasswordExecute->bindValue(':id', intval($user_id), PDO::PARAM_INT);

        $success = $editPasswordExecute->execute();
      }
    }

    // warning

    header('Location:profile.php?' . ($passequal ? 'same' : ($success ? 'success' : 'error')));

    unset($_POST);
  }
}
