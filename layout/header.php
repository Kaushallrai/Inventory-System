<?php $user = current_user(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body class="">
    <?php if ($session->isUserLoggedIn(true)): ?>
        <div class="border w-full bg-white">
            <div class="toggle flex items-center justify-between m-4">
                <div class="text-md font-semibold text-gray-500">
                    <?php echo date("F j, Y, g:i a", strtotime("now +5 hours 45 minutes")); ?>
                </div>

                <div class="relative inline-block text-left  mr-2 cursor-pointer rounded-lg">

                    <img src="uploads/users/<?php echo $user['image']; ?>" alt="user-image"
                        class="inline-block w-8 h-8 rounded-full border">

                    <span class="ml-2"><?php echo remove_junk(ucfirst($user['name'])); ?></span>

                    <span class="fas fa-caret-down ml-4 text-xs"></span>

                    <div id="submenu" class="submenu absolute z-10 right-0 mt-2 w-32 bg-white rounded-md shadow-lg hidden">
                        <ul class="py-1">
                            <li><a href="profile.php?id=<?php echo (int) $user['id']; ?>"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            </li>
                            <li><a href="edit_account.php"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit
                                    Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <script>

            document.querySelector('.toggle').addEventListener('click', function (event) {
                event.stopPropagation();
                document.getElementById('submenu').classList.toggle('hidden');
                this.classList.toggle('rotate-180');
            });


            document.addEventListener('click', function (event) {
                const submenu = document.getElementById('submenu');
                const toggle = document.querySelector('.toggle');
                if (!event.target.closest('.submenu') && event.target !== toggle) {
                    submenu.classList.add('hidden');

                }
            });
        </script>
    <?php endif; ?>