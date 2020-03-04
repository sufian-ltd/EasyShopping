<?php
    session_start();
    if(isset($_SESSION['USER_TYPE'])!="admin"){
        header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
        exit();
}
?>
<!DOCTYPE html>
<?php
require_once "database/DBSell.php";
require_once "database/DBProduct.php";
$msg = "";
$id = (int)$_GET['id'];
$name = $_GET['name'];
$dbSell = new DBSell();
$selRes = $dbSell->getSellById($id);
$dbProduct = new DBProduct();
?>
<html>
<head>
    <title>PHP-CRUD-VIEW-USER-TRANSACTION</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body <body style="font-family: serif;color: black">
<?php include "includes/nav-admin.php"; ?>
<img src="images/user3.jpg">
<div class="container">
    <br/>
    <button style="background: black;color: white;font-family: serif;" class="form-control btn-success">Transaction Reports For User
        : <?php echo $name ?></button>
    <?php
    if ($msg != "") {
        echo '<div class="alert alert-danger">' . $msg . '</div>';
    }
    ?>
    <table class="table table-striped table-bordered table-hover">
        <tr align="center">
            <th>Product ID</th>
            <th>Product Category</th>
            <th>Product sub-Category</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th>Date</th>
        </tr>
        <?php foreach ($selRes as $sr) { ?>

            <?php $proRes = $dbProduct->getProductById($sr['productId']); ?>

            <tr align="center">
                <td><?php echo $proRes['id'] ?></td>
                <td><?php echo $proRes['category'] ?></td>
                <td><?php echo $proRes['subCategory'] ?></td>
                <td><?php echo $proRes['productName'] ?></td>
                <td><?php echo $proRes['afterDiscount'] ?></td>
                <td><?php echo $sr['quantity'] ?></td>
                <td><?php echo $sr['cost'] ?></td>
                <td><?php echo $sr['date'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
<br/>
<br/>
<?php include "includes/footer.php" ?>
</body>
</html>
