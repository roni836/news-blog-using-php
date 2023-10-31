<?php
include_once "../config.php";

unset($_SESSION['admin']);

redirect('login.php');

?>