<?php
    session_start();
    if(isset($_SESSION['USER_TYPE'])!="user"){
        header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP-CRUD-USER</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<?php include "includes/nav-user.php";?>
<?php
if(isset($_SESSION['USER_TYPE'])=="user")
{
    if(isset($_POST["delete"]))
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_POST["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
//                echo '<script>alert("Item Removed")</script>';
//                echo '<script>window.location="my-cart.php"</script>';
            }
        }
    }
    if(isset($_POST["update"]))
    {

        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_POST["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'item_id' => $_POST["id"],
                    'item_name' => $_POST["name"],
                    'item_price' => $_POST["price"],
                    'item_quantity' => $_POST["quantity"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
            }
        }
    }
}
?>
<?php
    require_once "database/DBUser.php";
    require_once "database/DBSell.php";
    $msg = "";
    $dbUser = new DBUser();
    $email=$_SESSION['USER_EMAIL'];
    $password=$_SESSION['USER_PASSWORD'];
    $userRes = $dbUser->getUserByEmailPass($email,$password);
    $dbSell=new DBSell();
?>
<body style="font-family: serif;color: black">
<div class="container">
    <img align="center" width="1140" height="220" src="images/temp2.jpg">
    <button style="background: black;color: #ffffff;font-family: serif;font-size: " class="form-control btn-primary">The List of Added cart product</button>
    <table class="table table-striped table-bordered table-hover">
        <tr align="center">
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Cost</th>
            <th>Action</th>
        </tr>
        <?php
        if(!empty($_SESSION["shopping_cart"]))
        {
            $total = 0;
            $sum=0;
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                ?>
                <form action="my-cart.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $values["item_id"]; ?>">
                    <input type="hidden" name="name" value="<?php echo $values["item_name"]; ?>">
                    <input type="hidden" name="price" value="<?php echo $values["item_price"]; ?>">
                    <tr align="center">
                        <td><?php echo $values["item_id"]; ?></td>
                        <td><?php echo $values["item_name"]; ?></td>
<!--                        <td>--><?php //echo '<img width="100" height="100" src="data:image/jpg;base64,' . base64_encode($values['image']) . '">' ?><!--</td>-->
                        <td><?php echo $values["item_price"]; ?> TK</td>
                        <td>
                            <input class="btn btn-default" style="width: 75px;height: 30px" name="quantity" type="number" value="<?php echo $values["item_quantity"]; ?>">
                        </td>
                        <td><?php echo number_format((int)$values["item_quantity"] * (int)$values["item_price"], 2);?> TK</td>
                        <td>
                            <input name="delete" type="submit" class="btn btn-danger" value="Delete">
                        </td>
                    </tr>
                    <?php
                    $total = $total + ((int)$values["item_quantity"] * (int)$values["item_price"]);
                    $sum=$sum+(int) $values["item_quantity"];
                }
                ?>
                <tr align="center">
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td><?php echo $sum ?></td>
                    <td><?php echo number_format($total, 2); ?> TK</td>
                        <td>
                            <input name="update" type="submit" class="btn btn-success" value="Update">
                        </td>
                </tr>
            </form>
            <?php
        }
        ?>
    </table>
    <div align="center">
        <br/>
        <img align="center" width="800" height="180" src="images/about2.jpg">
    </div>
    <button class="center-block form-control btn" style="background: black;color: #ffffff;font-family: serif;font-size: ;width: 800px;">Please Confirm Your Order Details & Contact Information</button>
    <form action="my-order.php" method="post">
    <table align="center" class="table table-bordered table-striped" style="width: 800px">
        <tr align="center">
            <th>Customer Information</th>
            <th>Delivery System</th>
            <th>Payment System</th>
        </tr>
        <tr align="left">
            <td width="20%">
                <?php
                    echo "User Id : ".$userRes['id']."<br/>";
                    echo "Name : ".$userRes['name']."<br/>";
                    echo "Email : ".$userRes['email']."<br/>";
                    echo "Contact : ".$userRes['contact']."<br/>";
                    echo "Address : ".$userRes['address']."<br/><br/>";
                    echo "<p>(If everything is okay then you can checkout)</p>";
                ?>
            </td>
            <input type="hidden" name="id" value="<?php echo $userRes['id']?>">
            <input type="hidden" name="name" value="<?php echo $userRes['name']?>">
            <td width="36%">
                <input type="radio" name="deliveryType" checked="checked" value="Free Shipping"> Free Shipping
                <p>(It's totally free shipping service for product delivery)</p>
                <input type="radio" name="deliveryType" value="Local Delivery (Free)"> Local Delivery (Free)
                <p>(We don't take any local delivery cost.It's a totally free service)</p>
                <input type="radio" name="deliveryType" value="Local Pickup (Free)"> Local Pickup (Free)
                <p>(You can also pickup your product locally.Our customer service center is always available.)</p>
            </td>
            <td width="44%">
                <input type="radio" name="paymentType" checked="checked" value="DIRECT BANK TRANSFER"> DIRECT BANK TRANSFER
                <p>(Make your payment directly into our bank account. Please use your Order ID as the
                    payment reference. Your order won’t be shipped until the funds have cleared in our account.)</p>
                <input type="radio" name="paymentType" value="CHEQUE PAYMENT"> CHEQUE PAYMENT
                <p>(Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.)</p>
                <input type="radio" name="paymentType" value="CASH ON DELIVERY"> CASH ON DELIVERY
                <p>(Pay with cash upon delivery.)</p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <button style="width: 200px;" name="checkout" type="submit" class="center-block btn btn-danger"">Proceed To Checkout</button>
    </form>
</div>
<br/>
<br/>
<?php include "includes/footer.php" ?>
</body>
</html>