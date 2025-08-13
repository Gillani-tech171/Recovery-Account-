<?php 
require_once "db_config.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flexy Free Bootstrap Admin Template by WrapPixel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <?php require_once 'header-sidebar.php'; ?>

  <div class="container mt-5" style="margin-bottom:40px;">
    
    <div class="row" style="padding: 25px;">
      
      <div class="card" style="padding: 30px; margin-top:110px">

        <!-- Options to select pages -->
           <div class="mt-4 mb-4">
  <div class="row">
    <div class="col-md-4" style="margin-top: -30px;">
      <label for="ownerTypeSelector" class="form-label">Select Owner Type:</label>
      <select id="ownerTypeSelector" class="form-select">
        <option value="single" selected>Single Owner</option>
        <option value="shared">Shared Owners</option>
      </select>
    </div>
  </div>
</div>

         <!-- SINGLE OWNER SECTION -->
<div id="singleOwnerSection">
  <div class="row align-items-center">
             <div class="col-md-6 text-start">
                <button id="toggleFormBtn" class="btn btn-success mb-3">Add New Customer</button>
              </div>
              <div class="col-md-6 text-end">
    <h5 class="mb-3">Total Revenue: <span id="totalrevenue" class="text-success"></span></h5>
        </div>
         <div class="col-md-12 text-end">
    <h5 class="mb-2">Pending Amount: <span id="pendingamount" class="text-danger"></span></h5>
        </div>
            </div>
           
        
                   <!-- Toggle -->
       <div id="customerFormSection" style="display: none;">
        <h2 class="mb-4">Add New Customer Data</h2>
        <!-- Form -->
        <form action="RecoveryDataInput.php" method="get">
          <div class="row mb-3">
             <div class="col-md-1">
              <label for="Sr.#" class="form-label">Sr.#</label>
              <input type="number" class="form-control" id="sr_single" name="Sr" readonly>
            </div>
            <div class="col-md-4">
              <label for="customerName" class="form-label">Customer Name</label>
              <input type="text" class="form-control" id="customerName" name="customer_name" placeholder="Add Customer Name">
            </div>
            <div class="col-md-2">
              <label for="category" class="form-label">Category</label>
              <select class="form-control" id="category" name="category">
                     <option value="Monthly">Monthly</option>
                     <option value="Yearly">Yearly</option>
                   </select>
              
            </div>
            <div class="col-md-2">
              <label for="sp" class="form-label">Selling Price</label>
              <input type="text" class="form-control" id="sp" name="selling_price" placeholder="in PKR">
            </div>
            <div class="col-md-2">
              <label for="rp" class="form-label">Rent Price</label>
              <input type="text" class="form-control" id="rp" name="rent_price" placeholder="in PKR">
            </div>
            <div class="col-md-3 mt-2">
              <label for="startingMonth" class="form-label">Starting Date</label>
              <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="startingMonth" name="starting_month">
            </div>
             <div class="col-md-2 mt-2">
                   <label for="status" class="form-label">Status</label>
                   <select class="form-control" id="status" name="status">
                     <option value="Pending">Pending</option>
                     <option value="Paid">Paid</option>
                   </select>
                 </div>
          </div>
          <!-- Submit -->
          <button type="submit" class="btn btn-primary col-md-2" name="save">Submit</button>
        </form>
        
        </div>
                       <!-- TABLE -->
                        <table class="mt-3 table table-bordered">
                          <thead>
                          <tr>
                            <th>Sr.#</th>
                            <th>Customer Name</th>
                            <th>Category</th>
                            <th>Selling Price</th>
                            <th>Rent Price</th>
                            <th>Starting Month</th>
                            <th>Status</th>
                          </tr>
                          </thead>

                          <tbody>
                            <?php 
     $select = "SELECT * FROM single_owner";
     $query = mysqli_query($conn,$select);
     while($row =mysqli_fetch_assoc($query)){
     ?>
                            <tr>
                            <td><?php echo $row['Sr'] ;?></td>
                            <td><?php echo $row['customer_name'] ;?></td>
                            <td><?php echo $row['category'] ;?></td>
                            <td class="selling-price"><?php echo $row['selling_price'] ;?></td>
                            <td class="rent-price"><?php echo $row['rent_price'] ;?></td>
                            <td><?php echo date("F j, Y", strtotime($row['starting_month'])); ?></td>
                            <td class="status">
                             <?php 
                               if ($row['status'] == 'Pending') {
                                 echo '<span class="text-danger fw-bold">Pending</span>';
                               } elseif ($row['status'] == 'Paid') {
                                 echo '<span class="text-success fw-bold">Paid</span>';
                               } else {
                                 echo '<span class="text-secondary">' . htmlspecialchars($row['status']) . '</span>';
                               }
                             ?>
                            </td>
                           
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>

                        <!-- Toggle Button -->
<div class="row mt-5">
  <div class="col-md-12 text-start">
    <button id="toggleSearchBtn" class="btn btn-info mb-3">Search</button>
  </div>
</div>

<!-- Search Form and Results -->
<div id="searchSection" style="display: none;">
  <!-- Search Form -->
  <form method="get" action="">
    <div class="row mb-3">
      <div class="col-md-4">
        <label for="searchMonth" class="form-label">Select Month:</label>
        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="search_month" id="searchMonth">
      </div>
      <div class="col-md-2 align-self-end">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </div>
  </form>

  <!-- PHP: Rent Data Table Based on Search -->
<?php
if (isset($_GET['search_month'])) {
  $searchMonth = $_GET['search_month']; // e.g. 2025-08
  echo "<h4 class='mb-3'>Rent to Collect for: " . date("F j, Y", strtotime($searchMonth . "-01")) . "</h4>";

  $query = "SELECT * FROM single_owner WHERE DATE(starting_month) = '$searchMonth'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Customer Name</th>
          <th>Category</th>
          <th>Selling Price</th>
          <th>Rent Price</th>
          <th>Starting Month</th>
          <th>Status</th> <!-- Added Status column -->
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['category'] ;?></td>
            <td class="selling-price"><?php echo $row['selling_price'] ;?></td>
            <td><?php echo $row['rent_price']; ?></td>
            <td><?php echo date("F j, Y", strtotime($row['starting_month'])); ?></td>
            <td>
            <?php 
              if ($row['status'] == 'Pending') {
                echo '<span class="text-danger fw-bold">Pending</span>';
              } elseif ($row['status'] == 'Paid') {
                echo '<span class="text-success fw-bold">Paid</span>';
              } else {
                echo '<span class="text-secondary">' . htmlspecialchars($row['status']) . '</span>';
              }
            ?>
</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
<?php
  } else {
    echo "<p>No rent records found for the selected date.</p>";
  }
}
?>


