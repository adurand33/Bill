<?php require 'assets/php/header.php';

// update password button was hit

if (!empty($_SESSION)) {

  $user = $_SESSION;
  $success = false;

  $user_id = $user['id'];

  $getUserByIdReq = "SELECT * FROM user WHERE id = :user_id";
  $getUserByIdExecute = $connection->prepare($getUserByIdReq);
  $getUserByIdExecute->bindValue(':user_id', intval($user_id), PDO::PARAM_INT);

  $success = $getUserByIdExecute->execute();
  $getUserData = $getUserByIdExecute->fetch();

  if (isset($_GET['success'])) { echo '<div class="alert alert-success" role="alert">Password changed</div>'; }
  if (isset($_GET['same'])) { echo '<div class="alert alert-danger" role="alert">Passwords are identical</div>'; }
  if (isset($_GET['error'])) { echo '<div class="alert alert-danger" role="alert">Wrong password</div>'; }

} ?>

<script src="assets/js/clear.js"></script>

<div class="container">

  <?php if (isset($user)) { ?>

    <form action="profilepost.php" method="POST">

      <!-- password -->
      <div class="col-md-10 col-lg-5 mb-3">
        <label for="inputPassword" class="form-label">Enter old password</label>
        <input type="password" class="form-control" id="inputPassword" name="passold">
      </div>

      <!-- password2 -->
      <div class="col-md-10 col-lg-5 mb-4">
        <label for="inputPassword2" class="form-label">Enter new password</label>
        <input type="password" class="form-control" id="inputPassword2" name="passnew">
      </div>

      <!-- submit -->
      <div class="col-md-10 col-lg-5">
        <button type="submit" class="btn btn-danger" id="submitPass" name="changepass">Change password</button>
      </div>

      <script src="assets/js/profile.js"></script>

    </form>

  <?php }
  else {

    require 'logable.php';

 } ?>

</div>
