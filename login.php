<?php require 'assets/php/header.php' ?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">

  <div class="row align-items-center g-lg-5 py-5">

    <div class="col-lg-7 text-center text-lg-start">
      <h1 class="display-5 fw-bold lh-1 mb-3">Billable Log in</h1>
      <p class="col-lg-10 fs-4">🤑 Online customers bills</p>
    </div>

    <div class="col-md-10 mx-auto col-lg-5">

      <form action="loginpost.php" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="name@example.com">
          <label for="inputEmail">Enter email</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="inputPassword" name="pass" placeholder="Password">
          <label for="inputPassword">Enter password</label>
        </div>
        <button type="submit" class="w-100 btn btn-lg btn-primary" id="submitLogin">Log In</button>
      </form>

      <script src="assets/js/login.js"></script>

    </div>

  </div>

</div>