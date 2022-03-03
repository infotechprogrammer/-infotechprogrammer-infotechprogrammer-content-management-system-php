<?php include "includes/admin_header.php"; ?>

<?php 

if(isset($_POST['update_profile'])){


$changed_user_firstname = $_POST['user_firstname'];
$changed_user_lastname = $_POST['user_lastname'];
$changed_username = $_POST['username'];

// // $post_image = $_FILES['image']['name'];
// // $post_img_temp = $_FILES['image']['tmp_name'];

$changed_user_email = $_POST['user_email'];

// move_uploaded_file($post_img_temp, "../images/$post_image");

// if(empty($post_image)){

// $query = "SELECT * FROM posts WHERE post_id=$post_id_upd";
// $select_image =  mysqli_query($connection,$query)or die( mysqli_error($connection));

// while ($row = mysqli_fetch_array($select_image)) {
	
// 	$post_image = $row['post_image'];
// }	

// }


$query= "UPDATE users SET user_firstname='{$changed_user_firstname}', user_lastname='{$changed_user_lastname}', username='{$changed_username}', user_email='{$changed_user_email}' WHERE username= '" . $_SESSION['username'] ."' ";

$update_profile_query = mysqli_query($connection,$query);

if($update_profile_query){

$query_category = mysqli_query($connection,"UPDATE categories SET cat_user= '{$changed_username}' WHERE cat_user = '" . $_SESSION['username'] ."'");
$query_post = mysqli_query($connection,"UPDATE posts SET post_user= '{$changed_username}' WHERE post_user = '" . $_SESSION['username'] ."'");

}

$_SESSION['username'] = $changed_username;
$_SESSION['firstname'] = $changed_user_firstname;
$_SESSION['lastname'] = $changed_user_lastname;
checkerror($update_profile_query);
header("Location:profile.php");

}

?>



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
<?php

if(isset($_SESSION['username'])){

$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username ='{$username}' ";

$select_user_profile_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($select_user_profile_query)) {

$user_id = $row['user_id'];
$username = $row['username'];
$user_password = $row['user_password'];
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];
$user_email = $row['user_email'];
$user_image = $row['user_image'];
    
}



?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
</div>  

<div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
</div>      

<!--    <label for="user_image">User Image</label>
    <input type="file" class="form-control" name="image"> -->

<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username"  value="<?php echo $username; ?>">
</div>  

<div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
</div>  

<div class="form-group text-center">
    <input class="btn btn-success" type="submit" name="update_profile" value="Update Profile">
</div>  
<h5><b>Notice:</b> You can change your old password by going to Forgot Password</h5>
</div>
</form>

<?php } ?>




                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
