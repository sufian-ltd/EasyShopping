<?php
session_start();
if (isset($_SESSION['USER_TYPE']) != "user") {
    header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
    exit();
}
?>
<?php
    require_once "database/DBUser.php";
    $dbUser=new DBUser();
    $email=$_SESSION['USER_EMAIL'];
    $password=$_SESSION['USER_PASSWORD'];
    $userRes=$dbUser->getUserByEmailPass($email,$password);
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP-CRUD-USER</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body
<body style="font-family: serif;color: white; background-image: url('images/a.jpeg');">
<?php include "includes/nav-user.php"; ?>
<br>
<div class="container" align="center"
     style="width: 450px;border-style: double;padding: 10px;border-color: white;
        background-image: url('images/bb.jpg');">

        <div class="input--group">
            <img src="images/d1.jpg" width="200" height="200">
        </div>
        <br/>
        <div class="input-group">
            <h4><span class="glyphicon glyphicon-hand-up"></span>
                User Id : <?php echo $userRes['id']?>
            </h4>
        </div>
        <br/>
        <div class="input-group">
            <h4><span class="glyphicon glyphicon-user"></span>
                Full Name : <?php echo $userRes['name']?>
            </h4>
        </div>
        <br/>
        <div class="input-group">
            <h4><span class="glyphicon glyphicon-envelope"></span>
                Email : <?php echo $userRes['email']?>
            </h4>
        </div>
        <br/>
        <div class="input-group">
            <h4><span class="glyphicon glyphicon-phone"></span>
                Contact : <?php echo $userRes['contact']?>
            </h4>
        </div>
        <br/>
        <div class="input-group">
            <h4><span class="glyphicon glyphicon-hand-right"></span>
                Address : <?php echo $userRes['address']?>
            </h4>
        </div>
        <br/>
        <div class="input-group">
            <button name="register" style=" width: 425px" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i>  Click here to update</button>
        </div>
</div>
<br/>
<br/>
<?php include "includes/footer.php" ?>
</body>
</html>