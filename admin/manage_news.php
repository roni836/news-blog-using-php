<?php
include_once "../config.php";
checkAdmin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | The Wire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
include_once "admin_header.php";
?>
<div class="flex mt-5">
    <h2 class="font-bold text-3xl ms-5"> Admin / Manage Courses</h2>
</div>
<div class="flex">
    <div class="w-4/12">
        <?php   include_once "sidebar.php";
        ?>
    </div>
    <div class="w-3/12">
        
      <form method="post" enctype="multipart/form-data" class="space-y-6">
        <div class="rounded-md shadow-sm space-y-px">
            <div class="mb-6">
          <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
          <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
              </div>
        <div class="mb-6">
          <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Language</label>
          <input type="text" name="language" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
          <input type="text" name="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
          <input type="file" name="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
          <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
          <select name="category_id" class=form-select id="">
              <option value="">Select Category</option>
              <?php
              $callingCat = callingData("categories");
              foreach($callingCat as $cat):
                  $id = $cat['cat_id'];
                  $title = $cat['cat_title'];
                  echo "<option value='$id'>$title</option>";
              endforeach;?>
          </select>
        </div>
        <div class="mb-6">
          <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
          <input type="text" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>

        <input type="submit" name="insert_news" value="Insert News" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        </div>
      </form>
        <?php
          if(isset($_POST['insert_news'])){
              $image = $_FILES['image']['name'];
              $tmp_image = $_FILES['image']['tmp_name'];

              move_uploaded_file($tmp_image,"images/$image");
              $data = [
                  'title' => $_POST['title'],
                  'description' => $_POST['description'],
                  'language' => $_POST['language'],
                  'category_id' => $_POST['category_id'],
                  'author' => $_POST['author'],
                  'image' => $image
              ];
              if(insertData("news",$data)){
                  redirect("manage_news.php");
              }
              else{
                  alert('Try Again');
                  redirect("manage_news.php");
              }
          }
        ?>
    </div>
    <div class="w-4/12 mx-auto">
    <table class="min-w-full divide-y divide-black">
    <thead class="">
        <tr>
            <th class="py-1 text-left text-xs font-medium text-black uppercase tracking-wider">Id</th>
            <th class="px-1 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Title</th>
            <th class="px-1 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Language</th>
            <th class="px-1 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Author</th>
            <th class="px-1 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Image</th>
            <th class="px-1 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Category</th>
            <th class="px-1 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Description</th>
            <th class="px-1 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-black">
        <?php
        $callingData = callingData("news Join categories on news.category_id=categories.cat_id");
        foreach($callingData as $value):
            ?>
            <tr>
                <td class="px-1 py-2"><?=$value['news_id'];?></tdclass=py-1>
                <td class="px-1 py-2"><?=$value['title'];?></td>
                <td class="px-1 py-2"><?=$value['language'];?></td>
                <td class="px-1 py-2"><?=$value['author'];?></td>
                <td class="px-1 py-2"><img width="50" height="auto" src="images/<?=$value['image'];?>"></td>
                <td class="px-1 py-2"><?=$value['category_id'];?></td>
                <td class="px-1 py-2"><?=$value['description'];?></td>
                <td class="px-1 py-2">
                  <div class="text-red-500"><a href="?news_delete=<?=$value['news_id'];?>">Delete</a>
                  </div>
            </td>
            </tr>
            <?php endforeach;?>
    </tbody>
    </table>
    </div>
</div>    
</body>
</html>
<?php
if(isset($_GET['news_delete'])){
    $id = $_GET['news_delete'];

    if(deleteRecord('news',"news_id='$id'")){
        redirect("manage_news.php");
    }
    else{
        alert('Failed');
        redirect("manage_news.php");
    }
}
?>