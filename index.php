<?php
ob_start();
require_once ('includes/load.php');
if ($session->isUserLoggedIn(true)) {
    redirect('admin.php', false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">
    <div class="flex justify-center">
        <div class="min-w-[500px] px-10 py-16 rounded-l-3xl bg-white border border-gray-200 my-10 ml-10 shadow-md">
            <h1 class="text-3xl font-semibold text-center">Welcome Back</h1>
            <p class="font-medium text-base text-gray-500 mt-4 text-center">
                Welcome back! Please enter your details.
            </p>
            <form method="post" action="auth.php" class="clearfix">
                <div class="mt-28">
                    <div class="flex flex-col">
                        <label class="text-sm font-medium">
                            Username
                        </label>
                        <input class="text-base w-full border border-gray-100 rounded-xl p-3 mt-1 outline-none"
                            placeholder="Enter your username" id="username" type="name" name="username" />

                    </div>
                    <div class="flex flex-col mt-4">
                        <label htmlFor="password" class="text-sm font-medium">
                            Password
                        </label>
                        <input
                            class="text-base w-full border-2 border-gray-100 rounded-xl p-3 mt-1 bg-transparent outline-none"
                            placeholder="Enter your password" type="password" id="password" name="password" />

                    </div>

                    <div class="mt-8 flex flex-col gap-y-4">
                        <button
                            class="active:scale-[.98] active:duration-75 transition-all hover:scale-[1.01]  ease-in-out transform py-4 bg-blue-500 rounded-xl text-white font-bold text-sm"
                            type="submit">
                            Sign in
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="max-w-[500px] rounded-3xl my-10 ml-[-5px] h-[650px] relative shadow-md">
            <span class="absolute text-white text-3xl font-medium right-6 top-5 hidden lg:block z-10">
                Inventerio
            </span>
            <span class="absolute text-white text-base font-medium px-6 bottom-6 hidden lg:block z-10">
                Embark on a journey of inventory mastery. Login to control, track, and
                optimize your stock, ensuring your business sails smoothly.
            </span>
            <img class="w-[500px] hidden lg:block bg-cover bg-no-repeat border-r border-y rounded-r-3xl h-full object-cover shadow-sm brightness-75 z-0"
                src="./assets/warehouse.jpg" alt="Warehouse" />
        </div>
    </div>

</body>

</html>
<?php include_once ('layouts/footer.php'); ?>