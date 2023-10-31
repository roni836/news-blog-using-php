<?php
include_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wire : The Wire News India</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body>
<?php
include_once "header.php";
?>
<div class="flex justify-between bg-red-600">
    <div class="flex items-center ps-5 h-16 gap-5 tracking-tighter">
        <?php $callingCat = callingData("categories");
        foreach($callingCat as $cat):
        ?>
        <a href="" class="uppercase text-white font-bold hover:text-lg"><?=$cat['cat_title'];?></a>
        <?php endforeach;?>
    </div>
 
    <!-- searching work -->

    <div class="p-4">
        <form action="" >
            <input type="search" name='search' class="w-30 h-10 rounded-lg border focus:outline-none focus:ring focus:border-black px-4"placeholder="Search">
            <input type="submit" name="find" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg h-10 px-4" value="Search">
        </form>

    <?php
        if(isset($_GET['find'])){
            $search = $_GET['search'];
            $q = search("news JOIN categories ON news.category_id = categories.cat_id WHERE title LIKE '%$search%' OR cat_title LIKE '%$search%' OR description LIKE '%$search%'");
        }
        else{
            if(isset($_GET['cat_id'])){
                $cat_id = $_GET['cat_id'];
                $q = search("news JOIN categories ON news.category_id = categories.cat_id WHERE cat_id = '$cat_id'");
            }
            else{
                $q = search("news JOIN categories ON news.category_id = categories.cat_id");
            }
        }
        $count = mysqli_num_rows($q);

        if($count < 1){
            echo "<h2> Not Found </h2>";
        }
    ?>

    </div>
</div>
    
    <div class="flex flex-col bg-slate-600 pt-5 justify-between">
       <div class="flex-row w-8/12">
        <?php
        $callingNews = callingData("news");
        foreach($callingNews as $value):
            ?>
            <a href="view.php?news_id=<?=$value['news_id'];?>">
            <div class="flex  ps-20">
                <div class="h-[400px] w-[900px] relative border-4 p-6">
                    <img src="admin/images/<?=$value['image'];?>" alt="">
                    <div class="absolute bottom-0 px-4 py-3 bg-gray-500/50 w-full">
                        <h1 class="text-white font-semibold text-4xl"><?=$value['title'];?></h1>
                        <p class="text-gray-200">
                        I love kittens very much. They are amazing.
                        </p>
                    </div>
                </div>
            </div>
            </a>
        <?php endforeach;?>
       </div>

       <?php
        $callingNews = callingData("news");
        foreach($callingNews as $value):
            ?>
      <div class="flex pt-10 ps-20 w-4/12">
        <div class="flex flex-row">
            <div class="h-[500px] w-[600px] relative border-4 ">
                <img src="" alt="">
                <div class="absolute bottom-0 bg-gray-500/50 w-full">
                    <h1 class="text-white font-semibold text-4xl">title</h1>
                    <p class="text-gray-200">
                    I love kittens very much. They are amazing.
                    </p>
                 </div>
            </div>
       </div>
      </div>
              <?php endforeach;?>

    </div>
</body>
</html>
