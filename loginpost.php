<?php require 'assets/php/connect.php';

// submit button clicked

$success = false;
$unknown = false;

if (!empty($_POST)) {

	// fields are set

	if (!in_array('', $_POST)) {

		// sanitize

		$email = htmlspecialchars($_POST['email']);
		$pass = htmlspecialchars($_POST['pass']);

		// query

    $getUserByEmailReq = "SELECT * FROM user WHERE email = :email";
    $getUserByEmailExecute = $connection->prepare($getUserByEmailReq);
    $getUserByEmailExecute->bindValue(':email', $email, PDO::PARAM_STR);

    $success = $getUserByEmailExecute->execute();
    $getUserData = $getUserByEmailExecute->fetch();

    // user found

    $success = false;
    $unknown = empty($getUserData);

		if (!$unknown) {

      $hash = $getUserData['password'];

      if (password_verify($pass, $hash)) {

        $_SESSION['id'] = $getUserData['id'];
        $_SESSION['pseudo'] = $getUserData['pseudo'];
        $_SESSION['email'] = $getUserData['email'];
        $_SESSION['token'] = uniqid(rand(), true);

        $success = true;
      }
    }
	}

  header('Location:index.php?' . ($unknown ? 'unknown' : ($success ? 'login' : 'wrong')));

	unset($_POST);
}
