<?php

if(isset($_GET['upd'])){

$post_id_upd=escape($_GET['upd']);

}

$query= "SELECT * FROM posts WHERE post_id=$post_id_upd";
$select_posts_update = mysqli_query($connection,$query); //It is used at place where you use $result

while($row = mysqli_fetch_assoc($select_posts_update)){
	

$post_user = $row['post_user'];
$post_title = $row['post_title'];
$post_category_id = $row['post_category_id'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_content = $row['post_content'];
$post_tags = $row['post_tags'];
$post_comment_count = $row['post_comment_count'];
$post_date = $row['post_date'];
?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
	<label for="title">Post Title</label>
	<input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
</div>	

<div class="form-group">
<label for="title">Category</label>
<select name="post_category"> 

<?php
$query= "SELECT * FROM categories WHERE cat_user='" . $_SESSION['username'] ."'";
$select_cateagories= mysqli_query($connection,$query); //It is used at place where you use $result

checkerror($select_cateagories);

while($row = mysqli_fetch_assoc($select_cateagories)){

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];

if($cat_id == $post_category_id){

echo"<option selected value='$cat_id'>{$cat_title}</option>";

}else {

	echo"<option value='$cat_id'>{$cat_title}</option>";
}


}
?>

</select>


</div>


<div class="form-group">
	<label for="status">Post Status</label>
<select name="status">
	<option value="<?php echo $post_status; ?>" name="status"><?php echo $post_status; ?></option>
	<?php
if($post_status == 'published') {
echo "<option value='draft' name='status'>draft</option>";
}else {
	echo "<option value='published' name='status'>publish</option>";
}

	?>

</select>
</div>


 <img src="../images/<?php echo $post_image; ?>" alt="<?php echo $post_image ?>" width="100px">
 <div class="form-group">
 <input class="form-control" type="file" name="image">
</div>

<div class="form-group">
	<label for="tags">Post Tags</label>
	<input type="text" class="form-control" name="tags" value="<?php echo $post_tags; ?>">
</div>	

<div class="form-group">
	<label for="content">Post Content</label>
	<textarea class="form-control ckeditor" name="content"><?php echo $post_content; ?></textarea>
</div>	

<div class="form-group">
	<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</div>	

</div>	
</form>
<?php } ?>
<?php 

if(isset($_POST['update_post'])){


$post_user = $_SESSION['username'];
$post_title = $_POST['title'];
$post_category_id = $_POST['post_category'];
$post_status = $_POST['status'];

$post_image = $_FILES['image']['name'];
$post_img_temp = $_FILES['image']['tmp_name'];

$post_content = $_POST['content'];
$post_tags = $_POST['tags'];

move_uploaded_file($post_img_temp, "../images/$post_image");

if(empty($post_image)){

$query = "SELECT * FROM posts WHERE post_id=$post_id_upd";
$select_image =  mysqli_query($connection,$query)or die( mysqli_error($connection));

while ($row = mysqli_fetch_array($select_image)) {
	
	$post_image = $row['post_image'];
}	

}

$query= "UPDATE posts SET post_title='{$post_title}', post_category_id='{$post_category_id}', post_date=now(), post_user='{$post_user}', post_status='{$post_status}', post_content='{$post_content}', post_tags='{$post_tags}', post_image='{$post_image}' WHERE post_id= {$post_id_upd}";

$update_post_query = mysqli_query($connection,$query);

checkerror($update_post_query);

header("Location:post.php");
}

?>