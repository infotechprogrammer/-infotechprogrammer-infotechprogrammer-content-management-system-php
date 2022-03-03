<?php
include 'delete_modal.php';
?>
                
                <table class="table table-bordered table-hover">
                	<thead>
                		<tr>
                			<th>ID</th>
                			<th>Author</th>
                			<th>Comment</th>
                			<th>Email</th>
                			<th>Status</th>
                			<th>In Response to</th>
                                         <th>Date</th>
                			<th>Approve</th>
                			<th>Unapprove</th>
                			<th>DELETE</th>
                		</tr>
                	</thead>

                <tbody>
<?php 

$query= "SELECT * FROM comments";
$select_comments = mysqli_query($connection,$query); //It is used at place where you use $result

while($row = mysqli_fetch_assoc($select_comments)){

$comment_id  = $row['comment_id'];
$comment_post_id = $row['comment_post_id'];
$comment_author = $row['comment_author'];
$comment_content = $row['comment_content'];
$comment_email = $row['comment_email'];
$comment_status = $row['comment_status'];
$comment_date = $row['comment_date'];
?><tr>
<?php
echo "<td> {$comment_id} </td>";
echo "<td> {$comment_author} </td>";
echo "<td> {$comment_content} </td>";

// $query= "SELECT * FROM posts WHERE post_category_id={$comment_id}";
// $select_cateagories_update = mysqli_query($connection,$query); //It is used at place where you use $result

// while($row = mysqli_fetch_assoc($select_cateagories_update)){

// $cat_id = $row['cat_id'];
// $cat_title = $row['cat_title'];

// echo "<td> {$cat_title} </td>";

// }



echo "<td> {$comment_email} </td>";
echo "<td> {$comment_status} </td>";


$query = " SELECT * FROM posts WHERE post_id = $comment_post_id ";
$select_post_id_query = mysqli_query($connection,$query);

while  ($row = mysqli_fetch_assoc($select_post_id_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];

 echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

}

echo "<td> {$comment_date} </td>";

echo "<td><a class='btn btn-success' href='comments.php?approve={$comment_id}'> APPROVE </a></td>";
echo "<td><a class='btn btn-warning' href='comments.php?unapprove={$comment_id}'> UNAPPROVE </a></td>";
echo "<td><a  rel='$comment_id' href='' class='btn btn-danger delete_link' data-toggle='modal' data-target='#deletecommentModal'> DELETE </a></td>";
// echo "<td><a class='btn btn-danger' href='comments.php?del={$comment_id}' onClick=\"javascript: return confirm('Are you sure you want to Delete this Comment');\"> DELETE </a></td>";
}
?>
</tr>	</tbody></table> 


 <?php 

if(isset($_GET['del'])){


$del_comment_id= escape($_GET['del']);

$query= "DELETE FROM comments WHERE comment_id={$del_comment_id} ";
$delete_query_comment= mysqli_query($connection,$query);

checkerror($delete_query_comment);

header("Location:comments.php");

}

?>


<?php 

if(isset($_GET['unapprove'])){


$unapprove_comment_id= escape($_GET['unapprove']);

$query= "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id";
$unapprove_query_comment= mysqli_query($connection,$query);

checkerror($unapprove_query_comment);

header("Location:comments.php");

}

?>


<?php 

if(isset($_GET['approve'])){

$approve_comment_id= escape($_GET['approve']);

$query= "UPDATE comments SET comment_status = 'approved' WHERE comment_id=$approve_comment_id";
$approve_query_comment= mysqli_query($connection,$query);

checkerror($approve_query_comment);

header("Location:comments.php");

}

?>

<script>
    
$(document).ready(function(){



$(".delete_link").on('click', function(){


var id =$(this).attr("rel");

var delete_url = "comments.php?del="+ id +" ";


$(".modal_delete_link").attr("href", delete_url);

});




});


</script>