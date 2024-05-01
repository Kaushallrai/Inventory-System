<?php
$page_title = 'My profile';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
?>
<?php
$user_id = (int) $_GET['id'];
if (empty($user_id)):
  redirect('home.php', false);
else:
  $user_p = find_by_id('users', $user_id);
endif;
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
    <div class="fixed top-0"><?php include_once ('layout/sidebar.php'); ?>
    </div>


  </div>
  <div class="  ml-64 mt-20 ">
    <div class="flex">
      <div class="w-2/3  bg-white rounded-lg shadow-lg overflow-hidden m-4">
        <div class="bg-gray-400 text-white py-6 px-8">
          <div class="flex items-center">
            <img src="<?php echo $user['image']; ?>" alt="Profile Picture" class="w-20 h-20 rounded-full mr-4">
            <div>
              <h2 class="text-xl font-bold"><?php echo $user['name']; ?></h2>
              <p class="text-gray-50">@<?php echo $user['username']; ?></p>
            </div>
          </div>
        </div>
        <div class="p-8">
          <div class="mb-6">
            <h3 class="text-xl font-semibold mb-4">User Details</h3>
            <ul class="list-disc pl-4 flex flex-col gap-2">
              <li><span class="font-semibold text-gray-700 ">User Level :</span> <?php echo $user['user_level']; ?>
              </li>
              <li><span class="font-semibold text-gray-700 ">Status :</span>
                <?php echo $user['status'] ? 'Active' : 'Inactive'; ?>
              </li>
              <li><span class="font-semibold text-gray-700 ">Last Login :</span> <?php echo $user['last_login']; ?>
              </li>
            </ul>
          </div>

          <div class="flex justify-end">
            <a href="edit_account.php" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Edit
              Profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>