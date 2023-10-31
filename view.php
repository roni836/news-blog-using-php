<?php
include_once "config.php";

if(!isset($_GET['news_id'])){
    redirect('index.php');
}
$news_id = $_GET['news_id'];
$newsData = callingData("news","news_id='$news_id'");

$newsData = $newsData[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$newsData['title'];?>The Wire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php
include_once "header.php";
?>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4"><?= $newsData['title']; ?></h1>
            <p class="text-gray-600 mb-4">By <?= $newsData['author']; ?></p>
            <p class="text-gray-600 mb-4"><?= $newsData['category_id']; ?></p>
            <img src="admin/images/<?= $newsData['image']; ?>" alt="<?= $newsData['title']; ?>" class="mb-4">
            <p class="text-gray-800"><?= $newsData['description']; ?></p>
        </div>
    </div>
    <div class="flex-row">
        <div class="col">
            <h2>Related News</h2>
        </div>
        <?php

        $query = mysqli_query($connect,"SELECT * FROM news JOIN categories ON news.category_id = categories.cat_id WHERE news_id<>'$news_id'");

        $count = mysqli_num_rows($query);
        if($count < 1){
            echo "<h2> Not Found</h2>";
        }
        while($data = mysqli_fetch_array($query)):
            ?>
            <div class="flex-col">
            <h1 class="text-3xl font-bold mb-4"><?= $data['title']; ?></h1>
            <p class="text-gray-600 mb-4">By <?= $data['author']; ?></p>
            <p class="text-gray-600 mb-4"><?= $data['category_id']; ?></p>
            <img src="admin/images/<?= $data['image']; ?>" alt="<?= $data['title']; ?>" class="mb-4">
            <p class="text-gray-800"><?= $data['description']; ?></p>
            <a href="view.php?news_id=<?=$data['news_id'];?>">View</a>
            </div>
        <?php endwhile;?>
    </div>
</body>
</html>