</div>
</div>
        <!-- END OF SINLE OWNER PAGE -->


        <!-- START OF SHARED OWNER PAGE -->
   <div id="sharedOwnerSection" style="display: none;">
  <div class="row align-items-center">
             <div class="col-md-6 text-start">
                <button id="toggleFormBtn2" class="btn btn-success mb-3">Add New Customer</button>
              </div>
              <div class="col-md-6 text-end">
    <h5 class="mb-3">Total Revenue: <span id="totalrevenue2" class="text-success"></span></h5>
        </div>
        <div class="col-md-12 text-end">
    <h5 class="mb-3">Total Shares: <span id="totalShares" class="text-success"></span></h5>
         </div>
         <div class="col-md-12 text-end">
    <h5 class="mb-2">Pending Amount: <span id="pendingamount2" class="text-danger"></span></h5>
        </div>
            </div>
           
                   <!-- Toggle -->
       <div id="customerFormSection2" style="display: none;">
        <h2 class="mb-4">Add New Customer Data</h2>
        <!-- Form -->
        <form action="RecoveryDataInput2.php" method="get">
          <div class="row mb-3">
             <div class="col-md-1">
              <label for="Sr.#" class="form-label">Sr.#</label>
              <input type="number" class="form-control" id="sr_shared" name="Sr" readonly>
            </div>
            <div class="col-md-4">
              <label for="customerName" class="form-label">Customer Name</label>
              <input type="text" class="form-control" id="customerName" name="customer_name2" placeholder="Add Customer Name">
            </div>
            <div class="col-md-2">
              <label for="category2" class="form-label">Category</label>
              <select class="form-control" id="category2" name="category2">
                     <option value="Monthly">Monthly</option>
                     <option value="Yearly">Yearly</option>
                   </select>
            </div>
            <div class="col-md-2">
              <label for="sp" class="form-label">Selling Price</label>
              <input type="text" class="form-control" id="sp2" name="selling_price2" placeholder="in PKR">
            </div>
            <div class="col-md-2">
              <label for="rp" class="form-label">Rent Price</label>
              <input type="text" class="form-control" id="rp2" name="rent_price2" placeholder="in PKR">
            </div>
            <div class="col-md-3 mt-2">
  <label for="numShareholders" class="form-label">Number of Shareholders</label>
  <input type="number" class="form-control" id="numShareholders"  min="1" value="2">
