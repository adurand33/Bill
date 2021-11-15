<?php require 'assets/php/header.php';

// register button was hit

// alert user

if (!empty($_GET)) {

  if (isset($_GET['success'])) { echo '<div id="userAlert" data="success">You successfully registered</div>'; }
  if (isset($_GET['email'])) { echo '<div id="userAlert" data="danger">Email already used</div>'; }
  if (isset($_GET['pseudo'])) { echo '<div id="userAlert" data="danger">Pseudo already used</div>'; }
  if (isset($_GET['error'])) { echo '<div id="userAlert" data="info">An error occurred in registration</div>'; }
} ?>

<script src="assets/js/warn.js"></script>
<script src="assets/js/clear.js"></script>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">

  <div class="row align-items-center g-lg-5 py-5">

    <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-5 fw-bold lh-1 mb-3">Billable Register</h1>
      <p class="col-lg-10 fs-4">🤑 Online customers bills</p>
    </div>

    <div class="col-md-10 mx-auto col-lg-6">

      <form action="registerpost.php" class="p-4 p-md-5 border rounded-3 bg-light" method="POST">

        <!-- email -->
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="User email">
          <label for="inputEmail">Enter email</label>
        </div>

        <!-- pseudo -->
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="inputPseudo" name="pseudo" placeholder="User pseudo">
          <label for="inputPseudo">Enter pseudo</label>
        </div>

        <!-- password -->
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="User password">
          <label for="inputPassword">Enter password</label>
        </div>

        <!-- password2 -->
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="inputPassword2" name="password2" placeholder="Re-type password">
          <label for="inputPassword2">Confirm password</label>
        </div>

        <!-- submit -->
        <button type="submit" class="w-100 btn btn-lg btn-primary" id="submitRegister">Register</button>
        <hr class="my-4">
        <small class="text-muted">Clicking Register, you agree to the terms of use</small>

        <script src="assets/js/register.js"></script>

     </form>

    </div>
  </div>

</div>
