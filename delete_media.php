<?php
require_once ('includes/load.php');
// Checking the user's permission level for this page
page_require_level(2);
?>
<?php
$find_media = find_by_id('media', (int) $_GET['id']);
$photo = new Media();
if ($photo->media_destroy($find_media['id'], $find_media['file_name'])) {
  $session->msg("s", "Photo has been successfully deleted.");
  redirect('media.php');
} else {
  $session->msg("d", "Failed to delete photo or missing parameters.");
  redirect('media.php');
}
?>