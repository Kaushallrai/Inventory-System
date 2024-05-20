<?php
$page_title = 'Admin Home Page';
require_once ('includes/load.php');
page_require_level(1);
?>
<?php
$c_category = count_by_id('categories');
$c_product = count_by_id('products');
$c_sale = count_by_id('sales');
$c_user = count_by_id('users');
$products_sold = find_higest_saleing_product('10');
$recent_products = find_recent_product_added('6');
$recent_sales = find_recent_sale_added('6')
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

        <div class="">
            <div class="text-2xl font-semibold ml-6">Inventory Summary</div>
            <div class="flex ml-4 ">
                <div class="flex flex-col gap-8 mr-14 ml-2">
                    <div class="flex  gap-8 justify-between pt-5 w-5/7">

                        <!-- Categories -->
                        <a href="categorie.php"
                            class="w-40 border rounded-lg p-3 flex flex-col items-center cursor-pointer bg-white h-24 gap-2">
                            <div class="border rounded-md w-10 p-2 mb-2 flex items-center justify-center ">

                                <i class="fas fa-list-ul categories-icon text-purple-500 "></i>

                            </div>
                            <div class=" flex items-center justify-around w-full text-sm font-medium">
                                <span><?php echo $c_category['total']; ?></span>
                                <span>Categories</span>

                            </div>
                        </a>
                        <!-- Products -->
                        <a href="manage_products.php"
                            class="w-40 border rounded-lg p-3 flex flex-col items-center cursor-pointer bg-white h-24 gap-2">
                            <div class="border rounded-md w-10 p-2 mb-2 flex items-center justify-center ">
                                <i class="fas fa-box product-icon text-red-500"></i>

                            </div>
                            <div class="flex items-center justify-around w-full text-sm font-medium">
                                <span><?php echo $c_product['total']; ?></span>
                                <span>Products</span>

                            </div>
                        </a>
                        <!-- Sales -->
                        <a href="sales.php"
                            class="w-40 border rounded-lg p-3 flex flex-col items-center cursor-pointer bg-white h-24 gap-2">
                            <div class="border rounded-md w-10 p-2 mb-2 flex items-center justify-center ">
                                <i class="
                                        fas fa-dollar-sign sales-icon text-green-500"></i>

                            </div>
                            <div class="flex items-center justify-around w-full text-sm font-medium">
                                <span><?php echo $c_sale['total']; ?></span>
                                <span>Sales</span>

                            </div>
                        </a>
                        <!-- Users -->
                        <a href="manage_users.php"
                            class="w-40 border rounded-lg p-3 flex flex-col items-center cursor-pointer bg-white h-24 gap-2">
                            <div class="border rounded-md w-10 p-2 mb-2 flex items-center justify-center ">
                                <i class="fas fa-users text-blue-500"></i>

                            </div>
                            <div class="flex items-center justify-around w-full text-sm font-medium">
                                <span><?php echo $c_user['total']; ?></span>
                                <span>Users</span>

                            </div>
                        </a>



                    </div>
                    <div class="grid ">
                        <div class="bg-white rounded-lg overflow-hidden shadow-md  w-5/7 ">
                            <div class="bg-gray-200 px-4 py-2 ">
                                <strong class="text-lg">
                                    <span class="inline-block align-middle mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 inline-block align-middle" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </span>
                                    <span class="inline-block align-middle">Highest Selling Products</span>
                                </strong>
                            </div>
                            <div class="px-4 py-2">
                                <table class="w-full bg-white border-collapse border border-gray-300">
                                    <thead>
                                        <tr>
                                            <th class="border border-gray-300 px-4 py-2 w-80">Title</th>
                                            <th class="border border-gray-300 px-4 py-2">Total Sold</th>
                                            <th class="border border-gray-300 px-4 py-2">Total Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products_sold as $product_sold): ?>
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <?php echo remove_junk(first_character($product_sold['name'])); ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <?php echo (int) $product_sold['totalSold']; ?>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <?php echo (int) $product_sold['totalQty']; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-1/3 mt-5  ">
                    <div class=" bg-white border border-gray-200 rounded-md shadow-sm">
                        <div class="p-4 bg-gray-300 border-b border-gray-200">
                            <h3 class="text-lg font-semibold">
                                <span class="text-gray-600 mr-2">
                                    <i class="fas fa-th"></i>
                                </span>
                                <span>Recently Added Products</span>
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                <?php foreach ($recent_products as $recent_product): ?>
                                    <a href="edit_product.php?id=<?php echo (int) $recent_product['id']; ?>"
                                        class="flex items-center justify-between p-2 bg-gray-50 border border-gray-200 rounded-md hover:bg-gray-100 transition duration-300">
                                        <div class="flex items-center space-x-4">
                                            <?php if ($recent_product['media_id'] === '0'): ?>
                                                <img class="w-10 h-10 rounded-full" src="uploads/products/no_image.png" alt="">
                                            <?php else: ?>
                                                <img class="w-10 h-10 rounded-full"
                                                    src="uploads/products/<?php echo $recent_product['image']; ?>" alt="" />
                                            <?php endif; ?>
                                            <div>
                                                <h4 class="font-semibold">
                                                    <?php echo remove_junk(first_character($recent_product['name'])); ?>
                                                </h4>
                                                <span class="text-xs text-gray-500">
                                                    <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="text-sm font-semibold text-yellow-500">
                                            $<?php echo (int) $recent_product['sale_price']; ?>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-5/7 px-4 ml-2 mt-6 mr-4 ">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="bg-gray-200 px-4 py-2 border-b border-gray-300">
                        <strong class="text-lg flex items-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </span>
                            <span>LATEST SALES</span>
                        </strong>
                    </div>
                    <div class="px-4 py-2 ">
                        <table class="w-full  border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="text-center border border-gray-300" style="width: 50px;">#</th>
                                    <th class="border border-gray-300">Product Name</th>
                                    <th class="border border-gray-300">Date</th>
                                    <th class="border border-gray-300">Total Sale</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_sales as $index => $recent_sale): ?>
                                    <tr class="border border-gray-300">
                                        <td class="text-center border border-gray-300"><?php echo $index + 1; ?></td>
                                        <td class=" pl-4 border border-gray-300">
                                            <a href="edit_sale.php?id=<?php echo (int) $recent_sale['id']; ?>">
                                                <?php echo remove_junk(first_character($recent_sale['name'])); ?>
                                            </a>
                                        </td>
                                        <td class=" text-center border border-gray-300">
                                            <?php echo remove_junk(ucfirst($recent_sale['date'])); ?>
                                        </td>
                                        <td class=" text-center border border-gray-300">
                                            $<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-4"> &nbsp</div>

        </div>

    </div>


</body>

</html>