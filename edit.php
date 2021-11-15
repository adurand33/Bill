<?php require 'assets/php/header.php';

// edit invoice button was hit

if (!empty($_SESSION)) {

  $user = $_SESSION;
  $success = false;

  $getStatusReq = 'SELECT * FROM status';
  $selectStatusData = $connection->query($getStatusReq)->fetchAll();

  $invoice_id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : '0';

//$editInvoiceReq = 'SELECT * FROM invoice WHERE id = :id';

  $editInvoiceReq = 'SELECT invoice.*, status.updated, customer.company_name FROM invoice
                     INNER JOIN status ON invoice.status_id = status.id
                     INNER JOIN customer ON invoice.customer_id = customer.id
                     WHERE invoice.id = :id';

  $editInvoiceExecute = $connection->prepare($editInvoiceReq);
  $editInvoiceExecute->bindValue(':id', $invoice_id, PDO::PARAM_INT);

  $success = $editInvoiceExecute->execute();
  $editInvoiceData = $editInvoiceExecute->fetch();

  $company = $editInvoiceData ? $editInvoiceData['company_name'] : '';
  $amount = $editInvoiceData ? $editInvoiceData['amount'] : '0';
  $billed = $editInvoiceData ? $editInvoiceData['billed'] : '';
  $dued = $editInvoiceData ? $editInvoiceData['dued'] : '';
  $status_id = $editInvoiceData ? $editInvoiceData['status_id'] : 0;
} ?>

<div class="container">

  <?php if (isset($user)) { ?>

    <form class="was-validated d-flex flex-column align-items-center" action="editpost.php" method="POST">

      <!-- company -->
      <div class="col-md-10 col-lg-4 mb-3">
        <label class="form-label">Company</label>
        <input type="text" class="form-control" id="inputCompany" name="company" value="<?= $company ?>" placeholder="Company name" disabled>
      </div>

      <!-- amount -->
      <div class="col-md-10 col-lg-4 mb-3">
        <label class="form-label">Amount</label>
        <input type="number" class="form-control" id="inputAmount" name="amount" value="<?= $amount ?>" placeholder="Amount" disabled>
      </div>

      <!-- billed -->
      <div class="col-md-10 col-lg-4 mb-3">
        <label class="form-label">Billed</label>
        <input type="date" class="form-control" id="inputBilled" name="billed" value="<?= $billed ?>" disabled>
      </div>

      <!-- dued -->
      <div class="col-md-10 col-lg-4 mb-3">
        <label for="inputDued" class="form-label">Dued</label>
        <input type="date" class="form-control" id="inputDued" name="dued" value="<?= $dued ?>" required>
      </div>

      <!-- status -->
      <div class="col-md-10 col-lg-4 mb-3">
        <label for="selectStatus" class="form-label">Status</label>
        <select class="form-select" id="selectStatus" name="status_id" required>
          <?php foreach ($selectStatusData as $status) { ?>
            <option value="<?= $status['id'] ?>" <?= $status['id'] === $status_id ? 'selected' : '' ?> >
            <?=$status['updated'];?>
            </option>
          <?php } ?>
        </select>
      </div>

      <!-- submit -->
      <div class="col-md-10 col-lg-4">
        <input type="hidden" name="invoice_id" value="<?= $invoice_id ?>">
        <button class="btn btn-danger" id="submitEdit" name="editinvoice" type="submit">Update invoice</button>
      </div>

      <script src="assets/js/edit.js"></script>

    </form>

  <?php }
  else {

    require 'logable.php';

  } ?>

</div>
