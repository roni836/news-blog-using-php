<?php
$connect = new mysqli("localhost","root","","blog");

session_start();

if($connect->connect_error){
    echo "Failed";
}

function redirect($page){
    echo "<script>window.open('$page','_self')</script>";
}

function alert($msg){
    echo "<script>alert('$msg')</<script>";
}

function insertData($table,$data){
    global $connect;
    $col = implode(",",array_keys($data));
    $value = implode("','",array_values($data));

    $q = $connect->query("INSERT INTO $table($col) values('$value')");

    return $q;
}

function callingData($table){
    global $connect;
    $q = $connect->query("SELECT * FROM $table");
    $data = $q->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function deleteRecord($table,$cond){
    global $connect;
    $query = $connect->query("DELETE FROM $table WHERE $cond");

    return $query; 
}

function countRecord($table,$cond=NULL){
    global $connect;

    if($cond==NULL){
        $q = "SELECT * FROM $table";
    }
    else{
        $q = "SELECT * FROM $table WHERE $cond";
    }
    $result = $connect->query($q);
    $count = $result->num_rows;

    return $count;
}

function checkAdmin(){
    if(!isset($_SESSION['admin'])){
        redirect('login.php');
    }
}

function getUser(){
    global $connect;
    if(!isset($_SESSION['user'])){
        redirect("login.php");
    }
    $email = $_SESSION['user'];

    $user = callingData("user","email = '$email'");
    return $user[0];
}

// Search function

function search($table){
    global $connect;
    $query = $connect->query("SELECT * FROM $table");
    return $query;
}
