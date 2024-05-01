<?php
$page_title = 'All Image';
require_once ('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);
?>
<?php $media_files = find_all('media'); ?>

<?php
if (isset($_POST['submit'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
  if ($photo->process_media()) {
    $session->msg('s', 'Photo has been uploaded successfully.');
    redirect('media.php');
  } else {
    $session->msg('d', 'Failed to upload photo: ' . join($photo->errors));
    redirect('media.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
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
    <?php echo display_msg($msg); ?>
    <div class="w-full ">
      <div class="bg-white shadow-md rounded-lg mr-4 border">
        <div class="flex justify-between items-center px-4 py-3 bg-gray-400 rounded-t-lg">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
              </path>
            </svg>
            <span class="text-white font-semibold">All Photos</span>
          </div>
          <form class="flex items-center" action="media.php" method="POST" enctype="multipart/form-data">
            <div class="flex ">
              <label class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-l cursor-pointer">
                <input type="file" name="file_upload" multiple="multiple" class="hidden" />
                <svg xmlns="http://www.w3.org/2000/svg" class=" w-5 " viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd" />
                </svg>
              </label>
              <button type="submit" name="submit"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">Upload</button>
            </div>
          </form>
        </div>
        <div class="p-4">
          <table class="w-full table-auto">
            <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-center">#</th>
                <th class="py-3 px-6 text-center">Photo</th>
                <th class="py-3 px-6 text-center">Photo Name</th>
                <th class="py-3 px-6 text-center">Photo Type</th>
                <th class="py-3 px-6 text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
              <?php foreach ($media_files as $media_file): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                  <td class="py-3 px-6 text-center"><?php echo count_id(); ?></td>
                  <td class="py-3 px-6 flex items-center justify-center">
                    <img src="uploads/products/<?php echo $media_file['file_name']; ?>" class="w-20 h-20 rounded " />
                  </td>
                  <td class="py-3 px-6 text-center font-semibold"><?php echo $media_file['file_name']; ?></td>
                  <td class="py-3 px-6 text-center font-semibold"><?php echo $media_file['file_type']; ?></td>
                  <td class="py-3 px-6 text-center ">
                    <a href="delete_media.php?id=<?php echo (int) $media_file['id']; ?>"
                      class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md ">
                      Delete
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php include_once ('layout/footer.php'); ?>