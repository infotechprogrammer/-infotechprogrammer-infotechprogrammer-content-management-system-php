<?php include "includes/admin_header.php"; ?>
    <div id="wrapper">
        <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome Admin    
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    
                    </div>
                </div>
               


<div class="row" align="center">
    <div class="col-lg-4"></div>

    <div class="col-lg-4">
    
<form method="post" action="">
    <div class="form-group">
        <h4 class="text-warning"><b>Old Password</b></h4>
        <input type="password" class="form-control" name="pass" placeholder="Enter your old password" autocomplete="on">
    </div>
        <div class="form-group">
        <h4 class="text-primary"><b>New Password</b></h4>
        <input type="password" class="form-control" name="new_pass" placeholder="Enter your new password" autocomplete="on">
    </div>
        <div class="form-group">
        <h4 class="text-success"><b>Confirm New Password</b></h4>
        <input type="password" class="form-control" name="confirm_pass" placeholder="Enter new password again" autocomplete="on">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="check_pass" value="Submit">
    </div>
    
</form>

    </div> 

    <div class="col-lg-4"></div>
</div>

<?php

if(isset($_POST['check_pass'])){

$password = $_POST['pass'];


$query = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] ."' ";
$select_user_query = mysqli_query($connection, $query);
if(!$select_user_query){ die("QUERY FAILED". mysqli_error($connection)); }
$row = mysqli_fetch_array($select_user_query);
$db_user_password = $row['user_password'];

if(password_verify($password,$db_user_password) OR $password !== ''){
if($_POST['new_pass'] == ''){
    echo "<h4 style='color:red;' align='center'>The New Password field is empty !</h3>";
}else{
if($_POST['new_pass'] !== $_POST['confirm_pass']){
                    echo "<h3 style='color:red;' align='center'>The Confirmed Password is not same !</h3>";
                }

if($_POST['new_pass'] === $_POST['confirm_pass']){


            $password = $_POST['new_pass'];

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

            $query = "UPDATE users SET user_password = '{$hashedPassword}' WHERE username = '" . $_SESSION['username'] ."' ";

            $execute_change_password_query = mysqli_query($connection,$query) or die("ERROR IN QUERY" . mysqli_error($connection));

            if($execute_change_password_query){
?>
<script type="text/javascript">
    alert("Your password is changed now");
    window.location.href = "index.php";
</script>
<?php
            }

            }
}
}else{
    echo "<h3 style='color:red;' align='center'>Old Password is incorrect</h3>";
}

}

?>








           </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>