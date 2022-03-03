<?php


if(isset($_POST['create_post'])){

$post_user = $_POST['post_user'];
$post_title = $_POST['title'];
$post_category_id = $_POST['post_category'];
$post_status = $_POST['post_status'];

$post_image = $_FILES['image']['name'];
$post_img_temp = $_FILES['image']['tmp_name'];

$post_tags = $_POST['post_tags'];
$post_content = $_POST['post_content'];
$post_date = date('d-m-y');



move_uploaded_file($post_img_temp, "../images/$post_image");


$query= "INSERT INTO posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) ";

$query .="VALUES('{$post_category_id}','{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

$create_post_query = mysqli_query($connection,$query);

checkerror($create_post_query);

header("Location:post.php");

}


?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label for="title">Post Title</label>
	<input type="text" class="form-control" name="title">
</div>	

<div class="form-group">
<label for="title">Category:</label>
<select name="post_category"> 

<?php
$query= "SELECT * FROM categories";
$select_cateagories= mysqli_query($connection,$query); //It is used at place where you use $result

checkerror($select_cateagories);

while($row = mysqli_fetch_assoc($select_cateagories)){

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];

echo"<option value='$cat_id'>{$cat_title}</option>";
}
?>

</select>	</div>

<div class="form-group">
<label for="users">Users:</label>
<select name="post_user"> 

<?php
$query= "SELECT * FROM users";
$select_users= mysqli_query($connection,$query); //It is used at place where you use $result

checkerror($select_users);

while($row = mysqli_fetch_assoc($select_users)){

$user_id = $row['user_id'];
$username = $row['username'];

echo"<option value='$username'>{$username}</option>";
}
?>

</select>	</div>
<!-- 
<div class="form-group">
	<label for="author">Post Author</label>
	<input type="text" class="form-control" name="author">
</div>	 -->

<!-- <div class="form-group">
	<label for="post_status">Post Status</label>
	<input type="text" class="form-control" name="post_status">
</div> -->	

<div class="form-group">
	<label for="post_status">Post Status</label>
<select name="post_status">
	<option value="draft" name="post_status">Draft</option>
	<option value="published" name="post_status">Publish</option>

</select>
</div>


	<label for="post_image">Post Image</label>
	<input type="file" class="form-control" name="image">

<div class="form-group">
	<label for="post_tags">Post Tags</label>
	<input type="text" class="form-control" name="post_tags">
</div>	

<div class="form-group">
	<label for="post_content">Post Content</label>
	<textarea class="form-control ckeditor" name="post_content" cols="30" rows="10"> </textarea>
</div>	

<div class="form-group">
	<input class="btn btn-primary" type="submit" name="create_post" name="title" value="Publish Post">
</div>	

</div>	
</form>