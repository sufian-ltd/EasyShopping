<nav class="btn-lg" style="background: black;font-size: 18px;">
    <div class="container">
        <div class="navbar-collapse">
            <h4 align="center" style="color: #ffff00;font-size: 20px;font-weight: bold"><span class="glyphicon glyphicon-globe"></span> EASY Shopping</h4>
<!--            <a style="color: #ffffff;font-size: 20px" class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-globe"></span> EASY Shopping</a>-->
        </div>
        <ul class="nav navbar-nav" >
            <?php if(isset($_SESSION['USER_TYPE'])=="user"){ ?>
                <li><a style="color: #009eff" href="user-section.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <?php } else {?>
                <li><a style="color: #009eff" href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <?php } ?>
            <li><a style="color: #009eff" href="about.php"><span class="glyphicon glyphicon-phone-alt"></span> About</a></li>
            <li><a style="color: #009eff" href="search-product.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
            <li><a style="color: #009eff" href="view-product.php"><span class="glyphicon glyphicon-leaf"></span> Products</a></li>
            <?php if(isset($_SESSION['USER_TYPE'])=="user"){ ?>
                <li><a style="color: #009eff" href="my-cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
                <li><a style="color: #009eff" href="my-order.php"><span class="glyphicon glyphicon-credit-card"></span> My Order</a></li>
            <?php } ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['USER_TYPE'])=="user"){ ?>
                <li class="active"><a style="color: #009eff" href="my-profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                <li><a style="color: #009eff" href="user-logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            <?php } else {?>
                <li><a style="color: #009eff" href="registration.php"><span class="glyphicon glyphicon-log-in"></span> Sign Up</a></li>
                <li><a style="color: #009eff" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php }?>
        </ul>
    </div>
</nav>