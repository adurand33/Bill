<?php require 'assets/php/connect.php';

// edit invoice button was hit

if (!empty($_SESSION)) {

  $user = $_SESSION;
  $success = false;

  if (isset($_POST['editinvoice'])) {

    // fields ok

    if (!empty($_POST['dued'])) {

      $invoice_id = htmlspecialchars($_POST['invoice_id']);
      $dued = htmlspecialchars($_POST['dued']);
      $status_id = htmlspecialchars($_POST['status_id']);

      $editInvoiceReq = "UPDATE invoice SET dued = :dued, status_id = :status_id WHERE id = :id";
      $editInvoiceExecute = $connection->prepare($editInvoiceReq);
      $editInvoiceExecute->bindValue(':dued', $dued, PDO::PARAM_STR);
      $editInvoiceExecute->bindValue(':status_id', $status_id, PDO::PARAM_INT);
      $editInvoiceExecute->bindValue(':id', $invoice_id, PDO::PARAM_INT);

      $success = $editInvoiceExecute->execute();
    }
  }

  header('Location:index.php?' . ($success ? 'updated' : 'noupdate'));

  unset($_POST);
}
