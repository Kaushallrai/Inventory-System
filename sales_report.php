<?php
$page_title = 'Sale Report';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
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
    <div class="ml-60 fixed z-50 right-0
        left-0 top-0
        
        "><?php include_once ('layout/header.php'); ?>
    </div>
    <div class="fixed top-0"><?php include_once ('layout/sidebar.php'); ?>
    </div>


  </div>
  <div class="  ml-64 mt-20 ">
    <div class="w-full">
      <?php echo display_msg($msg); ?>
    </div>
    <div class="flex flex-col md:flex-row gap-4 w-2/3 rounded-md shadow-md">
      <div class="flex-1">
        <div class="bg-white p-4">
          <form class="flex flex-col gap-4" method="post" action="sale_report_process.php">
            <div>
              <label class="text-gray-700  font-medium">Date Range</label>
              <hr class="my-2">
              <div class="flex gap-6">
                <input type="date" class="form-control w-full" name="start-date" placeholder="From">
                <span class="flex items-center justify-center w-8 h-8 border border-gray-300 p-4 rounded-md">
                  <i class="text-gray-600 fas fa-arrow-right"></i>
                </span>
                <input type="date" class="form-control w-full" name="end-date" placeholder="To">
              </div>
            </div>
            <button type="submit" name="submit"
              class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 my-2 rounded">
              Generate Report
            </button>
          </form>
        </div>
      </div>
    </div>

  </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>