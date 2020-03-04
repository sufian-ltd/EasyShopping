<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP-CRUD-Home</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body style="font-family: serif">

<?php
    $userType=$_SESSION['USER_TYPE'];
    if($userType=="admin") {
        include "includes/nav-admin.php";
    }
    else {
        include "includes/nav-user.php";
    }
?>
<img src="images/user1.jpg">
<?php include "includes/about-content.php" ?>
<div align="center">
<img align="center" src="images/mid1.jpg" style="width: 100%;">
</div>
<br/>
<?php include "includes/footer.php" ?>
</body>
</html>
