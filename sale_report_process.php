<?php
$page_title = 'Sales Report';
$results = '';
require_once ('includes/load.php');
page_require_level(3);
?>
<?php
if (isset($_POST['submit'])) {
  $req_dates = array('start-date', 'end-date');
  validate_fields($req_dates);

  if (empty($errors)) {
    $start_date = remove_junk($db->escape($_POST['start-date']));
    $end_date = remove_junk($db->escape($_POST['end-date']));

    if ($start_date > $end_date) {
      $session->msg("d", "To date cannot be greater than from date.");
      redirect('sales_report.php', false);
    }

    $results = find_sale_by_dates($start_date, $end_date);
  } else {
    $session->msg("d", $errors);
    redirect('sales_report.php', false);
  }
} else {
  $session->msg("d", "Select dates");
  redirect('sales_report.php', false);
}
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <style>
    @media print {

      html,
      body {
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
      }

      .page-break {
        page-break-before: always;
        width: auto;
        margin: auto;
      }

      .page-break,
      .sale-head,
      table th,
      table td {
        border: 1px solid #212121;
        white-space: nowrap;
      }

      .sale-head,
      table th,
      table tfoot td {
        background-color: #bcb9b9;
      }

      tfoot {
        color: #000;
        text-transform: uppercase;
        font-weight: 500;
      }
    }
  </style>
</head>

<body class="bg-gray-100 p-8">
  <?php if ($results): ?>
    <div class="page-break bg-white shadow-md rounded-lg p-6">
      <div class="sale-head text-center mb-6">
        <h1 class="text-2xl font-bold mb-2">Inventory Management System - Sales Report</h1>
        <strong class="text-lg">
          <?php if (isset($start_date)) {
            echo $start_date;
          } ?> to
          <?php if (isset($end_date)) {
            echo $end_date;
          } ?>
        </strong>
      </div>
      <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
          <tr>
            <th class="border px-4 py-2">Date</th>
            <th class="border px-4 py-2">Product Name</th>
            <th class="border px-4 py-2">Buying Price</th>
            <th class="border px-4 py-2">Selling Price</th>
            <th class="border px-4 py-2">Total Qty</th>
            <th class="border px-4 py-2">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($results as $result): ?>
            <tr>
              <td class="border px-4 py-2 text-center"><?php echo remove_junk($result['date']); ?></td>
              <td class="border px-4 py-2"><?php echo remove_junk(ucfirst($result['name'])); ?></td>
              <td class="border px-4 py-2 text-right"><?php echo remove_junk($result['buy_price']); ?></td>
              <td class="border px-4 py-2 text-right"><?php echo remove_junk($result['sale_price']); ?></td>
              <td class="border px-4 py-2 text-right"><?php echo remove_junk($result['total_sales']); ?></td>
              <td class="border px-4 py-2 text-right"><?php echo remove_junk($result['total_saleing_price']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr class="text-right">
            <td colspan="4" class="border px-4 py-2"></td>
            <td class="border px-4 py-2 font-semibold">Grand Total</td>
            <td class="border px-4 py-2">$
              <?php echo number_format(total_price($results)[0], 2); ?>
            </td>
          </tr>
          <tr class="text-right">
            <td colspan="4" class="border px-4 py-2"></td>
            <td class="border px-4 py-2 font-semibold">Profit</td>
            <td class="border px-4 py-2">$
              <?php echo number_format(total_price($results)[1], 2); ?>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="text-center mt-6">
      <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="window.print();">Print
        Report</button>
    </div>
  <?php else: ?>
    <div class="text-center">
      <p class="text-red-500">Sorry, no sales have been found.</p>
    </div>
  <?php endif; ?>
</body>

</html>
<?php if (isset($db)) {
  $db->db_disconnect();
} ?>