<?php require 'assets/php/connect.php';

// delete invoice button was hit

if (!empty($_SESSION)) {

  $user = $_SESSION;
  $success = false;

  if (isset($_POST['delinvoice'])) {

    // fields ok

    if (isset($_SESSION['token']) && isset($_POST['csrftoken']) && $_SESSION['token'] == $_POST['csrftoken']) {

      $invoice_id = htmlspecialchars($_POST['invoice_id']);
      $user_id = $_SESSION['id'];

      $delInvoiceReq = 'DELETE FROM invoice WHERE id = :id AND user_id = :user_id';

      $delInvoiceExecute = $connection->prepare($delInvoiceReq);
      $delInvoiceExecute->bindValue(':id', $invoice_id, PDO::PARAM_INT);
      $delInvoiceExecute->bindValue(':user_id', intval($user_id), PDO::PARAM_INT);
      $success = $delInvoiceExecute->execute();
    }
  }

  header('Location:index.php?' . ($success ? 'deleted' : 'nodelete'));

  unset($_POST);
}
