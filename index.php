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

if (isset($_GET['login'])) { echo '<div class="alert alert-success" role="alert">Logged in</div>'; }
if (isset($_GET['unknown'])) { echo '<div class="alert alert-danger" role="alert">Unknown email address</div>'; }
if (isset($_GET['wrong'])) { echo '<div class="alert alert-danger" role="alert">Wrong password</div>'; }
if (isset($_GET['deleted'])) { echo '<div class="alert alert-success" role="alert">Invoice deleted</div>'; }
if (isset($_GET['nodelete'])) { echo '<div class="alert alert-danger" role="alert">Error while deleting invoice</div>'; }
if (isset($_GET['updated'])) { echo '<div class="alert alert-success" role="alert">Invoice updated</div>'; }
if (isset($_GET['noupdate'])) { echo '<div class="alert alert-danger" role="alert">Error while updating invoice</div>'; }
if (isset($_GET['inserted'])) { echo '<div class="alert alert-success" role="alert">Invoice inserted</div>'; }
if (isset($_GET['noinsert'])) { echo '<div class="alert alert-danger" role="alert">Error while inserting invoice</div>'; }

?>

<script src="assets/js/clear.js"></script>

<div class="container">

  <?php if (isset($user)) {

    require 'billable.php';
  }
  else {

    require 'logable.php';
  } ?>

</div>
