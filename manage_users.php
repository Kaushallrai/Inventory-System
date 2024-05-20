<?php
$page_title = 'All User';
require_once ('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
page_require_level(1);
//pull out all user form database
$all_users = find_all_user();
$groups = find_all('user_groups');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100" style="height: 100vh; overflow-y: auto;">
    <div x-data="{ modalOpen: false }">
        <div class="relative">
            <div class="ml-60 fixed z-50 right-0 left-0 top-0" :class="{ 'hidden': modalOpen}">
                <?php include_once ('layout/header.php'); ?>
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
        <div class="ml-64 mt-20">
            <div class="mb-4 ">
                <?php echo display_msg($msg); ?>
            </div>


            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Users</h2>
                    <a @click="modalOpen = true"
                        class="inline-flex items-center px-3 py-2 bg-blue-500 text-white cursor-pointer rounded-md hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add New User
                    </a>
                    <!-- Modal -->
                    <div x-show="modalOpen" class="fixed z-10 inset-0 overflow-y-auto flex items-center justify-center"
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                        <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                                <button @click="modalOpen = false" type="button"
                                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none ">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-6 w-6" x-description="Heroicon name: outline/x"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add New
                                        User </h3>
                                    <div class="mt-2">
                                        <?php echo display_msg($msg); ?>
                                        <form method="post" action="add_user.php">
                                            <div class="mb-4">
                                                <label for="name" class="block text-gray-700 font-semibold mb-2">
                                                    Name</label>
                                                <input type="text" id="name" name="full-name"
                                                    class="w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="username"
                                                    class="block text-gray-700 font-semibold mb-2">Username</label>
                                                <input type="text" id="username" name="username"
                                                    class="w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none"
                                                    required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="password"
                                                    class="block text-gray-700 font-semibold mb-2">Password</label>
                                                <input type="password" id="password" name="password"
                                                    class="w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none"
                                                    min="1" required>
                                            </div>
                                            <div class="mb-8">
                                                <label for="level" class="block text-gray-700 font-semibold mb-2">User
                                                    Level</label>
                                                <select name="level"
                                                    class="w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700">
                                                    <?php foreach ($groups as $group): ?>
                                                        <option value="<?php echo $group['group_level']; ?>">
                                                            <?php echo ucwords($group['group_name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="flex justify-end ">
                                                <button type="submit" name="add_user"
                                                    class="py-2 px-4 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300">Add
                                                    User</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Username</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User Role</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <a href="delete_user.php?id=<?php echo (int) $a_user['id']; ?>"
                                            class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
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