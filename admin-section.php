<?php
    session_start();
    if(isset($_SESSION['USER_TYPE'])!="admin"){
    header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP-CRUD-Home</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body <body style="font-family: serif;font-weight:">
    <?php include "includes/nav-admin.php";?>
    <img src="images/admin1.png">
    <?php include "includes/about-content.php" ?>
    <div align="center">
        <img align="center" src="images/about2.jpg">
    </div>
    <br/>
    <?php include "includes/footer.php"?>
</body>
</html>