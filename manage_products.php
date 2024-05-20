<?php
$page_title = 'All Product';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
$products = join_product_table();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
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
  <div class="ml-60 mt-20 px-6">
    <div class="w-full">
      <?php echo display_msg($msg); ?>
    </div>

    <div class="w-full bg-white shadow-md rounded-lg p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Products</h2>
        <a href="add_product.php"
          class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Add New Product
        </a>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="border border-gray-300 text-center p-2 font-semibold" style="width: 50px;">#</th>
              <th class="border border-gray-300 p-2 font-semibold">Photo</th>
              <th class="border border-gray-300 p-2 font-semibold">Product Title</th>
              <th class="border border-gray-300 text-center p-2 font-semibold" style="width: 15%;">Categories</th>
              <th class="border border-gray-300 text-center p-2 font-semibold" style="width: 10%;">In-Stock</th>
              <th class="border border-gray-300 text-center p-2 font-semibold" style="width: 10%;">Buying Price</th>
              <th class="border border-gray-300 text-center p-2 font-semibold" style="width: 10%;">Selling Price</th>
              <th class="border border-gray-300 text-center p-2 font-semibold" style="width: 10%;">Product Added</th>
              <th class="border border-gray-300 text-center p-2 font-semibold" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
              <tr class="hover:bg-gray-100 transition-colors duration-300">
                <td class="text-center border border-gray-300 p-2"><?php echo count_id(); ?></td>
                <td class="border border-gray-300 flex justify-center p-2">
                  <?php if ($product['media_id'] === '0'): ?>
                    <img class="rounded-full w-12 h-12" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                    <img class="rounded-full w-12 h-12" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td class="border border-gray-300 pl-2"><?php echo remove_junk($product['name']); ?></td>
                <td class="text-center border border-gray-300"><?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center border border-gray-300"><?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center border border-gray-300"><?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center border border-gray-300"><?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center border border-gray-300"><?php echo read_date($product['date']); ?></td>
                <td class="text-center border border-gray-300">
                  <div class="flex justify-evenly gap-2">
                    <a href="edit_product.php?id=<?php echo (int) $product['id']; ?>"
                      class="text-blue-600 hover:text-blue-800 transition-colors duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                      </svg>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int) $product['id']; ?>"
                      class="text-red-600 hover:text-red-800 transition-colors duration-300">
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

<a href="edit_product.php?id=<?php echo (int) $product['id']; ?>"