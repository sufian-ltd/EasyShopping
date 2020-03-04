<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP-CRUD-USER-VIEW-CATEGORY</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body style="font-family: serif">
<?php include "includes/nav-user.php"; ?>
<div style="margin: 10px">
    <div class="row">
        <div class="col-sm-10 col-md-2">
            <div class="thumbnail">
                <img src="images/s.jpg" width="242" height="250">
                <div align="center" class="caption">
                    <h4 style="color: black">White Tea Shirt</h4>
                    <h5 style="color: red">After Discount : </h5>
                    <h5 style="color: #ec971f">Before Discount : </h5>
                    <a href="#" class="btn btn-danger" role="button">Add To Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>
</body>
</html>