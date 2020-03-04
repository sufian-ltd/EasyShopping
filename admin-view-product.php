<?php
    session_start();
    if (isset($_SESSION['USER_TYPE']) != "admin") {
        header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
        exit();
    }
?>
<!DOCTYPE html>
<?php
    include "database/DBProduct.php";
    $msg = "";
    $dbProduct = new DBProduct();
    $proRes=$dbProduct->getProducts()
?>
<?php
    if(isset($_POST['search']))
    {
        $key=$_POST['key'];
        $proRes=$dbProduct->searchProduct($key);
    }
?>
<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $productName = $_POST['productName'];
    $afterDiscount = $_POST['afterDiscount'];
    $beforeDiscount = $_POST['beforeDiscount'];
    $image = $_FILES['image']['tmp_name'];
    if (!empty($image))
        $image = file_get_contents($image);
    $quantity = $_POST['quantity'];
    if (empty($productName)) {
        $msg = $msg . "Product name must be required";
    }
    if (empty($beforeDiscount)) {
        $msg = $msg . "<br/>Before discount must be required";
    }
    if (empty($afterDiscount)) {
        $msg = $msg . "<br/>After discount must be required";
    }
    if (empty($quantity)) {
        $msg = $msg . "<br/>Quantity must be required";
    }
    if (empty($image)) {
        $msg = $msg . "<br/>Image must be required";
    }
    if ($msg == "") {
        if ($dbProduct->updateProduct($id, $productName, $afterDiscount, $beforeDiscount, $image, $quantity)) {
            $msg = "Product successfully update..!!!!";
            $proRes=$dbProduct->getProducts();
        }
    }
}
?>
<html>
<head>
    <title>PHP-CRUD-VIEW-PRODUCT</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body
<body style="font-family: serif;color: black">

<?php include "includes/nav-admin.php"; ?>
<img src="images/home1.jpg">
<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    if ($dbProduct->deleteProduct($id)) {
        $msg = "Product successfully deleted...!!!!!!";
        $proRes=$dbProduct->getProducts();
    }
}
?>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = (int)$_GET['id'];
    $result = $dbProduct->getProductById($id);
    ?>
    <div align="center" class="">
        <form action="admin-view-product.php" method="post" enctype="multipart/form-data" style="width: 500px">
            <br/>

            <button style="background: black;color: #ffffff;font-family: serif" class="form-control">Please Fill The Specific
                Field
            </button>
            <br/>
            <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
            <div class="form-group">
                <input type="text" class="form-control" name="productName" id="productName1"
                       value="<?php echo $result['productName'] ?>" placeholder="Enter Product Name :"/>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="afterDiscount" id="afterDiscount1"
                       value="<?php echo $result['afterDiscount'] ?>" placeholder="Enter price after discount : "/>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="beforeDiscount" id="beforeDiscount1"
                       value="<?php echo $result['beforeDiscount'] ?>" placeholder="Enter price before discount : "/>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="image" id="image"/>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="quantity" id="quantity1"
                       value="<?php echo $result['quantity'] ?>" placeholder="Enter Product Quantity"/>
            </div>
            <div class="form-group">
                <input style="width: 500px" type="submit" class="btn btn-success" name="update" value="Click here to Save"/>
            </div>
        </form>
    </div>
<?php } else{ ?>
    <form class=""  action="" method="post">
        <br/>

        <table align="center" style="width: 600px;">
            <tr>
                <td><input class="form-control" name="key" type="text"
                           placeholder="Enter name or category or sub-category"></td>
                <td><input class="btn btn-success" type="submit" name="search" value="Search Product"></td>
            </tr>
        </table>
    </form>
<?php }?>
<div class="container">
    <br/>
    <?php
    if ($msg != "") {
        echo '<div class="alert alert-danger">' . $msg . '</div>';
    }
    ?>
    <button style="background: black;color: #ffffff;font-family: serif;font-size: 15px" class="form-control">The Available Products Added By
        Admin & Specific Authoriry
    </button>

    <table class="table table-striped table-bordered table-hover">
        <tr align="center">
            <th>Category</th>
            <th>Sub-Category</th>
            <th>Product Name</th>
            <th>After Discount</th>
            <th>Before Discount</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
        <?php foreach ($proRes as $values) { ?>
            <tr align="center">
                <td><?php echo $values['category'] ?></td>
                <td><?php echo $values['subCategory'] ?></td>
                <td><?php echo $values['productName'] ?></td>
                <td><?php echo $values['afterDiscount'] ?></td>
                <td><?php echo $values['beforeDiscount'] ?></td>
                <td><?php echo '<img width="100" height="100" src="data:image/jpg;base64,' . base64_encode($values['image']) . '">' ?></td>
                <td><?php echo $values['quantity'] ?></td>
                <td>
                    <?php echo "<a class='btn btn-success' href='admin-view-product.php?action=edit&id=" . $values['id'] . "'>Update</a>"; ?>
                </td>
                <td>
                    <?php echo "<a class='btn btn-danger' href='admin-view-product.php?action=delete&id=" . $values['id'] . "'>Delete</a>"; ?>
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
