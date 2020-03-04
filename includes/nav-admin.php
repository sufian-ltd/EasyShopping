<nav class="btn-lg" style="background: black;font-size: 18px;">
    <div class="container">
        <div class="navbar-collapse">
            <h4 align="center" style="color: #ffff00;font-size: 20px;font-weight: bold"><span class="glyphicon glyphicon-globe"></span> EASY Shopping</h4>
            <!--            <a style="color: #ffffff;font-size: 20px" class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-globe"></span> EASY Shopping</a>-->
        </div>
        <ul class="nav navbar-nav" >
            <li><a style="color: #009eff" href="admin-section.php" class="active"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a style="color: #009eff" href="about.php"><span class="glyphicon glyphicon-phone-alt"></span> About</a></li>
            <li><a style="color: #009eff" href="admin-add-product.php"> <span class="glyphicon glyphicon-floppy-saved"></span> Add Product</a></li>
            <li><a style="color: #009eff" href="admin-view-product.php"> <span class="glyphicon glyphicon-leaf"></span> View Product</a></li>
            <li><a style="color: #009eff" href="admin-view-sell.php"> <span class="glyphicon glyphicon-usd"></span> View Sell</a></li>
            <li><a style="color: #009eff" href="admin-view-user.php"><span class="glyphicon glyphicon-user"></span> View User</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['USER_TYPE'])=="admin"){ ?>
                <li><a style="color: #009eff" href="admin-logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <?php }else {?>
            <li><a style="color: #009eff" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php }?>
        </ul>
    </div>
</nav>