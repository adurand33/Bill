<?php require 'assets/php/header.php';

if (!empty($_SESSION)) {

  $user = $_SESSION;
  $success = false;

  $user_id = $user['id'];

//$getInvoicesReq = 'SELECT invoice.* FROM invoice';

  $getInvoicesReq = 'SELECT invoice.*, status.updated, customer.company_name FROM invoice
                     INNER JOIN status ON invoice.status_id = status.id
                     INNER JOIN customer ON invoice.customer_id = customer.id
                     WHERE invoice.user_id = :user_id ORDER BY dued ASC';

  $getInvoicesExecute = $connection->prepare($getInvoicesReq);
  $getInvoicesExecute->bindValue(':user_id', intval($user_id), PDO::PARAM_INT);

  $success = $getInvoicesExecute->execute();
  $getInvoicesData = $getInvoicesExecute->fetchAll();
}

// alert user

if (!empty($_GET)) {

  if (isset($_GET['logged'])) { echo '<div id="userAlert" data="success">Logged in</div>'; }
  if (isset($_GET['noemail'])) { echo '<div id="userAlert" data="danger">Unknown email address</div>'; }
  if (isset($_GET['nopass'])) { echo '<div id="userAlert" data="danger">Wrong password</div>'; }
  if (isset($_GET['deleted'])) { echo '<div id="userAlert" data="info">Invoice deleted</div>'; }
  if (isset($_GET['nodelete'])) { echo '<div id="userAlert" data="info">Error while deleting invoice</div>'; }
  if (isset($_GET['updated'])) { echo '<div id="userAlert" data="success">Invoice updated</div>'; }
  if (isset($_GET['noupdate'])) { echo '<div id="userAlert" data="info">Error while updating invoice</div>'; }
  if (isset($_GET['inserted'])) { echo '<div id="userAlert" data="success">Invoice created</div>'; }
  if (isset($_GET['noinsert'])) { echo '<div id="userAlert" data="info">Error while creating invoice</div>'; }
} ?>

<script src="assets/js/warn.js"></script>
<script src="assets/js/clear.js"></script>

<div class="container">

  <?php if (isset($user)) {

    require 'billable.php';
  }
  else {

    require 'logable.php';
  } ?>

</div>
