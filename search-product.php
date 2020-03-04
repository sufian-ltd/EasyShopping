<?php session_start(); ?>
<?php
    include "database/DBProduct.php";
    $dbProduct = new DBProduct();
    $msg="";
    if (isset($_POST['search'])) {
        $key=$_POST['key'];
        $proRes=$dbProduct->searchProduct($key);
    } else {
        $proRes = $dbProduct->getProducts();
    }
?>
<?php
if (isset($_POST['addToCart'])) {
    if (isset($_SESSION['USER_TYPE']) == "user") {
        if (isset($_SESSION["shopping_cart"])) {
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
            if (!in_array($_POST["id"], $item_array_id)) {
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'item_id' => $_POST["id"],
                    'item_name' => $_POST["name"],
                    'item_price' => $_POST["price"],
                    'item_quantity' => $_POST["quantity"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                $msg="This product is successfully added to cart..!!!!";
            } else {
                $msg="This Item is Already Added to cart...!!!!";
            }
        } else {
            $item_array = array(
                'item_id' => $_POST["id"],
                'item_name' => $_POST["name"],
                'item_price' => $_POST["price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][0] = $item_array;
            $msg="This product is successfully added to cart..!!!!";
        }
    } else {
        header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP-CRUD-USER-VIEW-CATEGORY</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body style="font-family: serif;font-weight:">
<?php include "includes/nav-user.php"; ?>
<img src="images/home2.jpg" style="width: 100%;">
<div class="center-block" style="width: 500px;">
    <?php
    if ($msg != "") {
        echo '<div class="alert alert-danger">' . $msg . '</div>';
    }
    ?>
    <br/>
    <form action="" method="post">
        <table align="center" class="container-fluid" style="width: 600px;">
            <tr>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        <input class="form-control" name="key" type="text"
                               placeholder="I'm shopping for.........">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <button type="submit" name="search" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Search</button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
    <br/>
</div>
<div style="margin: 10px;">
    <div class="row">
        <?php foreach ($proRes as $pr) { ?>
            <form action="" method="post">
                <div class="col-sm-2">
                    <div class="thumbnail">
                        <?php echo '<img width="242" height="250" src="data:image/jpg;base64,' . base64_encode($pr['image']) . '">' ?>
                        <div align="center" class="caption">
                            <h4 style="color: black;font-weight: bold"><?php echo $pr['productName'] ?></h4>
                            <span style="color: #167a00;font-weight: ">After Discount : <?php echo $pr['afterDiscount'] ?> tk</span>
                            <del style="color: #ff0002;font-weight: ">Before Discount : <?php echo $pr['beforeDiscount'] ?> tk</del>
                            <input type="hidden" name="id" value="<?php echo $pr['id'] ?>">
                            <input type="hidden" name="name" value="<?php echo $pr['productName'] ?>">
                            <input type="hidden" name="price" value="<?php echo $pr['afterDiscount'] ?>">
                            <div class="form-group">
                                <input class="form-control btn btn-default" style="width: 93px;height: 30px" name="quantity" type="number" placeholder="Quantity:"
                                       value="1">
                            </div>
                            <button type="submit" name="addToCart" class='btn btn-danger'><i class="glyphicon glyphicon-shopping-cart"></i> Add To Cart</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<?php include "includes/footer.php" ?>
</body>
</html>