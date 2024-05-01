<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .sidebar-transition {
        transition: width 0.1s ease;
    }

    #sidebar {
        background-color: #ffffff;
        color: black;
    }

    #sidebar a:hover {
        background-color: rgb(243 244 246);
    }

    .submenu a {
        color: black;
    }

    .active {
        background-color: rgb(243 244 246);
        color: black;
    }
</style>


<div class="flex h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="w-60 text-white flex flex-col justify-between sidebar-transition border">
        <div class="py-4">
            <a href="admin.php" class="text-2xl font-medium mx-14 mb-10 cursor-pointer block my-2">Inventario</a>
            <ul>
                <li class="mb-4">
                    <a href="admin.php"
                        class="flex items-center gap-6 px-4 py-3  mx-5 rounded-md text-center hover:bg-gray-700">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="#"
                        class="flex items-center gap-6 px-4 py-3 rounded-md  mx-5 text-center hover:bg-gray-700 submenu-toggle">
                        <i class="fas fa-users"></i> <!-- Updated icon -->
                        <span>Users</span>
                        <i class="fas fa-caret-down ml-14"></i>
                    </a>
                    <ul class="nav submenu flex flex-col mx-8" style="display:none;">
                        <li class="flex items-center">
                            <a href="manage_groups.php"
                                class="flex items-center px-4 py-2 text-sm rounded-md text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-user-friends mr-4"></i> <!-- Updated icon -->
                                Manage Groups
                            </a>
                        </li>
                        <li>
                            <a href="manage_users.php"
                                class="flex items-center px-4 py-2 text-sm rounded-md text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-user-plus mr-4"></i> <!-- Updated icon -->
                                Manage Users
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="mb-4">
                    <a href="categorie.php"
                        class="flex items-center rounded-md gap-6 px-4 py-3 mx-5 text-center hover:bg-gray-700">
                        <i class="fas fa-list-ul"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="#"
                        class="flex items-center gap-6 px-4 py-3 rounded-md mx-5 text-center hover:bg-gray-700 submenu-toggle">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                        <i class="fas fa-caret-down ml-8"></i>
                    </a>
                    <ul class="nav submenu flex flex-col mx-8" style="display:none;">
                        <li class="flex items-center">
                            <a href="manage_products.php"
                                class="flex items-center px-4 py-2 text-sm rounded-md text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-cog mr-4"></i> <!-- Updated icon -->
                                Manage product
                            </a>
                        </li>
                        <li>
                            <a href="add_product.php"
                                class="flex items-center px-4 py-2 text-sm rounded-md text-gray-300 hover:bg-gray-700">
                                <i class="fas fa-plus-circle mr-4"></i> <!-- Updated icon -->
                                Add product
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="mb-4">
                    <a href="media.php"
                        class="flex items-center gap-6 px-4 py-3 mx-5 rounded-md text-center hover:bg-gray-700">
                        <i class="fas fa-images"></i>
                        <span>Media</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar Footer -->
        <div class="py-4">
            <a href="./logout.php"
                class="flex items-center gap-6 px-4 py-3 mx-5 rounded-md text-center hover:bg-gray-700">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.submenu-toggle').click(function (e) {
                e.preventDefault();
                $(this).next('.submenu').slideToggle();
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const pageTitle = document.title.trim();  // Get the current page title
            const links = document.querySelectorAll('#sidebar a span');  // Select all link text spans in the sidebar

            links.forEach(function (link) {
                if (link.textContent.trim() === pageTitle) {  // Compare link text to page title
                    link.closest('a').classList.add('active');  // Add 'active' class to the parent <a> tag
                }
            });
        });
    </script>