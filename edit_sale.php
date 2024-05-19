<?php
$page_title = 'Edit sale';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);

$sale = find_by_id('sales', (int) $_GET['id']);
if (!$sale) {
  $session->msg("d", "Missing product id.");
  redirect('sales.php');
}

$product = find_by_id('products', $sale['product_id']);

if (isset($_POST['update_sale'])) {
  $req_fields = array('title', 'quantity', 'price', 'total', 'date');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_id = $db->escape((int) $product['id']);
    $s_qty = $db->escape((int) $_POST['quantity']);
    $s_total = $db->escape($_POST['total']);
    $date = $db->escape($_POST['date']);
    $s_date = date("Y-m-d", strtotime($date));

    $sql = "UPDATE sales SET";
    $sql .= " product_id= '{$p_id}',qty={$s_qty},price='{$s_total}',date='{$s_date}'";
    $sql .= " WHERE id ='{$sale['id']}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      update_product_qty($s_qty, $p_id);
      $session->msg('s', "Sale updated.");
      redirect('edit_sale.php?id=' . $sale['id'], false);
    } else {
      $session->msg('d', ' Sorry failed to updated!');
      redirect('sales.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_sale.php?id=' . (int) $sale['id'], false);
  }
}
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
    <div class="bg-white overflow-hidden shadow-md rounded-lg mr-4">
      <div class="px-6 py-4 border-b flex items-center justify-between">
        <strong class="text-gray-700 font-bold">All Sales</strong>
        <a href="sales.php"
          class=" bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Show all sales
        </a>
      </div>
      <div class="p-6">
        <table class="w-full table-auto">
          <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
              <th class="py-3 px-6 text-left">Product title</th>
              <th class="py-3 px-6 text-left">Qty</th>
              <th class="py-3 px-6 text-left">Price</th>
              <th class="py-3 px-6 text-left">Total</th>
              <th class="py-3 px-6 text-left">Date</th>
              <th class="py-3 px-6 text-left">Action</th>
            </tr>
          </thead>
          <tbody id="product_info" class="text-gray-600 text-sm font-light">
            <tr class="border-b border-gray-200 ">
              <form method="post" action="edit_sale.php?id=<?php echo (int) $sale['id']; ?>">
                <td id="s_name" class="py-3 px-6">
                  <input type="text" class="form-input w-full  outline-none " id="sug_input" name="title"
                    value="<?php echo remove_junk($product['name']); ?>">
                  <div id="result" class="list-group"></div>
                </td>
                <td id="s_qty" class="py-3 px-6">
                  <input type="text" class="form-input w-full outline-none" name="quantity"
                    value="<?php echo (int) $sale['qty']; ?>">
                </td>
                <td id="s_price" class="py-3 px-6">
                  <input type="text" class="form-input w-full outline-none" name="price"
                    value="<?php echo remove_junk($product['sale_price']); ?>">
                </td>
                <td class="py-3 px-6">
                  <input type="text" class="form-input w-full  outline-none" name="total"
                    value="<?php echo remove_junk($sale['price']); ?>">
                </td>
                <td id="s_date" class="py-3 px-6">
                  <input type="date" class="form-input w-full  outline-none" name="date" data-date-format=""
                    value="<?php echo remove_junk($sale['date']); ?>">
                </td>
                <td class="py-3 px-6">
                  <button type="submit" name="update_sale"
                    class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update
                    sale</button>
                </td>
              </form>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script>

    </script>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>