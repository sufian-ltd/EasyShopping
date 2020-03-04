<!DOCTYPE html>
<?php
include "database/DBUser.php";
$msg = "";
if( isset($_POST['register']) ) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = md5($password);
    if(empty($name))
        $msg="A name is required";
    if(empty($email))
        $msg=$msg."<br/>A valid Email is required";
    if (empty($password))
        $msg=$msg."<br/>Password is required";
    if(empty($contact))
        $msg=$msg."<br/>A valid Contact is required";
    if (empty($address))
        $msg=$msg."<br/>User address is required";
    if($msg=="") {
        $dbUser = new DBUser();
        $msg=$dbUser->isUser($email,$password);
        if($msg=='exist'){
            $msg="This email and password is already exist...!!!<br/>So please try again";
        }
        else if($dbUser->registerUser($name,$email,$password,$contact,$address)){
            $msg="Your Registration is successfully complete....!!!!!!!!!";
        }
    }
}
?>
<html>
<head>
    <title>PHP-CRUD-Registration</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body style="font-family: serif;color: white; background-image: url('images/a.jpeg');">
<?php include "includes/nav-user.php"; ?>
<br>
<div class="" align="center">
    <form action="registration.php" method="post"
          style="width: 450px;border-style: dotted;padding: 10px;border-color: white">
        <div class="form-group">
            <?php
            if ($msg != "") {
                echo '<div class="alert alert-danger">' . $msg . '</div>';
            }
            ?>
        </div>
        <div class="input--group">
            <h3 style="color: white">User Registration</h3>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="name" id="name1" placeholder="Enter Full Name : "/>
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
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input type="number" class="form-control" name="contact" id="contact1" placeholder="Enter Valid Contact : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <input type="text" class="form-control" name="address" id="address1" placeholder="Enter Valid address"/>
        </div>
        <br/>
        <div class="input-group">
<!--            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>-->
            <button name="register" style=" width: 425px" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i>  Click here to register</button>
        </div>
    </form>
</div>
<br/>
<br/>
<?php include "includes/footer.php" ?>
</body>
</html>
