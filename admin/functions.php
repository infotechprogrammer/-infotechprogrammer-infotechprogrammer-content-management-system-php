<?php


function loggedInUserId(){

global $connection;

if(isset($_SESSION['username'])){

$result = mysqli_query($connection,"SELECT * FROM users WHERE username ='" . $_SESSION['username'] ."' ");
checkerror($result);
$user = mysqli_fetch_array($result);
if(mysqli_num_rows($result) >=1){

    return $user['user_id'];
}

} return false;
}

function userLikedThisPost($post_id = ''){

global $connection;

$result = mysqli_query($connection,"SELECT * FROM likes WHERE  user_id =" . loggedInUserId() . " AND post_id = {$post_id} ");
checkerror($result);

return mysqli_num_rows($result) >= 1 ? true : false;

}

function getPostlikes($post_id){

global $connection;

$result = mysqli_query($connection,"SELECT * FROM likes WHERE post_id = $post_id");
checkerror($result);
echo mysqli_num_rows($result);

}








?>


<?php

function img_placeholder($image=''){

	if(!$image){
		return 'noimg.jpg';
	}else{
		return $image;
	}
}

?>

<?php

function escape($string){

global $connection;

return mysqli_real_escape_string($connection, trim($string));

}



?>

<?php 

function checkerror($results) {

	global $connection;

	if(!$results){

		die("QUERY FAILED" . mysqli_error($connection));
	}
}

 ?>


<?php

function insert_categories(){

	global $connection;

if(isset($_POST['submit'])){
$cat_title=$_POST['cat_title'];

if($cat_title == "" || empty($cat_title)){

	echo"<h5>Please fill in this field</h5>";

}else{

$query="INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
$create_category_query = mysqli_query($connection, $query);

if(!$create_category_query){
	die('QUERY FAILED'. mysqli_error($connection));
}

}

}

}

?>
<?php
function selectallcategories(){


	global $connection;


//Query for SELECTING ALL CATEGORIES
$query= "SELECT * FROM categories";
$select_cateagories = mysqli_query($connection,$query); //It is used at place where you use $result

while($row = mysqli_fetch_assoc($select_cateagories)){

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];
?><tr>
<?php
echo "<td> {$cat_id} </td>";
echo"<td> {$cat_title} </td>";
echo "<td><a class='btn btn-danger' href='categories.php?del={$cat_id}' onClick=\"javascript: return confirm('Are you sure you want to Delete this category');\"> DELETE </a></td>";
echo "<td><a class='btn btn-success' href='categories.php?upd={$cat_id}'> EDIT </a></td>";
?>
</tr>	
<?php }}	 ?>		


<?php

function del_category(){


global $connection;
	if(isset($_GET['del'])){

$cat_id_del=$_GET['del'];

$query = "DELETE FROM categories WHERE cat_id = {$cat_id_del}";
$delete_query = mysqli_query($connection,$query);
header("Location: categories.php");
}
}

?>

<?php

function users_online() {

if(isset($_GET['onlineusers'])){



global $connection;

if(!$connection){

	session_start();

	include ("../includes/db.php");


$session = session_id();
$time = time();
$time_out_in_seconds = 05;
$time_out = $time - $time_out_in_seconds;

$query ="SELECT * FROM users_online WHERE session  = '$session'";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);

if($count == NULL){

$query = "INSERT INTO users_online(session, time) VALUES('$session', '$time')";
$insert_user_online = mysqli_query($connection, $query) or die("Query ERROR" . mysqli_error($connection));

} else {

$query = "UPDATE users_online SET time = '$time' WHERE session= '$session'";
$update_user_online = mysqli_query($connection, $query) or die("Query ERROR" . mysqli_error($connection));

}

$query = "SELECT * FROM users_online WHERE time > '$time_out'";
$user_online_query = mysqli_query($connection, $query) or die("Query ERROR" . mysqli_error($connection));
echo $count_user = mysqli_num_rows($user_online_query);



}



} //get request isset()

}


users_online();
?>

<?php

function username_exists($username){

global $connection;

$query = "SELECT username FROM users WHERE username = '$username'";
$result = mysqli_query($connection,$query);

checkerror($result);

if(mysqli_num_rows($result) > 0){

	return true;
}else{

	return false;
}


}

?>

<?php

function email_exists($email){

global $connection;

$query = "SELECT user_email FROM users WHERE user_email = '$email'";
$result = mysqli_query($connection,$query);

checkerror($result);

if(mysqli_num_rows($result) > 0){

	return true;
}else{

	return false;
}


}

?>