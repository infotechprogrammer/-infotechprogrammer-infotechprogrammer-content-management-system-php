<?php


if(isset($_POST['create_user'])){

$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_role = $_POST['user_role'];
$username = $_POST['username'];

// $post_image = $_FILES['image']['name'];
// $post_img_temp = $_FILES['image']['tmp_name'];

$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
// $user_date = date('d-m-y');


// move_uploaded_file($post_img_temp, "../images/$post_image");

// $query = "SELECT randSalt FROM users";
// $select_randsalt_query = mysqli_query($connection,$query) or die("QUERY FAILED" . mysqli_error($connection));
// $row = mysqli_fetch_array($select_randsalt_query);
// $salt = $row['randSalt'];
// $encrypted_password = crypt($user_password, $salt);
 
$encrypted_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

$query= "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";

$query .="VALUES('{$user_firstname}','{$user_lastname}', '{$user_role}','{$username}','{$user_email}','{$encrypted_password}') ";

$create_user_query = mysqli_query($connection,$query);

checkerror($create_user_query);

// echo "<h1>User Created:</h1>" . "" . "<a href='users.php'>View Users</a>";

header("Location:users.php");

}


?>
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label for="user_firstname">Firstname</label>
	<input type="text" class="form-control" name="user_firstname">
</div>	

<div class="form-group">
	<label for="user_lastname">Lastname</label>
	<input type="text" class="form-control" name="user_lastname">
</div>	


<select name="user_role"> 

<option value="subscriber">Select Options</option>
<option value="admin">Admin</option>
<option value="subscriber">Subscriber</option>

</select>	

<!-- 	<label for="user_image">User Image</label>
	<input type="file" class="form-control" name="image"> -->

<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username">
</div>	

<div class="form-group">
	<label for="user_email">Email</label>
	<input type="email" class="form-control" name="user_email">
</div>	

<div class="form-group">
	<label for="user_password">Password</label>
	<input type="password" class="form-control" name="user_password">
</div>	

<div class="form-group">
	<input type="submit" class="btn btn-primary" name="create_user" value="Add User">
</div>	

</div>	
</form>