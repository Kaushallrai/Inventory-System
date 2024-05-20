<?php
$page_title = 'Add Product';
require_once ('includes/load.php');
// Checking the user's permission level for this page
page_require_level(2);
$all_categories = find_all('categories');
$all_photo = find_all('media');
?>
<?php
if (isset($_POST['add_product'])) {
  $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'selling-price');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_name = remove_junk($db->escape($_POST['product-title']));
    $p_cat = remove_junk($db->escape($_POST['product-categorie']));
    $p_qty = remove_junk($db->escape($_POST['product-quantity']));
    $p_buy = remove_junk($db->escape($_POST['buying-price']));
    $p_sale = remove_junk($db->escape($_POST['selling-price']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $date = make_date();
    $query = "INSERT INTO products (";
    $query .= "name, quantity, buy_price, sale_price, categorie_id, media_id, date";
    $query .= ") VALUES (";
    $query .= "'{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE name='{$p_name}'";
    if ($db->query($query)) {
      $session->msg('s', "Product added successfully.");
      redirect('add_product.php', false);
    } else {
      $session->msg('d', 'Failed to add the product.');
      redirect('product.php', false);
    }

  } else {
    $session->msg("d", $errors);
    redirect('add_product.php', false);
  }

}

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
  <div class="  ml-64 mt-20 ">
    <?php echo display_msg($msg); ?>
    <div class="flex  ">
      <div class="w-3/4">
        <div class="bg-white shadow-md rounded-lg p-6 m-4">
          <h2 class="text-2xl font-bold mb-4">Add New Product</h2>
          <form method="post" action="add_product.php">
            <div class="flex flex-col gap-2">
              <div class="mb-4">
                <div class="flex items-center border rounded-md px-3 py-2">
                  <span class="text-gray-500 mr-2">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                    </svg>
                  </span>
                  <input type="text" class="flex-1 bg-transparent outline-none" name="product-title"
                    placeholder="Product Title">
                </div>
              </div>
              <div class="mb-4 flex">
                <div class="w-1/2 pr-2">
                  <select class="w-full border rounded-md px-3 py-2" name="product-categorie">
                    <option value="">Select Product Category</option>
                    <?php foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int) $cat['id'] ?>">
                        <?php echo $cat['name'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="w-1/2 pl-2">
                  <select class="w-full border rounded-md px-3 py-2" name="product-photo">
                    <option value="">Select Product Photo</option>
                    <?php foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int) $photo['id'] ?>">
                        <?php echo $photo['file_name'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="mb-4 flex">
                <div class="w-1/3 pr-2">
                  <div class="flex items-center border rounded-md px-3 py-2">
                    <span class="text-gray-500 mr-2">
                      <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                    </span>
                    <input type="number" class="flex-1 bg-transparent outline-none" name="product-quantity"
                      placeholder="Product Quantity" min="0">
                  </div>
                </div>
                <div class="w-1/3 px-2">
                  <div class="flex items-center border rounded-md px-3 py-2">
                    <span class="text-gray-500 mr-2">
                      <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23" />
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                      </svg>
                    </span>
                    <input type="number" class="flex-1 bg-transparent outline-none" name="buying-price"
                      placeholder="Buying Price" min="0">
                    <span class="text-gray-500 ml-2">.00</span>
                  </div>
                </div>
                <div class="w-1/3 pl-2">
                  <div class="flex items-center border rounded-md px-3 py-2">
                    <span class="text-gray-500 mr-2">
                      <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23" />
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                      </svg>
                    </span>
                    <input type="number" class="flex-1 bg-transparent outline-none" name="selling-price"
                      placeholder="Selling Price" min="0">
                    <span class="text-gray-500 ml-2">.00</span>
                  </div>
                </div>
              </div>
              <button type="submit" name="add_product"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 transition-colors duration-300 w-1/6">
                Add product
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>