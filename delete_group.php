<?php
require_once ('includes/load.php');
// Checking the user's permission level for this page
page_require_level(1);
?>
<?php
$delete_id = delete_by_id('user_groups', (int) $_GET['id']);
if ($delete_id) {
  $session->msg("s", "The group has been successfully deleted.");
  redirect('manage_groups.php');
} else {
  $session->msg("d", "Failed to delete the group or missing parameters.");
  redirect('manage_groups.php');
}
?>