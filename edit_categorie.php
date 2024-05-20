<?php
$page_title = 'Edit categorie';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
?>
<?php

//Display all catgories.
$categorie = find_by_id('categories', (int) $_GET['id']);
if (!$categorie) {
  $session->msg("d", "Missing categorie id.");
  redirect('categorie.php');
}
$all_categories = find_all('categories')
  ?>

<?php
if (isset($_POST['edit_cat'])) {
  $required_field = array('categorie-name');
  validate_fields($required_field);
  $cat_name = remove_junk($db->escape($_POST['categorie-name']));
  if (empty($errors)) {
    $sql = "UPDATE categories SET name='{$cat_name}'";
    $sql .= " WHERE id='{$categorie['id']}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      $session->msg("s", "Category successfully updated.");
      redirect('categorie.php', false);
    } else {
      $session->msg("d", "Sorry, failed to update category.");
      redirect('categorie.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('categorie.php', false);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categories</title>
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
    <div class="grid grid-cols-1">

      <?php echo display_msg($msg); ?>

    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <div class="bg-white shadow-md rounded-md p-4">
          <div class="flex items-center mb-4">
            <span class="text-xl mr-2"><i class="fas fa-th"></i></span>
            <span class="font-bold">Editing <?php echo remove_junk(ucfirst($categorie['name'])); ?></span>
          </div>
          <form method="post" action="edit_categorie.php?id=<?php echo (int) $categorie['id']; ?>">
            <div class="mb-4">
              <input type="text"
                class="text-base w-full border-2  rounded-xl p-3 mt-1 bg-transparent outline-none bg-gray-200"
                name="categorie-name" placeholder="Category Name"
                value="<?php echo remove_junk(ucfirst($categorie['name'])); ?>">
            </div>
            <button type="submit" name="edit_cat"
              class="bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 text-white py-2 px-4 rounded-md">Update
              Category</button>
          </form>
        </div>
      </div>
      <div>
        <div class="bg-white shadow-md rounded-md p-4">
          <div class="flex items-center mb-4 ">
            <span class="text-xl mr-2"><i class="fas fa-th"></i></span>
            <span class="font-bold">All Categories</span>
          </div>
          <div class="overflow-x-auto">
            <table class="table-auto w-full border border-collapse border-gray-200">
              <thead>
                <tr>
                  <th class="text-center border border-gray-200 p-2" style="width: 50px;">#</th>
                  <th class="border border-gray-200 p-2">Categories</th>
                  <th class="text-center border border-gray-200 p-2" style="width: 100px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($all_categories as $cat): ?>
                  <tr>
                    <td class="text-center border border-gray-200 p-2"><?php echo count_id(); ?></td>
                    <td class="pl-5 border border-gray-200 p-2"><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td class="text-center border border-gray-200 p-2">
                      <div class="flex justify-evenly items-center space-x-2">
                        <a href="edit_categorie.php?id=<?php echo (int) $cat['id']; ?>"
                          class="text-blue-600 hover:text-blue-800">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                              d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                          </svg>
                        </a>
                        <a href="delete_categorie.php?id=<?php echo (int) $cat['id']; ?>"
                          class="text-red-600 hover:text-red-800">
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
    </div>

  </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>