</div>

<div class="col-md-12 mt-2">
  <div class="row" id="shareholdersContainer"></div>
</div>
<button type="button" class="btn btn-primary col-md-2 mt-3" onclick="addShareholder()">+ Add Shareholder</button>
            <div class="col-md-3 mt-2">
              <label for="startingMonth" class="form-label">Starting Month</label>
              <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="startingMonth2" name="starting_month2">
            </div>
             <div class="col-md-2 mt-2">
                   <label for="status" class="form-label">Status</label>
                   <select class="form-control" id="status2" name="status2">
                     <option value="Pending">Pending</option>
                     <option value="Paid">Paid</option>
                   </select>
                 </div>
          </div>
          <!-- Submit -->
          <button type="submit" class="btn btn-primary col-md-2" name="save">Submit</button>
        </form>
      
        </div>

                       <!-- TABLE -->
                        <table class="mt-3 table table-bordered">
                          <thead>
                            <tr>
                              <th>Sr.#</th>
                              <th>Customer Name</th>
                              <th>Category</th>
                              <th>Selling Price</th>
                              <th>Rent Price</th>
                              <th>Shareholders</th>
                              <th>Starting Month</th>
                              <th>Status</th>
                            </tr>
                            </thead>

                          <tbody>
                            <?php 
     $select = "SELECT * FROM shared_owners";
     $query = mysqli_query($conn,$select);
     while($row =mysqli_fetch_assoc($query)){
     ?>
                            <tr>
                            <td><?php echo $row['Sr'] ;?></td>
                            <td><?php echo $row['customer_name'] ;?></td>
                            <td><?php echo $row['category'] ;?></td>
                            <td class="selling-price"><?php echo $row['selling_price'] ;?></td>
                            <td class="rent-price"><?php echo $row['rent_price'] ;?></td>
                            <td>
<?php
$names = !empty($row['shareholder_names']) ? explode(',', $row['shareholder_names']) : [];
$amounts = !empty($row['shareholder_amounts']) ? explode(',', $row['shareholder_amounts']) : [];

if (!empty($names) && !empty($amounts)) {
    foreach ($names as $index => $name) {
        $amountValue = isset($amounts[$index]) ? $amounts[$index] : 0;
        echo htmlspecialchars(trim($name)) . 
             ' - <span class="shareholder-amount-cell">' . 
             number_format((float)$amountValue) . 
             '</span> PKR<br>';
    }
} else {
    echo "<em>No shareholders</em>";
}
?>
</td>

                            <td><?php echo date("F j, Y", strtotime($row['starting_month'])); ?></td>
                            <td class="status">
                             <?php 
                               if ($row['status'] == 'Pending') {
                                 echo '<span class="text-danger fw-bold">Pending</span>';
                               } elseif ($row['status'] == 'Paid') {
                                 echo '<span class="text-success fw-bold">Paid</span>';
                               } else {
                                 echo '<span class="text-secondary">' . htmlspecialchars($row['status']) . '</span>';
                               }
                             ?>
                            </td>
                           
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>

 <!-- Toggle Button -->
<div class="row mt-5">
  <div class="col-md-12 text-start">
    <button id="toggleSearchBtn2" class="btn btn-info mb-3">Search</button>
  </div>
</div>

<!-- Search Form and Results -->
<div id="searchSection2" style="display: none;">
  <!-- Search Form -->
  <form method="get" action="">
    <div class="row mb-3">
      <div class="col-md-4">
        <label for="searchMonth" class="form-label">Select Month:</label>
        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="search_month" id="searchMonth">
      </div>
      <div class="col-md-2 align-self-end">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </div>
  </form>

  <!-- PHP: Rent Data Table Based on Search -->
<?php
if (isset($_GET['search_month'])) {
  $searchMonth = $_GET['search_month']; // e.g. 2025-08
  echo "<h4 class='mb-3'>Rent to Collect for: " . date("F Y", strtotime($searchMonth . "-01")) . "</h4>";

  $query = "SELECT * FROM shared_owners WHERE DATE(starting_month) = '$searchMonth'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Customer Name</th>
          <th>Category</th>
          <th>Selling Price</th>
          <th>Rent Price</th>
          <th>1st person share</th>
          <th>2nd person share</th>
          <th>Starting Month</th>
          <th>Status</th> <!-- Added Status column -->
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['category'] ;?></td>
            <td class="selling-price"><?php echo $row['selling_price'] ;?></td>
            <td><?php echo $row['rent_price']; ?></td>
            <td class="fps"><?php echo $row['1st_person_share'] ;?></td>
            <td class="sps"><?php echo $row['2nd_person_share'] ;?></td>
            <td><?php echo date("F j, Y", strtotime($row['starting_month'])); ?></td>
            <td>
            <?php 
              if ($row['status'] == 'Pending') {
                echo '<span class="text-danger fw-bold">Pending</span>';
              } elseif ($row['status'] == 'Paid') {
                echo '<span class="text-success fw-bold">Paid</span>';
              } else {
                echo '<span class="text-secondary">' . htmlspecialchars($row['status']) . '</span>';
              }
            ?>
</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
<?php
  } else {
    echo "<p>No rent records found for the selected date.</p>";
  }
}
?>


