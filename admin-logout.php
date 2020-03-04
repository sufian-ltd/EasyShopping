<?php
    session_start();
    if(isset($_SESSION['USER_TYPE'])=="admin"){
        unset($_SESSION['USER_TYPE']);
        header('Location: http://localhost/LearningPHP/CRUD-PHP/index.php');
        exit();
    }
?>