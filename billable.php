<!-- ************* -->
<!-- billable body -->
<!-- ************* -->

<form action="new.php" class="row gy-2 gx-3 justify-content-center align-items-center" method="POST">

  <!-- company -->
  <div class="col-auto">
    <input type="text" class="form-control" name="company" id="setCompany" placeholder="Company name">
  </div>

  <!-- amount -->
  <div class="col-auto">
    <input type="number" class="form-control" name="amount" id="setAmount" placeholder="Amount">
  </div>

  <!-- dued -->
  <div class="col-auto me-3">
    <input type="date" name="dued" id="dateInput">
  </div>

  <!-- submit -->
  <div class="col-auto">
    <button type="submit" class="btn btn-info" name="addinvoice">📬</button>
  </div>

</form>

<br>

<div class="tasks">
  <div class="container">
    <table class="table table-striped align-middle">

      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Company</th>
          <th scope="col">Amount</th>
          <th scope="col">Billed</th>
          <th scope="col">Dued</th>
          <th scope="col">Status</th>
          <th scope="col" class="text-center">Edit</th>
          <th scope="col" class="text-center">Delete</th>
        </tr>
      </thead>

      <tbody>

        <?php foreach ($getInvoicesData as $invoice) { ?>

          <tr>
            <th scope="row"><?= $invoice['id'] ?></th>
            <td><?= $invoice['company_name'] ?></td>
            <td><?= $invoice['amount'] ?></td>
            <td><?= $invoice['billed'] ?></td>
            <td><?= $invoice['dued'] ?></td>
            <td><?= $invoice['updated'] ?></td>

            <form action="edit.php" method="POST">
              <input type="hidden" name="invoice_id" value="<?= $invoice['id'] ?>">
              <td class="text-center"><button type="submit" class="btn btn-warning" id="" name="editinvoice">📝</button></td>
            </form>

            <form action="deletepost.php" method="POST">
              <input type="hidden" name="invoice_id" value="<?= $invoice['id'] ?>">
              <input type="hidden" name="csrftoken" value="<?= $_SESSION['token'] ?>">
              <td class="text-center"><button type="submit" class="btn btn-danger" id="" name="delinvoice">🧺</</button></td>
            </form>
          </tr>

        <?php } ?>

      </tbody>
    </table>
  </div>
</div>
