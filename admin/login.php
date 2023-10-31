<?php
include_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | E - Coach</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<?php
include_once "admin_header.php";

$data = [
    'email'=>'roni@gmail.com',
    'password'=>md5('1234')
];

insertData("admin",$data);

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-4 mx-auto">
            <div class="card">
                <div class="card-body">
                <form method="post">
                <!-- Email input -->
                <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                    <input type="email" name="email" id="form2Example1" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Password</label>
                    <input type="password" name="password" id="form2Example2" class="form-control" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">

                    <div class="col">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <input type="submit" value="Sign In" name="admin_login" class="btn btn-primary btn-block mb-4 w-100">
            </form>

            <?php
                if(isset($_POST['admin_login'])){
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);

                    $query = $connect->query("SELECT * FROM admin where email='$email' AND password='$password'");

                    $count = $query->num_rows;
                    if($count > 0){
                        $_SESSION['admin'] = $email;
                        redirect('index.php');
                    }
                    else{
                        alert("Invalid Email Or Password");
                        redirect('login.php');
                    }
                }

            ?>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>