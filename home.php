<?php
$page_title = 'Home Page';
require_once ('includes/load.php');
if (!$session->isUserLoggedIn(true)) {
    redirect('index.php', false);
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
        <div class="w-full">
            <?php echo display_msg($msg); ?>
        </div>
        <div class="w-full">
            <div class="bg-white shadow rounded-lg p-4">
                <div class="bg-gray-100 text-center py-6 rounded-lg">
                    <h1 class="text-4xl font-bold">Welcome to
                        <hr class="my-4"> Inventory Management System
                    </h1>
                    <!-- <p class="mt-2">Browse around to find out the pages that you can access!</p> -->
                </div>
            </div>
        </div>

    </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>