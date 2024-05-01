<?php
$page_title = 'Add User';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
$groups = find_all('user_groups');
?>
<?php
if (isset($_POST['add_user'])) {

  $req_fields = array('full-name', 'username', 'password', 'level');
  validate_fields($req_fields);

  if (empty($errors)) {
    $name = remove_junk($db->escape($_POST['full-name']));
    $username = remove_junk($db->escape($_POST['username']));
    $password = remove_junk($db->escape($_POST['password']));
    $user_level = (int) $db->escape($_POST['level']);
    $password = sha1($password);
    $query = "INSERT INTO users (";
    $query .= "name,username,password,user_level,status";
    $query .= ") VALUES (";
    $query .= " '{$name}', '{$username}', '{$password}', '{$user_level}','1'";
    $query .= ")";
    if ($db->query($query)) {
      // Success
      $session->msg('s', "User account has been successfully created.");
      redirect('manage_users.php', false);
    } else {
      // Failed
      $session->msg('d', 'Sorry, failed to create the user account.');
      redirect('manage_users.php', false);
    }
  } else {
    $session->msg("d", "Please fill in all required fields.");
    redirect('manage_users.php', false);
  }
}

?>

<?php include_once ('layouts/footer.php'); ?>