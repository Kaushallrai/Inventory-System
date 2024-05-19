<?php
require_once ('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
  redirect('index.php', false);
}

// Auto suggestion
$html = '';
if (isset($_POST['product_name']) && strlen($_POST['product_name'])) {
  $products = find_product_by_title($_POST['product_name']);
  if ($products) {
    foreach ($products as $product) {
      $html .= "<li class='px-4 py-2 bg-white hover:bg-gray-200 cursor-pointer ml-24 mb-4 rouned-md shadow-sm' onclick='fillInput(\"" . remove_junk($product['name']) . "\")'>" . $product['name'] . "</li>";
    }
  } else {
    $html = '<li class="px-4 py-2 bg-white">Not found</li>';
  }
  echo json_encode(['suggestions' => $html]);
}

// Find all product info by title
if (isset($_POST['p_name']) && strlen($_POST['p_name'])) {
  $product_title = remove_junk($db->escape($_POST['p_name']));
  if ($results = find_all_product_info_by_title($product_title)) {
    foreach ($results as $result) {
      $html .= "<tr class='border'>";
      $html .= "<td class='border p-4 text-center' id='s_name'>" . $result['name'] . "</td>";
      $html .= "<input type='hidden' name='s_id' value='{$result['id']}'>";
      $html .= "<td class='border text-center'>";
      $html .= "<input type='text' class='form-control outline-none  text-center' name='price' value='{$result['sale_price']}'>";
      $html .= "</td>";
      $html .= "<td class='border text-center' id='s_qty'>";
      $html .= "<input type='text' class='form-control outline-none  text-center' name='quantity' value='1'>";
      $html .= "</td>";
      $html .= "<td class='border text-center'>";
      $html .= "<input type='text' class='form-control outline-none  text-center' name='total' value='{$result['sale_price']}'>";
      $html .= "</td>";
      $html .= "<td class='border text-center'>";
      $html .= "<input type='date' class='form-control outline-none datePicker' name='date' data-date data-date-format='yyyy-mm-dd '>";
      $html .= "</td>";
      $html .= "<td class='border text-center'>";
      $html .= "<button type='submit' name='add_sale' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Add sale</button>";
      $html .= "</td>";
      $html .= "</tr>";
    }
    echo json_encode(['table' => $html]);
  } else {
    echo json_encode(['table' => '<tr><td>Product name not registered in the database</td></tr>']);
  }
}
?>