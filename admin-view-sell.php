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
    require_once "database/DBUser.php";
    $msg = "";
    $dbSell = new DBSell();
    $dbProduct=new DBProduct();
    $dbUser=new DBUser();
    if(isset($_GET['allTransaction'])){
        $sellRes=$dbSell->getSellById($_GET['id']);
    }
    else {
        $sellRes=$dbSell->getSells();
    }
?>
<html>
<head>
    <title>PHP-CRUD-VIEW-SELL</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body <body style="font-family: serif;color: black">

<?php include "includes/nav-admin.php"; ?>
<img src="images/admin2.jpg">

<div class="container">
    <br/>
    <button style="background: black;color: #ffffff;font-family: serif" class="form-control btn-success">Customer Transaction Sells Reports</button>
    <?php
    if ($msg != "") {
        echo '<div class="alert alert-danger">' . $msg . '</div>';
    }
    ?>
    <table class="table table-striped table-bordered table-hover">
        <tr align="center">
            <th>Customer Name</th>
            <th>Customer Contact</th>
            <th>Product Category</th>
            <th>Product Sub-Category</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php foreach($sellRes as $re) { ?>
            <?php $proRes=$dbProduct->getProductById($re['productId']);
            $userRes=$dbUser->getUser($re['userId']);?>
            <tr align="center">
                <td><?php echo $userRes['name'] ?></td>
                <td><?php echo $userRes['contact'] ?></td>
                <td><?php echo $proRes['category'] ?></td>
                <td><?php echo $proRes['subCategory'] ?></td>
                <td><?php echo $proRes['productName'] ?></td>
                <td><?php echo $re['quantity'] ?></td>
                <td><?php echo $re['cost'] ?></td>
                <td><?php echo $re['date'] ?></td>
                <td>
                    <?php echo "<a class='btn btn-success' href='admin-view-sell.php?action=allTransaction&id=" . $re['userId'] . "'>All Transaction</a>"; ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<br/>
<br/>
<?php include "includes/footer.php" ?>
</body>
</html>
