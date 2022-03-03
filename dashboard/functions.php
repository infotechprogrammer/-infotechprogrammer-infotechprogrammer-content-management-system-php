
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

$query="INSERT INTO categories(cat_title, cat_user) VALUE ('{$cat_title}', '{$_SESSION['username']}')";
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
$query= "SELECT * FROM categories WHERE cat_user='" . $_SESSION['username'] ."'";
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
