<?php
session_start();
if(isset($_SESSION['USER_TYPE'])!="user"){
    header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
    exit();
}
?>
<!DOCTYPE html>
<?php
    require_once "database/DBSell.php";
    require_once "database/DBOrder.php";
    require_once "database/DBUser.php";
    $msg = "";
    $dbSell=new DBSell();
    $dbOrder=new DBOrder();
    $dbUser=new DBUser();
    if(isset($_POST['checkout']))
    {
        $userId=$_POST['id'];
        $userName=$_POST['name'];
        $delivery=$_POST['deliveryType'];
        $payment=$_POST['paymentType'];
        echo "delivery : ".$delivery;
        echo "payment : ".$payment;
        if(empty($_SESSION['shopping_cart']) || empty($delivery) || empty($payment)){
            $msg="You billing information is not clear for checkout or empty shopping cart...!!<br/>
                   Please go back your cart and try again....";
        }
        $date=date("Y/m/d");
        $totalProduct=0;
        $totalCost=0;
        if($msg=="") {
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                $productId = $values["item_id"];
                $quantity = $values["item_quantity"];
                $totalProduct = $totalProduct + $quantity;
                $cost = $values["item_price"] * $quantity;
                $totalCost = $totalCost + $cost;
                if ($dbSell->saveSells($productId, $userId, $quantity, $cost, $date)) {
                    $msg = "Thanks For Your Orders....!!!!!!!<br/>Your orders are successfully sent to specific authority";
                }
            }
            $dbOrder->saveOrder($userId, $userName, $totalProduct, $totalCost, $delivery, $payment, $date);
            unset($_SESSION['shopping_cart']);
        }
    }

    $email=$_SESSION['USER_EMAIL'];
    $password=$_SESSION['USER_PASSWORD'];
    $userRes=$dbUser->getUserByEmailPass($email,$password);
    $userId=$userRes['id'];
    $orderRes=$dbOrder->getOrderById($userId);
?>
<html>
<head>
    <title>PHP-CRUD-VIEW-SELL</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body <body style="font-family: serif;color: black ">

<?php include "includes/nav-user.php"; ?>
<img src="images/home2.jpg">
<div class="container">
    <br/>

    <button style="background: black;color: #ffffff;font-family: serif" class="form-control btn-success">My Products Order Reports</button>
    <?php
    if ($msg != "") {
        echo '<div class="alert alert-danger">' . $msg . '</div>';
    }
    ?>
    <table class="table table-striped table-bordered table-hover">
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Total Product</th>
            <th>Total Cost</th>
            <th>Delivery System</th>
            <th>Payment System</th>
            <th>Date of Purchase</th>
            <th>Action</th>
        </tr>
        <?php foreach($orderRes as $or1) { ?>
            <tr align="center">
                <td><?php echo $or1['userId'] ?></td>
                <td><?php echo $or1['userName'] ?></td>
                <td><?php echo $or1['totalProduct'] ?></td>
                <td><?php echo $or1['totalCost'] ?></td>
                <td><?php echo $or1['delivery'] ?></td>
                <td><?php echo $or1['payment'] ?></td>
                <td><?php echo $or1['date'] ?></td>
                <td>
                    <?php echo "<a class='btn btn-primary' href='my-order-details.php?action=view&id=".$or1['userId']."&name=".$or1['userName']."&date=".$or1['date']."'>View Details</a>"; ?>
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
