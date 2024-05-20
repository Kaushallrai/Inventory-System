<?php
$page_title = 'Edit Product';
require_once ('includes/load.php');
// Checking the user's permission level to view this page
page_require_level(2);
?>
<?php
$product = find_by_id('products', (int) $_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
if (!$product) {
  $session->msg("d", "Product ID missing.");
  redirect('edit_product.php');
}
?>
<?php
if (isset($_POST['product'])) {
  $required_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'saleing-price');
  validate_fields($required_fields);

  if (empty($errors)) {
    $product_name = remove_junk($db->escape($_POST['product-title']));
    $product_category = (int) $_POST['product-categorie'];
    $product_quantity = remove_junk($db->escape($_POST['product-quantity']));
    $buying_price = remove_junk($db->escape($_POST['buying-price']));
    $selling_price = remove_junk($db->escape($_POST['saleing-price']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $query = "UPDATE products SET";
    $query .= " name ='{$product_name}', quantity ='{$product_quantity}',";
    $query .= " buy_price ='{$buying_price}', sale_price ='{$selling_price}', categorie_id ='{$product_category}',media_id='{$media_id}'";
    $query .= " WHERE id ='{$product['id']}'";
    $result = $db->query($query);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Product updated successfully.");
      redirect('manage_products.php', false);
    } else {
      $session->msg('d', 'Failed to update product.');
      redirect('edit_product.php?id=' . $product['id'], false);
    }

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
          <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
          <form method="post" action="edit_product.php?id=<?php echo (int) $product['id'] ?>">
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
                    value="<?php echo remove_junk($product['name']); ?>">
                </div>
              </div>
              <div class="mb-4 flex">
                <div class="w-1/2 pr-2">
                  <select class="w-full border rounded-md px-3 py-2" name="product-categorie">
                    <option value="">Select a category</option>
                    <?php foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int) $cat['id']; ?>" <?php if ($product['categorie_id'] === $cat['id']):
                            echo "selected";
                          endif; ?>>
                        <?php echo remove_junk($cat['name']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="w-1/2 pl-2">
                  <select class="w-full border rounded-md px-3 py-2" name="product-photo">
                    <option value="">No image</option>
                    <?php foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int) $photo['id']; ?>" <?php if ($product['media_id'] === $photo['id']):
                            echo "selected";
                          endif; ?>>
                        <?php echo $photo['file_name'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="mb-4 flex">
                <div class="w-1/3 pr-2">
                  <div>
                    <label for="qty" class="block text-gray-700 font-bold mb-2">Quantity</label>
                    <div class="flex items-center border rounded-md px-3 py-2">
                      <span class="text-gray-500 mr-2">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round">
                          <path
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                      </span>
                      <input type="number" class="flex-1 bg-transparent outline-none" name="product-quantity"
                        value="<?php echo remove_junk($product['quantity']); ?>" min="0">
                    </div>
                  </div>
                </div>

                <div class="w-1/3 px-2">
                  <div>
                    <label for="buying-price" class="block text-gray-700 font-bold mb-2">Buying Price</label>
                    <div class="flex items-center border rounded-md px-3 py-2">
                      <span class="text-gray-500 mr-2">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round">
                          <line x1="12" y1="1" x2="12" y2="23" />
                          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                      </span>
                      <input type="number" class="flex-1 bg-transparent outline-none" name="buying-price"
                        value="<?php echo remove_junk($product['buy_price']); ?>" min="0">
                      <span class="text-gray-500 ml-2">.00</span>
                    </div>
                  </div>
                </div>

                <div class="w-1/3 pl-2">
                  <div>
                    <label for="saleing-price" class="block text-gray-700 font-bold mb-2">Selling Price</label>
                    <div class="flex items-center border rounded-md px-3 py-2">
                      <span class="text-gray-500 mr-2">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round">
                          <line x1="12" y1="1" x2="12" y2="23" />
                          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                      </span>
                      <input type="number" class="flex-1 bg-transparent outline-none" name="saleing-price"
                        value="<?php echo remove_junk($product['sale_price']); ?>" min="0">
                      <span class="text-gray-500 ml-2">.00</span>
                    </div>
                  </div>
                </div>

              </div>
              <button type="submit" name="product"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300 w-1/6">
                Update
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