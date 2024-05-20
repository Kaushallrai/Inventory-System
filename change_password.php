<?php
$page_title = 'Change Password';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>
<?php $user = current_user(); ?>
<?php
if (isset($_POST['update'])) {
  $req_fields = array('new-password', 'old-password', 'id');
  validate_fields($req_fields);

  if (empty($errors)) {
    if (sha1($_POST['old-password']) !== current_user()['password']) {
      $session->msg('d', "Your old password does not match");
      redirect('change_password.php', false);
    }

    $id = (int) $_POST['id'];
    $new = remove_junk($db->escape(sha1($_POST['new-password'])));
    $sql = "UPDATE users SET password ='{$new}' WHERE id='{$db->escape($id)}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      // Log out the user and redirect them to the login page
      $session->logout();
      $session->msg('s', "Login with your new password.");
      redirect('index.php', false); // Ensure the user is directed to the login page
    } else {
      $session->msg('d', 'Sorry, failed to update!');
      redirect('change_password.php', false);
    }
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
    <div class="ml-60 fixed z-50 right-0 left-0 top-0">
      <?php include_once ('layout/header.php'); ?>
    </div>
    <div class="fixed top-0"><?php if ($user['user_level'] === '1'): ?>
        <!-- admin menu -->
        <?php include_once ('layout/sidebar.php'); ?>

      <?php elseif ($user['user_level'] === '2'): ?>
        <!-- Special user -->
        <?php include_once ('layout/sidebar(2).php'); ?>

      <?php elseif ($user['user_level'] === '3'): ?>
        <!-- User menu -->
        <?php include_once ('layout/sidebar(3).php'); ?>

      <?php endif; ?>

    </div>
  </div>
  <div class="ml-64 mt-20">
    <div class="w-full">
      <?php echo display_msg($msg); ?>
    </div>
    <form method="post" action="change_password.php" class="space-y-4">
      <div class="form-group">
        <label for="newPassword" class="block text-gray-700">New password</label>
        <input type="password"
          class="block w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          name="new-password" placeholder="New password">
      </div>
      <div class="form-group">
        <label for="oldPassword" class="block text-gray-700">Old password</label>
        <input type="password"
          class="block w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          name="old-password" placeholder="Old password">
      </div>
      <div class="form-group">
        <input type="hidden" name="id" value="<?php echo (int) $user['id']; ?>">
        <button type="submit" name="update"
          class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Change</button>
      </div>
    </form>
  </div>
  <?php include_once ('layout/footer.php'); ?>
</body>

</html>