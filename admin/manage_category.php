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
    <h2 class="font-bold text-3xl ms-5"> Admin / Manage Category</h2>
</div>
<div class="flex">
    <div class="w-4/12">
        <?php   include_once "sidebar.php";
        ?>
    </div>
    <div class="w-3/12">
        
<form method="post">
  <div class="mb-6">
    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cat Title</label>
    <input type="text" name="cat_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
  </div>
  <div class="mb-6">
    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cat Description</label>
    <input type="text" name="cat_description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
  </div>

  <input type="submit" name="insert_cat" value="Insert Category" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
</form>
<?php
    if(isset($_POST['insert_cat'])){
        $data = [
            'cat_title' => $_POST['cat_title'],
            'cat_description' => $_POST['cat_description']
        ];
        if(insertData("categories",$data)){
            redirect("manage_category.php");
        }
        else{
            alert('Try Again');
            redirect("manage_category.php");
        }
    }
?>
  </div>
  <div class="w-4/12 mx-auto">
    <table class="table-auto">
    <thead>
        <tr>
            <th>Category</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $callingData = callingData("categories");
        foreach($callingData as $value):
            ?>
            <tr>
                <td><?=$value['cat_id'];?></td>
                <td><?=$value['cat_title'];?></td>
                <td><?=$value['cat_description'];?></td>
                <td><a href="?cat_delete=<?=$value['cat_id'];?>">Delete</a>
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
if(isset($_GET['cat_delete'])){
    $id = $_GET['cat_delete'];

    if(deleteRecord('categories',"cat_id='$id'")){
        redirect("manage_category.php");
    }
    else{
        alert('Failed');
        redirect("manage_category.php");
    }
}
?>