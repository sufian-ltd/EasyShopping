<!DOCTYPE html>
<?php
    session_start();
    include "database/DBUser.php";
    $msg = "";
    if( isset($_POST['login']) ) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userType=$_POST['userType'];
        $password = md5($password);
        if(empty($email))
            $msg="A valid Email is required";
        if (empty($password))
            $msg=$msg."<br/>Password is required";
        if ($userType=="nothing")
            $msg=$msg."<br/>User Type is required";
        if($msg=="") {
            if($userType=="user") {
                $dbUser = new DBUser();
                $msg = $dbUser->isUser($email,$password);
                if($msg=="exist") {
                    $_SESSION["USER_TYPE"]="user";
                    $_SESSION["USER_EMAIL"]=$email;
                    $_SESSION["USER_PASSWORD"]=$password;
                    header('Location: http://localhost/LearningPHP/CRUD-PHP/user-section.php');
                    exit;
                }
                else{
                    header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
                    exit;
                }
            }
            else if($userType=="admin"){
                if($email=="admin@admin.com" && $password==md5("admin")){
                    $_SESSION["USER_TYPE"]="admin";
                    header('Location: http://localhost/LearningPHP/CRUD-PHP/admin-section.php');
                    exit;
                }
                else
                    $msg="invalid email or password....!!!";
            }
        }
    }
?>
<html>
<head>
    <title>PHP-CRUD-Login</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body <body style="font-family: serif;color: white;background-image: url('images/a.jpeg');">
<?php include "includes/nav-user.php"; ?>
<br>
<div align="center">

    <form action="login.php" method="post"
          style="width: 400px;border-style: dotted;border-color: white;padding: 10px">
        <div class="form-group">
            <?php
            if($msg != "") {
                echo '<div class="alert alert-danger">'.$msg.'</div>';
            }
            ?>
        </div>
        <div class="input-group">
            <h3 style="color:white;">Login Panel</h3>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input type="email" class="form-control" name="email" id="email1" placeholder="Enter Valid Email Address : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="password" id="password1"
                   placeholder="Enter Valid Password : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
            <select name="userType" class="form-control">
                <option value="nothing">Select User Type</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <br/>
        <div class="input-group">
            <button name="login" style="width: 375px" type="submit" class="btn btn-primary glyphicon glyphicon-log-in"> Login</button>
        </div>
        <br/>
        <div class="input-group">
            <a style="color: white" href="registration.php">Not register yet? Click here to register</a>
        </div>
    </form>
</div>
<br/>
<br/>
<br/>
<?php include "includes/footer.php" ?>

</body>
</html>

