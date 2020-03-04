<!DOCTYPE html>
<?php
    session_start();
    if(isset($_SESSION['USER_TYPE'])!="admin"){
        header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
        exit();
    }
    include "database/DBProduct.php";
    $msg = "";
    //read distinct category
    $dbProduct=new DBProduct();


    if (isset($_POST['add'])) {
        $selectedCategory = $_POST['selectCategory'];
        $newCategory = $_POST['newCategory'];
        $selectedSubCategory = $_POST['selectSubCategory'];
        $newSubCategory = $_POST['newSubCategory'];
        $productName = $_POST['productName'];
        $afterDiscount = $_POST['afterDiscount'];
        $beforeDiscount = $_POST['beforeDiscount'];
        $image = $_FILES['image']['tmp_name'];
        if(!empty($image))
            $image = file_get_contents($image);
        $quantity = $_POST['quantity'];
        $category = "";
        $subCategory = "";
        if ($selectedCategory == "nothing" && empty($newCategory)) {
            $msg = "Please select a category or add new category";
        }
        if ($selectedSubCategory == "nothing" && empty($newSubCategory)) {
            $msg = $msg . "<br/>Please select a category or add new category";
        }
        if (empty($productName)) {
            $msg = $msg . "<br/>Product name must be required";
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
            if ($selectedCategory == "nothing" && $newCategory == "") {
                $msg = "Please confirm category.You can select category or add new category.";
            }
            if ($selectedSubCategory == "nothing" && $newSubCategory == "") {
                $msg = $msg . "<br/>Please confirm sub-category.You can select sub-category or add new sub-category.";
            }
            if ($msg == "") {
                if ($selectedCategory != "nothing") {
                    $category = $selectedCategory;
                } else {
                    $category = $newCategory;
                }
                if ($selectedSubCategory != "nothing") {
                    $subCategory = $selectedSubCategory;
                } else {
                    $subCategory = $newSubCategory;
                }
                if($dbProduct->addProduct($category, $subCategory, $productName, $afterDiscount, $beforeDiscount, $image, $quantity)){
                    $msg="This product is successfully added";
                }
            }

        }
    }
?>
<html>
<head>
    <title>PHP-CRUD-ADD-PRODUCT</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body style="font-family: serif;color: white;">

<?php include "includes/nav-admin.php"; ?>
<br>
<div align="center" class="">

    <form action="admin-add-product.php" method="post"
      style="width: 500px;border: double;border-color: black;padding: 15px" enctype="multipart/form-data">
        <div class="input-group">
            <?php
            if ($msg != "") {
                echo '<div class="alert alert-danger">' . $msg . '</div>';
            }
            ?>
        </div>
        <button style="background: black;color: #ffffff;font-family: serif;font-size: 15px" class="form-control btn-primary">Please Fill The Specific Field</button>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <select class="form-control" name="selectCategory">
                <option value="nothing">Select Category</option>
                <?php foreach ($dbProduct->getCategories() as $values) {?>
                    <option value="<?php echo $values['category']?>"><?php echo $values['category']?></option>
                <?php }?>
            </select>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <input type="text" class="form-control" name="newCategory" id="newCategory1"
                   placeholder="Or Add New Category : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <select class="form-control" name="selectSubCategory">
                <option value="nothing">Select Sub-category</option>
                <?php foreach ($dbProduct->getSubCategories() as $values) {?>
                    <option value="<?php echo $values['subCategory']?>"><?php echo $values['subCategory']?></option>
                <?php }?>
            </select>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <input type="text" class="form-control" name="newSubCategory" id="newSubCategory1"
                   placeholder="Or Add New Sub-Category : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <input type="text" class="form-control" name="productName" id="productName1"
                   placeholder="Enter Product Name : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <input type="number" class="form-control" name="afterDiscount" id="afterDiscount1"
                   placeholder="Enter price after discount : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <input type="number" class="form-control" name="beforeDiscount" id="beforeDiscount1"
                   placeholder="Enter price before discount : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <input type="file" class="form-control" name="image" id="image"/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
            <input type="number" class="form-control" name="quantity" id="quantity1"
                   placeholder="Enter Product Quantity"/>
        </div>
        <br/>
        <div class="form-group">
            <button name="add" style="width: 465px" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> Add Product
            </button>
        </div>
    </form>
</div>
<br/>
<br/>
<?php include "includes/footer.php" ?>
</body>
</html>