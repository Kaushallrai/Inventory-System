<?php
require_once ('includes/load.php');
// Checking the user's permission level for this page
page_require_level(2);
?>
<?php
$product = find_by_id('products', (int) $_GET['id']);
if (!$product) {
  $session->msg("d", "Missing product ID.");
  redirect('product.php');
}
?>
<?php
$delete_id = delete_by_id('products', (int) $product['id']);
if ($delete_id) {
  $session->msg("s", "Product has been successfully deleted.");
  redirect('product.php');
} else {
  $session->msg("d", "Failed to delete product.");
  redirect('product.php');
}
?>