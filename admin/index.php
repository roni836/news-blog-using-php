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
<div class="flex">
    <div class="w-4/12">
        <?php
include_once "sidebar.php";
        ?>
    </div>
</div>



    
</body>
</html>