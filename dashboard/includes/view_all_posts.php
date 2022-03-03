<?php

if(isset($_POST['checkBoxArray'])){

	foreach ($_POST['checkBoxArray'] as $post_id_ticked) {
	 $bulk_options = $_POST['bulk_options'];

	 switch ($bulk_options) {
	 	case 'published':
	 		
$query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id='$post_id_ticked'";
$update_to_published = mysqli_query($connection,$query) or die(mysqli_error($connection));

	 		break;

	 		case 'draft':
	 		
$query = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id='$post_id_ticked'";
$update_to_draft = mysqli_query($connection,$query) or die(mysqli_error($connection));

	 		break;

	 		case 'delete':
	 		
$query = "DELETE FROM posts WHERE post_id='$post_id_ticked'";
$update_to_delete = mysqli_query($connection,$query) or die(mysqli_error($connection));

	 		break;

	 		case 'clone':
	 		
$query = "SELECT * FROM posts WHERE post_id='$post_id_ticked'";
$select_post_query = mysqli_query($connection,$query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array(
$select_post_query)) {
$post_user = $row['post_user'];
$post_title = $row['post_title'];
$post_category_id = $row['post_category_id'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_content = $row['post_content'];
$post_tags = $row['post_tags'];
$post_date = $row['post_date'];
}


$query= "INSERT INTO posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) ";

$query .="VALUES('{$post_category_id}','{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

$create_post_copy_query = mysqli_query($connection,$query);

checkerror($create_post_copy_query);
	 		break;
	 	
	 	default:
	 		# code...
	 		break;
	 }

		
	}
}

?>

<form action="" method="post">

                
                <table class="table table-bordered table-hover">

<div id="bulkOptionContainer" class="col-xs-4">
	
<select class="form-control" name="bulk_options">
	
<option value="">Select Options</option>
<option value="published">Publish</option>
<option value="draft">Draft</option>
<option value="delete">Delete</option>
<option value="clone">Clone</option>

</select>

</div>

<div class="col-xs-4">
	
<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="post.php?source=add_post">Add New</a>

</div>
<br><br><br>


                	<thead>
                		<tr class="bg-info">
                			<th><input id="selectAllBoxes" type="checkbox"></th>
                			<th>ID</th>
                			<th>User</th>
                			<th>Title</th>
                			<th>Category</th>
                			<th>Post Content</th>
                			<th>Status</th>
                			<th>Image</th>
                			<th>Tags</th>
                			<th>Comments</th>
                			<th>Date</th>
                			<th>View Post</th>
                			<th>DELETE</th>
                			<th>UPDATE</th>
                			<th>Post Likes</th>
                			<th>Post Viwes</th>
                		</tr>
                	</thead>

                <tbody>
 
<?php 

// $query= "SELECT * FROM posts ORDER BY post_id DESC";
$query = "SELECT posts.post_id, posts.post_user, posts.post_title, posts.post_category_id, posts.post_content, posts.post_status, posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, posts.likes, categories.cat_id, categories.cat_title FROM posts LEFT JOIN categories ON posts.post_category_id  = categories.cat_id WHERE post_user = '" . $_SESSION['username'] ."' ORDER BY posts.post_id DESC";

$select_posts = mysqli_query($connection,$query) or die(mysqli_error($connection)); //It is used at place where you use $result

while($row = mysqli_fetch_assoc($select_posts)){

$post_id = $row['post_id'];
$post_user = $row['post_user'];
$post_title = $row['post_title'];
$post_category_id = $row['post_category_id'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_content = $row['post_content'];
$post_tags = $row['post_tags'];
$post_date = $row['post_date'];
$post_views_count = $row['post_views_count'];
$likes = $row['likes'];
$cat_title = $row['cat_title'];
$cat_id = $row['cat_id'];

$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
$send_comment_query = mysqli_query($connection,$query);
$count_comments = mysqli_num_rows($send_comment_query);

$post_comment_count = $row['post_comment_count'];

?><tr>

<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
<?php
echo "<td> {$post_id} </td>";
	
echo "<td> {$post_user} </td>";

echo "<td> <a href='../post.php?p_id=$post_id'> {$post_title} </a> </td>";

// $query= "SELECT * FROM categories WHERE cat_id={$post_category_id}";
// $select_cateagories_update = mysqli_query($connection,$query); //It is used at place where you use $result

// while($row = mysqli_fetch_assoc($select_cateagories_update)){

// $cat_id = $row['cat_id'];
// $cat_title = $row['cat_title'];

echo "<td> {$cat_title} </td>";

// }

echo "<td> {$post_content} </td>";
echo "<td> {$post_status} </td>";
?>
<td> <img class='img-responsive' src='../images/<?php echo img_placeholder($post_image); ?>' alt='image' width='100px'></td>
<?php
echo "<td> {$post_tags} </td>";
echo "<td> <a href='post_comments.php?id=$post_id'> {$count_comments} </a> </td>";
echo "<td> {$post_date} </td>";
echo "<td><a class='btn btn-info' href='../post.php?p_id=$post_id'>Open Post</a></td>";
?>
<script type="text/javascript">
	function del(){
confirm("Do you really want to delete this post then Press OK");
	}
</script>
<form method="post">

<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
<?php
echo '<td><input class="btn btn-danger delete_link" type="submit" name="delete" value="Delete" onClick="return del()"></td>';
?>

	<!-- <a  rel='$post_id' href='' class='btn btn-danger delete_link' data-toggle='modal' data-target='#deletepostModal'> DELETE </a> -->
</form>

<?php
//It is javascript applied in href tag: echo "<td><a class='btn btn-danger' href='post.php?del={$post_id}' onClick=\"javascript: return confirm('Are you sure you want to Delete this post');\"> DELETE </a></td>";
echo "<td><a class='btn btn-success' href='post.php?source=edit_post&upd={$post_id}'> EDIT </a></td>";
echo "<td> $likes </td>";
echo "<td class='text-center'> <a class='btn btn-warning' href='post.php?reset={$post_id}'> Reset Views </a> <br><br>{$post_views_count}</td>";


?>
</tr>	
<?php }?>
</tbody></table>
</form>
 <?php 

if(isset($_POST['delete'])){


$del_post_id= $_POST['post_id'];

$query= "DELETE FROM posts WHERE post_id={$del_post_id} ";
$delete_query_post= mysqli_query($connection,$query);

checkerror($delete_query_post);

header("Location:post.php");

}


if(isset($_GET['reset'])){


$reset_post_id= escape($_GET['reset']);

$query= "UPDATE posts SET post_views_count = 0 WHERE post_id={$reset_post_id} ";
$reset_query_views= mysqli_query($connection,$query);

checkerror($reset_query_views);

header("Location:post.php");

}

?>

<script>
	
$(document).ready(function(){



$(".delete_link").on('click', function(){


var id =$(this).attr("rel");

var delete_url = "post.php?del="+ id +" ";

$(".modal_delete_link").attr("href", delete_url);

});




});


</script>