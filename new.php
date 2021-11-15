<?php require 'assets/php/header.php';

// add invoice button was hit

if (!empty($_SESSION)) {

  $user = $_SESSION;
  $success = false;

  $getStatusReq = 'SELECT * FROM status';
  $selectStatusData = $connection->query($getStatusReq)->fetchAll();

  $company = isset($_POST['company']) ? ltrim(rtrim(htmlspecialchars($_POST['company']))) : '';
  $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $address = isset($_POST['address']) ? $_POST['address'] : '';

  $bill = date('Y-m-d');
  $dued = isset($_POST['dued']) && !empty($_POST['dued']) ? $_POST['dued'] : date('Y-m-d', strtotime($bill . ' + 1 week'));

  // check company

  $getCustomerReq = "SELECT * FROM customer WHERE LOWER(company_name) = :company_name";
  $getCustomerExecute = $connection->prepare($getCustomerReq);
  $getCustomerExecute->bindValue(':company_name', $company, PDO::PARAM_STR);

  $success = $getCustomerExecute->execute();
  $getCustomerData = $getCustomerExecute->fetch();

  $company = $getCustomerData ? $getCustomerData['company_name'] : $company;
  $email = $getCustomerData ? $getCustomerData['email'] : "";
  $address = $getCustomerData ? $getCustomerData['address'] : "";
} ?>

<div class="container">

  <?php if (isset($user)) { ?>

    <form class="was-validated d-flex flex-column align-items-center" action="newpost.php" method="POST">

      <!-- company -->
      <div class="col-md-10 col-lg-5 mb-3">
        <label for="inputCompany" class="form-label">Company</label>
        <input type="text" class="form-control" id="inputCompany" name="company" value="<?= $company ?>" placeholder="Company name" required>
      </div>

      <!-- email -->
      <div class="col-md-10 col-lg-5 mb-3">
        <label for="inputEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $email ?>" placeholder="Customer email" required>
      </div>

      <!-- address -->
      <div class="col-md-10 col-lg-5 mb-3">
        <label for="inputAddress" class="form-label">Address</label>
        <textarea class="form-control" id="inputAddress" name="address" rows="3" placeholder="Customer address" required><?= $address ?></textarea>
      </div>

      <!-- amount -->
      <div class="col-md-10 col-lg-5 mb-3">
        <label for="inputAmount" class="form-label">Amount</label>
        <input type="number" class="form-control" id="inputAmount" name="amount" value="<?= $amount ?>" placeholder="Amount" required>
      </div>

      <!-- dued -->
      <div class="col-md-10 col-lg-5 mb-3">
        <label for="inputDued" class="form-label">Dued</label>
        <input type="date" class="form-control" id="inputDued" name="dued" value="<?= $dued ?>" required>
      </div>

      <!-- status -->
      <div class="col-md-10 col-lg-5 mb-4">
        <label for="selectStatus" class="form-label">Status</label>
        <select class="form-select" id="selectStatus" name="status_id" required>
          <?php foreach ($selectStatusData as $status) { ?>
            <option value="<?= $status['id'] ?>" <?= $status['id'] === 0 ? 'selected' : '' ?> >
            <?=$status['updated'];?>
            </option>
          <?php } ?>
        </select>
      </div>

      <!-- submit -->
      <div class="col-md-10 col-lg-5">
        <input type="hidden" name="invoice_id" value="<?= $editInvoiceData['id'] ?>">
        <button type="submit" class="btn btn-danger" id="submitNew" name="addinvoice">Add invoice</button>
      </div>

      <script src="assets/js/new.js"></script>

    </form>

  <?php }
  else {

    require 'logable.php';

  } ?>

</div>