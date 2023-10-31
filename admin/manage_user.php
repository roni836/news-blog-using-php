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
    <h2 class="font-bold text-3xl ms-5"> Admin / Manage User</h2>
</div>
<div class="flex">
    <div class="w-4/12">
        <?php   include_once "sidebar.php";
        ?>
    </div>
  <div class="w-4/12 mx-auto">
    <table class="table-auto">
    <thead>
        <tr>
            <th>User Id</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $callingData = callingData("user");
        foreach($callingData as $value):
            ?>
            <tr>
                <td><?=$value['id'];?></td>
                <td><?=$value['name'];?></td>
                <td><?=$value['contact'];?></td>
                <td><?=$value['email'];?></td>
                <td>
                  <div class="text-red-500"><a href="?delete_user=<?=$value['id'];?>">Delete</a>
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
if(isset($_GET['delete_user'])){
    $id = $_GET['delete_user'];

    if(deleteRecord('user',"id='$id'")){
        redirect("manage_user.php");
    }
    else{
        alert('Failed');
        redirect("manage_user.php");
    }
}
?>