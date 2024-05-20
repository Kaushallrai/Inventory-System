<?php
require_once ('includes/load.php');
// Checking the user's permission level for this page
page_require_level(2);
?>
<?php
$categorie = find_by_id('categories', (int) $_GET['id']);
if (!$categorie) {
  $session->msg("d", "Missing category ID.");
  redirect('categorie.php');
}
?>
<?php
$delete_id = delete_by_id('categories', (int) $categorie['id']);
if ($delete_id) {
  $session->msg("s", "Category deleted successfully.");
  redirect('categorie.php');
} else {
  $session->msg("d", "Failed to delete the category.");
  redirect('categorie.php');
}
?>