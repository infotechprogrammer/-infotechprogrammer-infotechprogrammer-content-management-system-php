<?php

if(isset($_GET['upd'])){

$user_id_upd=escape($_GET['upd']);

}else{

header("Location:index.php");
}

$query= "SELECT * FROM users WHERE user_id=$user_id_upd";
$select_users_update = mysqli_query($connection,$query); //It is used at place where you use $result

while($row = mysqli_fetch_assoc($select_users_update)){

$username = $row['username'];
$password = $row['user_password'];
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];
$user_email = $row['user_email'];
$user_image = $row['user_image'];
$user_role = $row['user_role'];
?>

<form action="" method="post">

<div class="form-group">
	<label for="user_password">Username:</label><><?php echo "{$_SESSION['username']}"; ?></p>
</div>	

<div class="form-group">
	<label for="user_password">Password</label>
	<input type="password" class="form-control" name="user_password">
</div>	

<div class="form-group">
	<input class="btn btn-primary" type="submit" name="update_user" value="Update User">
</div>	

</div>
</form>	
<?php } ?>
<?php 

if(isset($_POST['update_user'])){


$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_role = $_POST['user_role'];
$username = $_POST['username'];

// // $post_image = $_FILES['image']['name'];
// // $post_img_temp = $_FILES['image']['tmp_name'];

$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

// move_uploaded_file($post_img_temp, "../images/$post_image");

// if(empty($post_image)){

// $query = "SELECT * FROM posts WHERE post_id=$post_id_upd";
// $select_image =  mysqli_query($connection,$query)or die( mysqli_error($connection));

// while ($row = mysqli_fetch_array($select_image)) {
	
// 	$post_image = $row['post_image'];
// }	

// }

// $query = "SELECT randSalt FROM users";
// $select_randsalt_query = mysqli_query($connection,$query) or die("QUERY FAILED" . mysqli_error($connection));
// $row = mysqli_fetch_array($select_randsalt_query);
// $salt = $row['randSalt'];
// $encrypted_password = crypt($user_password, $salt);
 
if(!empty($user_password)){


if($password != $user_password){

$encrypted_password = $encpassword = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => 10));

}

$query= "UPDATE users SET user_firstname='{$user_firstname}', user_lastname='{$user_lastname}', user_role='{$user_role}', username='{$username}', user_email='{$user_email}', user_password='{$encrypted_password}' WHERE user_id= {$user_id_upd}";

$update_user_query = mysqli_query($connection,$query);

checkerror($update_user_query);
header("Location:users.php");

}if(empty($user_password)){

$query= "UPDATE users SET user_firstname='{$user_firstname}', user_lastname='{$user_lastname}', user_role='{$user_role}', username='{$username}', user_email='{$user_email}', user_password='{$password}' WHERE user_id= {$user_id_upd}";

$update_user_query = mysqli_query($connection,$query);

checkerror($update_user_query);
header("Location:users.php");


}




}

?>