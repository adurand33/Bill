<?php require 'assets/php/connect.php';

// add invoice button was hit

if (!empty($_SESSION)) {

  $user = $_SESSION;
  $success = false;

  $user_id = $user['id'];

  if (isset($_POST['addinvoice'])) {

    // fields ok

    if (!empty($_POST['company']) && !empty($_POST['amount'])) {

      $company = htmlspecialchars($_POST['company']);

      // check company

      $getCustomerReq = "SELECT * FROM customer WHERE LOWER(company_name) = :company_name";
      $getCustomerExecute = $connection->prepare($getCustomerReq);
      $getCustomerExecute->bindValue(':company_name', $company, PDO::PARAM_STR);

      $success = $getCustomerExecute->execute();
      $getCustomerData = $getCustomerExecute->fetch();

      $customer_id = $getCustomerData ? $getCustomerData['id'] : -1;

      // create customer

      if ($customer_id < 0) {

        $email = htmlspecialchars($_POST['email']);
        $address = htmlspecialchars($_POST['address']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

          $addCustomerReq = 'INSERT INTO customer (company_name, email, address, user_id)
                             VALUES (:company_name, :email, :address, :user_id)';

          $addCustomerExecute = $connection->prepare($addCustomerReq);

          $addCustomerExecute->bindValue(':company_name', $company, PDO::PARAM_STR);
          $addCustomerExecute->bindValue(':email', $email, PDO::PARAM_STR);
          $addCustomerExecute->bindValue(':address', $address, PDO::PARAM_STR);
          $addCustomerExecute->bindValue(':user_id', intval($user_id), PDO::PARAM_INT);

          $success = $addCustomerExecute->execute();

          $customer_id = $connection->lastInsertId();
        }
      }

      // create invoice

      $amount = htmlspecialchars($_POST['amount']);
      $dued = htmlspecialchars($_POST['dued']);

      $status = empty($_POST['status']) ? 1 : htmlspecialchars($_POST['status']);

      $datebill = date('Y-m-d');
//    $datedue = date('Y-m-d', strtotime($datebill . ' + 1 week'));
      $datedue = date($dued);

      $addInvoiceReq = 'INSERT INTO invoice (amount, billed, dued, customer_id, status_id, user_id)
                        VALUES (:amount, :billed, :dued, :customer_id, :status_id, :user_id)';

      $addInvoiceExecute = $connection->prepare($addInvoiceReq);

      $addInvoiceExecute->bindValue(':amount', $amount, PDO::PARAM_INT);
      $addInvoiceExecute->bindValue(':billed', $datebill, PDO::PARAM_STR);
      $addInvoiceExecute->bindValue(':dued', $datedue, PDO::PARAM_STR);
      $addInvoiceExecute->bindValue(':customer_id', intval($customer_id), PDO::PARAM_INT);
      $addInvoiceExecute->bindValue(':status_id', intval($status), PDO::PARAM_INT);
      $addInvoiceExecute->bindValue(':user_id', intval($user_id), PDO::PARAM_INT);

      $success = $addInvoiceExecute->execute();
    }

    header('Location:index.php?' . ($success ? 'inserted' : 'noinsert'));

    unset($_POST);
  }
}