</div>

</div>

      </div>
    </div>
  </div>

  <?php require_once 'Footer.php'; ?>

  <script>
$(function () {
  // --- Helpers
  const parseMoney = (s) => Number(String(s || '').replace(/,/g, '').trim());
  const formatPKR = (n) => (Number(n) || 0).toLocaleString() + ' PKR';

  // --- Owner type switch
  $('#ownerTypeSelector').on('change', function () {
    const v = $(this).val();
    if (v === 'single') {
      $('#singleOwnerSection').show();
      $('#sharedOwnerSection').hide();
    } else {
      $('#singleOwnerSection').hide();
      $('#sharedOwnerSection').show();
    }
  });

  // --- Toggles
  $('#toggleFormBtn').on('click', () => $('#customerFormSection').slideToggle('slow'));
  $('#toggleSearchBtn').on('click', () => $('#searchSection').slideToggle('slow'));
  $('#toggleFormBtn2').on('click', () => $('#customerFormSection2').slideToggle('slow'));
  $('#toggleSearchBtn2').on('click', () => $('#searchSection2').slideToggle('slow'));

  // --- Auto Sr.#
  function getMaxSrNumber(sectionSelector) {
    let max = 0;
    $(`${sectionSelector} table tbody tr`).each(function () {
      const sr = Number($(this).find('td:first').text().trim());
      if (!isNaN(sr) && sr > max) max = sr;
    });
    return max + 1;
  }
  $('#toggleFormBtn').on('click', () => $('#sr_single').val(getMaxSrNumber('#singleOwnerSection')));
  $('#toggleFormBtn2').on('click', () => $('#sr_shared').val(getMaxSrNumber('#sharedOwnerSection')));

  // --- Dynamic shareholders
  function generateShareholders(count) {
    const container = $('#shareholdersContainer');
    container.empty();
    for (let i = 1; i <= count; i++) {
      container.append(`
        <div class="col-md-6 shareholder-row mb-2">
          <label class="form-label">Shareholder ${i} Name</label>
          <input type="text" class="form-control" name="shareholder_names[]" placeholder="Enter name">
        </div>
        <div class="col-md-6 mb-2">
          <label class="form-label">Shareholder ${i} Amount</label>
          <input type="number" class="form-control shareholder-amount" name="shareholder_amounts[]" placeholder="0">
        </div>
      `);
    }
  }
  // expose optional manual add button if you keep it
  window.addShareholder = function () {
    const i = $('#shareholdersContainer .shareholder-row').length + 1;
    $('#shareholdersContainer').append(`
      <div class="col-md-6 shareholder-row mb-2">
        <label class="form-label">Shareholder ${i} Name</label>
        <input type="text" class="form-control" name="shareholder_names[]" placeholder="Enter name">
      </div>
      <div class="col-md-6 mb-2">
        <label class="form-label">Shareholder ${i} Amount</label>
        <input type="number" class="form-control shareholder-amount" name="shareholder_amounts[]" placeholder="0">
      </div>
    `);
  };

  // init + react to count change
  generateShareholders(parseInt($('#numShareholders').val(), 10) || 1);
  $('#numShareholders').on('input', function () {
    generateShareholders(parseInt($(this).val(), 10) || 1);
  });

  // auto-split for SHARED form
  $('#sp2, #rp2, #numShareholders').on('input', function () {
    const selling = parseMoney($('#sp2').val());
    const rent = parseMoney($('#rp2').val());
    const total = (isNaN(selling) ? 0 : selling) + (isNaN(rent) ? 0 : rent);

    const count = $('#shareholdersContainer .shareholder-row').length || 1;
    const split = Math.round(total / count);
    $('#shareholdersContainer .shareholder-amount').val(split);
  });

  // --- SINGLE totals (scoped to #singleOwnerSection)
  function computeSingleTotals() {
    let totalSelling = 0, totalRent = 0, pending = 0;
    $('#singleOwnerSection table tbody tr').each(function () {
      const selling = parseMoney($(this).find('.selling-price').text());
      if (!isNaN(selling)) totalSelling += selling;

      const rent = parseMoney($(this).find('.rent-price').text());
      const status = $(this).find('.status').text().toLowerCase();
      if (status.includes('paid') && !isNaN(rent)) totalRent += rent;
      if (status.includes('pending') && !isNaN(rent)) pending += rent;
    });
    const revenue = totalSelling + totalRent;
    $('#totalrevenue').text(formatPKR(revenue));
    $('#pendingamount').text(formatPKR(pending));
  }

  // --- SHARED totals (scoped to #sharedOwnerSection)
  function computeSharedTotals() {
    let totalSelling = 0, totalRent = 0, pending = 0, totalShares = 0;
    $('#sharedOwnerSection table tbody tr').each(function () {
      const selling = parseMoney($(this).find('.selling-price').text());
      if (!isNaN(selling)) totalSelling += selling;

      const rent = parseMoney($(this).find('.rent-price').text());
      const status = $(this).find('.status').text().toLowerCase();
      if (status.includes('paid') && !isNaN(rent)) totalRent += rent;
      if (status.includes('pending') && !isNaN(rent)) pending += rent;

      // sum all shareholder amounts in this row
      $(this).find('.shareholder-amount-cell').each(function () {
        const v = parseMoney($(this).text());
        if (!isNaN(v)) totalShares += v;
      });
    });
    const revenue = totalSelling + totalRent;
    $('#totalrevenue2').text(formatPKR(revenue));
    $('#pendingamount2').text(formatPKR(pending));
    $('#totalShares').text(formatPKR(totalShares));
  }

  // compute once on load
  computeSingleTotals();
  computeSharedTotals();
});
</script>


</body>

</html>


