<?php
require_once ('includes/load.php');
// Checking the user's permission level to view this page
page_require_level(3);
?>
<?php
$d_sale = find_by_id('sales', (int) $_GET['id']);
if (!$d_sale) {
  $session->msg("d", "The sale ID is missing.");
  redirect('sales.php');
}
?>
<?php
$delete_id = delete_by_id('sales', (int) $d_sale['id']);
if ($delete_id) {
  $session->msg("s", "The sale has been successfully deleted.");
  redirect('sales.php');
} else {
  $session->msg("d", "Failed to delete the sale.");
  redirect('sales.php');
}
?>