<?php
session_start();
if(isset($_SESSION['USER_TYPE'])=="user"){
    unset($_SESSION['USER_TYPE']);
    unset($_SESSION['USER_EMAIL']);
    unset($_SESSION['USER_PASSWORD']);
    unset($_SESSION['shopping_cart']);
    header('Location: http://localhost/LearningPHP/CRUD-PHP/index.php');
    exit();
}
?>