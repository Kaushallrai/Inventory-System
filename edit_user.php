<?php
$page_title = 'Edit User';
require_once ('includes/load.php');
// Checking the user's permission level to view this page
page_require_level(1);
?>
<?php
$all_users = find_all_user();
$e_user = find_by_id('users', (int) $_GET['id']);
$groups = find_all('user_groups');
if (!$e_user) {
  $session->msg("d", "User ID missing.");
  redirect('users.php');
}
?>

<?php
// Updating user basic information
if (isset($_POST['update'])) {
  $required_fields = array('name', 'username', 'level');
  validate_fields($required_fields);
  if (empty($errors)) {
    $id = (int) $e_user['id'];
    $name = remove_junk($db->escape($_POST['name']));
    $username = remove_junk($db->escape($_POST['username']));
    $level = (int) $db->escape($_POST['level']);
    $status = remove_junk($db->escape($_POST['status']));
    $sql = "UPDATE users SET name ='{$name}', username ='{$username}', user_level='{$level}', status='{$status}' WHERE id='{$db->escape($id)}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "User account updated successfully.");
      redirect('edit_user.php?id=' . (int) $e_user['id'], false);
    } else {
      $session->msg('d', 'Failed to update user account.');
      redirect('edit_user.php?id=' . (int) $e_user['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id=' . (int) $e_user['id'], false);
  }
}
?>
<?php
// Updating user password
if (isset($_POST['update-pass'])) {
  $required_fields = array('password');
  validate_fields($required_fields);
  if (empty($errors)) {
    $id = (int) $e_user['id'];
    $password = remove_junk($db->escape($_POST['password']));
    $hashed_password = sha1($password);
    $sql = "UPDATE users SET password='{$hashed_password}' WHERE id='{$db->escape($id)}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "User password updated successfully.");
      redirect('edit_user.php?id=' . (int) $e_user['id'], false);
    } else {
      $session->msg('d', 'Failed to update user password.');
      redirect('edit_user.php?id=' . (int) $e_user['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id=' . (int) $e_user['id'], false);
  }
}
?>


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users</title>
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
    <?php echo display_msg($msg); ?>
    <div class="flex justify-between gap-6">
      <div class="bg-white p-5 rounded-lg shadow-sm w-2/5 border">
        <h3 class="text-2xl text-gray-700 font-semibold">Edit <?php echo remove_junk(ucwords($e_user['name'])); ?>'s
          Account</h3>

        <form method="post" action="edit_user.php?id=<?php echo (int) $e_user['id']; ?>">
          <div class="mt-5">
            <label for="name" class="text-sm text-gray-600 ">Name</label>
            <input type="text" class=" mt-1 w-full px-2 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none"
              name="name" value="<?php echo remove_junk($e_user['name']); ?>">
          </div>
          <div class="mt-5">
            <label for="username" class="text-sm text-gray-600">Username</label>
            <input type="text" class="mt-1 w-full px-2 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none"
              name="username" value="<?php echo remove_junk($e_user['username']); ?>">
          </div>
          <div class="mt-5">
            <label for="level" class="text-sm text-gray-600">User Role</label>
            <select class=" mt-1 w-full px-2 py-2 rounded-lg bg-gray-200 text-gray-700" name="level">
              <?php foreach ($groups as $group): ?>
                <option <?php if ($group['group_level'] === $e_user['user_level'])
                  echo 'selected="selected"'; ?>
                  value="<?php echo $group['group_level']; ?>"><?php echo ucwords($group['group_name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mt-5">
            <label for="status" class="text-sm text-gray-600">Status</label>
            <select class=" mt-1 w-full px-2 py-2 rounded-lg bg-gray-200 text-gray-700" name="status">
              <option <?php if ($e_user['status'] === '1')
                echo 'selected="selected"'; ?> value="1">Active</option>
              <option <?php if ($e_user['status'] === '0')
                echo 'selected="selected"'; ?> value="0">Deactive</option>
            </select>
          </div>
          <div class="mt-5 right-0">
            <button type="submit" name="update" class="bg-blue-500 text-white p-2 px-4 rounded-md ">Update</button>
          </div>
        </form>
      </div>
      <div class="flex flex-col w-2/3 mr-4 gap-4">
        <div class="bg-white p-5 rounded-lg shadow-sm  w-full border">
          <h3 class="text-2xl text-gray-700 font-semibold"> Change
            <?php echo remove_junk(ucwords($e_user['name'])); ?>'s
            password
          </h3>
          <form method="post" action="edit_user.php?id=<?php echo (int) $e_user['id']; ?>">
            <div class="mt-5">
              <label for="password" class="text-sm text-gray-600">Password</label>
              <input type="password"
                class=" mt-1 w-full px-2 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none" name="password">
            </div>
            <div class="mt-5">
              <button type="submit" name="update-pass"
                class="bg-blue-500 text-white p-2 rounded-md px-4 ">Update</button>
            </div>
          </form>

        </div>
        <div>
          <table class="min-w-full divide-y divide-gray-200 border">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  #
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Username</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  User Role</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Last Login</th>
                <th scope="col"
                  class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php foreach ($all_users as $a_user): ?>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <?php echo count_id(); ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?php echo remove_junk(ucwords($a_user['name'])) ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?php echo remove_junk(ucwords($a_user['username'])) ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?php echo remove_junk(ucwords($a_user['group_name'])) ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <?php if ($a_user['status'] === '1'): ?>
                      <span
                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                    <?php else: ?>
                      <span
                        class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Inactive</span>
                    <?php endif; ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <?php echo read_date($a_user['last_login']) ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                    <div class="flex justify-center items-center space-x-2">
                      <a href="edit_user.php?id=<?php echo (int) $a_user['id']; ?>"
                        class="text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                      </a>
                      <a href="delete_user.php?id=<?php echo (int) $a_user['id']; ?>"
                        class="text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                        </svg>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>