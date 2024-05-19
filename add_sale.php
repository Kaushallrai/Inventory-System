<?php
$page_title = 'Add Sale';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>
<?php

if (isset($_POST['add_sale'])) {
  $req_fields = array('s_id', 'quantity', 'price', 'total', 'date');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_id = $db->escape((int) $_POST['s_id']);
    $s_qty = $db->escape((int) $_POST['quantity']);
    $s_total = $db->escape($_POST['total']);
    $date = $db->escape($_POST['date']);
    $s_date = date("Y-m-d", strtotime($date));

    $sql = "INSERT INTO sales (";
    $sql .= " product_id,qty,price,date";
    $sql .= ") VALUES (";
    $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}'";
    $sql .= ")";

    if ($db->query($sql)) {
      update_product_qty($s_qty, $p_id);
      $session->msg('s', "The sale has been successfully added.");
      redirect('add_sale.php', false);
    } else {
      $session->msg('d', 'Apologies, the sale could not be added due to an unexpected error.');
      redirect('add_sale.php', false);
    }
  } else {
    $session->msg("d", "Sorry, the following errors occurred: $errors");
    redirect('add_sale.php', false);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Sales</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen overflow-y-auto">

  <div class="relative">
    <div class="ml-60 fixed z-50 right-0 left-0 top-0">
      <?php include_once ('layout/header.php'); ?>
    </div>
    <div class="fixed top-0">
      <?php include_once ('layout/sidebar.php'); ?>
    </div>
  </div>

  <div class="ml-64 mt-20">
    <div class="w-full">
      <?php echo display_msg($msg); ?>
    </div>
    <div class="flex flex-col md:flex-row">
      <div class="md:w-1/2">
        <form method="post" action="ajax.php" autocomplete="off" id="sug-form" class="flex flex-col">
          <div class="flex items-center form-group">
            <button type="submit"
              class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md mr-2">
              <i class="fas fa-search"></i> Find It
            </button>
            <input type="text" id="sug_input"
              class="border border-gray-400 rounded-md py-2 px-3 form-control outline-none w-2/3" name="title"
              placeholder="Search for product name">
          </div>
          <div id="result" class="list-group mt-2"></div>
        </form>
      </div>
    </div>

    <div class="flex flex-col md:flex-row mr-4">
      <div class="w-full md:w-full">
        <div class="bg-white shadow-md rounded-lg">
          <div class="px-6 py-4 border-b">
            <span class="flex items-center">
              <i class="fas fa-edit"></i>
              <span class="text-gray-700 font-semibold text-xl">Sale Edit</span>
            </span>
          </div>
          <div class="p-6">
            <form method="post" action="add_sale.php?">
              <table class="w-full table-auto  ">
                <thead>
                  <tr>
                    <th class="px-4 py-2 border">Item</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border-b">Action</th>
                  </tr>
                </thead>
                <tbody id="product_info"></tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      $('#sug-form').on('submit', function (e) {
        e.preventDefault();
        var product_name = $('#sug_input').val();
        $.ajax({
          type: 'POST',
          url: 'ajax.php',
          data: {
            product_name: product_name
          },
          success: function (response) {
            var data = JSON.parse(response);
            $('#result').html('<ul class="list-none">' + data.suggestions + '</ul>');
          }
        });
      });

      $('#sug_input').on('keyup', function () {
        var product_name = $(this).val();
        if (product_name.length > 0) {
          $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: {
              product_name: product_name
            },
            success: function (response) {
              var data = JSON.parse(response);
              $('#result').html('<ul class="list-none">' + data.suggestions + '</ul>');
            }
          });
        } else {
          $('#result').html('');
        }
      });
    });

    function fillInput(value) {
      $('#sug_input').val(value);
      $('#result').html('');
      $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: {
          p_name: value
        },
        success: function (response) {
          var data = JSON.parse(response);
          $('#product_info').html(data.table);
        }
      });
    }
  </script>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>