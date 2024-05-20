m
<?php
$page_title = 'Edit Account';
require_once ('includes/load.php');
page_require_level(3);
?>
<?php
//update user image
if (isset($_POST['submit'])) {
  $photo = new Media();
  $user_id = (int) $_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if ($photo->process_user($user_id)) {
    $session->msg('s', 'photo has been uploaded.');
    redirect('edit_account.php');
  } else {
    $session->msg('d', join($photo->errors));
    redirect('edit_account.php');
  }
}
?>
<?php
//update user other info
// Update user information
if (isset($_POST['update'])) {
  $required_fields = array('name', 'username');
  validate_fields($required_fields);
  if (empty($errors)) {
    $id = (int) $_SESSION['user_id'];
    $name = remove_junk($db->escape($_POST['name']));
    $username = remove_junk($db->escape($_POST['username']));
    $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Account information updated successfully.");
      redirect('edit_account.php', false);
    } else {
      $session->msg('d', 'Sorry, failed to update account information.');
      redirect('edit_account.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_account.php', false);
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
  <div class="  ml-64 mt-20 ">
    <?php echo display_msg($msg); ?>
    <div class="flex gap-4 ">
      <div class="w-2/5 border flex">
        <div class=" bg-white rounded-lg shadow-sm overflow-hidden w-full">
          <div class="bg-gray-500 text-white py-3 px-4 flex items-center">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
            </svg>
            <span class="font-semibold">Change My Photo</span>
          </div>
          <div class="p-4">
            <div class="flex">
              <div class="w-1/3 mr-4">
                <div class="bg-gray-500 rounded h-full"> <img class=" "
                    src="uploads/users/<?php echo $user['image']; ?>" alt=""></div>

              </div>
              <div class="w-2/3">
                <form class="form" action="edit_account.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-4">
                    <label class="block mb-2 font-semibold text-gray-700">Upload Photo</label>
                    <input type="file" name="file_upload" multiple="multiple"
                      class="border border-gray-400 rounded-md py-2 px-3 w-full">
                  </div>
                  <div>
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <button type="submit" name="submit"
                      class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg">Change</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-3/5 mr-4 border">
        <div class="bg-white rounded-lg shadow-sm  overflow-hidden">
          <div class="bg-gray-500 text-white py-3 px-4 flex items-center">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <span class="font-semibold">Edit My Account</span>
          </div>
          <div class="p-4">
            <form method="post" action="edit_account.php?id=<?php echo (int) $user['id']; ?>">
              <div class="mb-4">
                <label for="name" class="block font-semibold text-gray-700">Name</label>
                <input type="name" class="border border-gray-400 rounded-md py-2 px-3 w-full" name="name"
                  value="<?php echo remove_junk(ucwords($user['name'])); ?>">
              </div>
              <div class="mb-4">
                <label for="username" class="block font-semibold text-gray-700">Username</label>
                <input type="text" class="border border-gray-400 rounded-md py-2 px-3 w-full" name="username"
                  value="<?php echo remove_junk(ucwords($user['username'])); ?>">
              </div>
              <div class="flex items-center">
                <a href="change_password.php"
                  class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg mr-2">Change
                  Password</a>
                <button type="submit" name="update"
                  class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>