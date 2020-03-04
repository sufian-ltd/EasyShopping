<?php
    session_start();
    if(isset($_SESSION['USER_TYPE'])!="admin"){
        header('Location: http://localhost/LearningPHP/CRUD-PHP/login.php');
        exit();
}
?>
<!DOCTYPE html>
<?php
    require_once "database/DBUser.php";
    require_once "database/DBSell.php";
    $msg = "";
    $dbUser = new DBUser();
    $userRes = $dbUser->getUsers();
    $dbSell=new DBSell();
?>
<html>
<head>
    <title>PHP-CRUD-VIEW-SELL</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body <body style="font-family: serif;color: black ">

<?php include "includes/nav-admin.php"; ?>
<img src="images/mid3.jpg">
<br/>
<div class="container">
    <button style="background: black;color: #ffffff;font-family: serif" class="form-control btn-success">The List of Available Users</button>
    <?php
    if ($msg != "") {
        echo '<div class="alert alert-danger">' . $msg . '</div>';
    }
    ?>
    <table class="table table-striped table-bordered table-hover">
        <tr align="center">
            <th>ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Total Product</th>
            <th>Total Cost</th>
            <th>Action</th>
        </tr>
        <?php foreach ($userRes as $ur) { ?>

            <?php $totalPro=$dbSell->getTotalProduct($ur['id']);
            $totalCost=$dbSell->getTotalCost($ur['id']);?>

            <tr align="center">
                <td><?php echo $ur['id'] ?></td>
                <td><?php echo $ur['name'] ?></td>
                <td><?php echo $ur['email'] ?></td>
                <td><?php echo $ur['contact'] ?></td>
                <td><?php echo $ur['address'] ?></td>
                <td><?php echo $totalPro ?></td>
                <td><?php echo $totalCost ?></td>
                <td>
                    <?php echo "<a class='btn btn-success' href='admin-view-user-transaction.php?id=".$ur['id']."&name=".$ur['name']."'>View Transaction</a>"; ?>
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
