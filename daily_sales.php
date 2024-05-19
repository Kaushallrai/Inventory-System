<?php
$page_title = 'Daily Sales';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);

// Get today's date
$today_date = date('Y-m-d');

// Fetch daily sales for today
$sales = dailySalesForDate($today_date);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100" style="height: 100vh; overflow-y: auto;">

  <div class="relative">
    <div class="ml-60 fixed z-50 right-0 left-0 top-0"><?php include_once ('layout/header.php'); ?></div>
    <div class="fixed top-0"><?php include_once ('layout/sidebar.php'); ?></div>
  </div>

  <div class="ml-64 mt-20">
    <div class="w-full">
      <?php echo display_msg($msg); ?>
    </div>
    <div class="container mx-auto px-4">
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-500 py-4 px-6 flex items-center justify-between">
          <h2 class="text-white font-semibold text-xl">Daily Sales</h2>
        </div>
        <div class="p-6 rounded-md">
          <table class="w-full table-auto border">
            <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-center" style="width: 50px;">#</th>
                <th class="py-3 px-6 text-left">Product name</th>
                <th class="py-3 px-6 text-center" style="width: 15%;">Quantity sold</th>
                <th class="py-3 px-6 text-center" style="width: 15%;">Total</th>
                <th class="py-3 px-6 text-center" style="width: 15%;">Date</th>
              </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light border">
              <?php foreach ($sales as $index => $sale): ?>
                <tr class="border border-gray-200 hover:bg-gray-100 font-medium">
                  <td class="py-3 px-6 text-center border"><?php echo $index + 1; ?></td>
                  <td class="py-3 px-6 border"><?php echo isset($sale['name']) ? remove_junk($sale['name']) : ''; ?></td>
                  <td class="py-3 px-6 text-center border"><?php echo isset($sale['qty']) ? (int) $sale['qty'] : ''; ?>
                  </td>
                  <td class="py-3 px-6 text-center border">
                    <?php echo isset($sale['total_saleing_price']) ? remove_junk($sale['total_saleing_price']) : ''; ?>
                  </td>
                  <td class="py-3 px-6 text-center border"><?php echo isset($sale['date']) ? $sale['date'] : ''; ?></td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>