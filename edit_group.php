<?php
$page_title = 'Edit Group';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php
$all_groups = find_all('user_groups', );
$e_group = find_by_id('user_groups', (int) $_GET['id']);
if (!$e_group) {
  $session->msg("d", "Missing Group id.");
  redirect('edit_group.php');
}
?>
<?php
if (isset($_POST['update'])) {

  $requiredFields = array('group-name', 'group-level');
  validate_fields($requiredFields);

  if (empty($errors)) {
    $name = remove_junk($db->escape($_POST['group-name']));
    $level = remove_junk($db->escape($_POST['group-level']));
    $status = remove_junk($db->escape($_POST['status']));

    $query = "UPDATE user_groups SET ";
    $query .= "group_name='{$name}', group_level='{$level}', group_status='{$status}' ";
    $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
    $result = $db->query($query);

    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Group has been successfully updated.");
      redirect('edit_group.php?id=' . (int) $e_group['id'], false);
    } else {
      $session->msg('d', "No changes detected or update failed. Please try again.");
      redirect('edit_group.php?id=' . (int) $e_group['id'], false);
    }
  } else {
    // Displaying the first error from the errors array for simplicity
    $session->msg("d", array_shift($errors));
    redirect('edit_group.php?id=' . (int) $e_group['id'], false);
  }
}
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
    <div class="flex gap-10 justify-between">

      <div class="mt-3  p-4  w-1/2 border rounded-md bg-white">
        <h3 class="text-xl leading-6 font-medium text-black my-2">Edit
          Group</h3>
        <div class="mt-4">

          <form method="post" action="edit_group.php?id=<?php echo (int) $e_group['id']; ?>">
            <div class="mb-4">
              <label for="group-name" class="block text-gray-700 font-semibold mb-2">Group
                Name</label>
              <input type="text" id="group-name" name="group-name"
                class="w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none"
                value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>">
            </div>
            <div class="mb-4">
              <label for="group-level" class="block text-gray-700 font-semibold mb-2">Group
                Level</label>
              <input type="number" id="group-level" name="group-level"
                class="w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none" min="1"
                value="<?php echo (int) $e_group['group_level']; ?>">
            </div>
            <div class="mb-6">
              <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
              <select id="status" name="status" class="w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700" required>
                <option <?php if ($e_group['group_status'] === '1')
                  echo 'selected="selected"'; ?> value="1"> Active
                </option>
                <option <?php if ($e_group['group_status'] === '0')
                  echo 'selected="selected"'; ?> value="0">Deactive
                </option>
              </select>
            </div>
            <div class="flex justify-end ">
              <button type="submit" name="update"
                class="py-2 px-4 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300">Update</button>
            </div>
          </form>
        </div>
      </div>
      <table class="w-1/2 divide-y divide-gray-200 mr-6 mt-4 border rounded-md">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Group Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Group Level</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Status</th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php foreach ($all_groups as $a_group): ?>
            <tr>
              <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                <?php echo count_id(); ?>
              </td>
              <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
                <?php echo remove_junk(ucwords($a_group['group_name'])) ?>
              </td>
              <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
                <?php echo remove_junk(ucwords($a_group['group_level'])) ?>
              </td>
              <td class="px-6 py-2 whitespace-nowrap">
                <?php if ($a_group['group_status'] === '1'): ?>
                  <span
                    class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                <?php else: ?>
                  <span
                    class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Inactive</span>
                <?php endif; ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                <div class="flex justify-center items-center space-x-2">
                  <a href="edit_group.php?id=<?php echo (int) $a_group['id']; ?>"
                    class="text-blue-500 hover:text-blue-700" type=button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                  </a>
                  <a href="delete_group.php?id=<?php echo (int) $a_group['id']; ?>"
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
</body>

</html>

<?php include_once ('layout/footer.php'); ?>