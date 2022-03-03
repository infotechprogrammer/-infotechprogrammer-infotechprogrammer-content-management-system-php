
<form action="" method="post">
    <div class="form-group">
    	<label for="cat_title">Edit Category:     </label> 


<?php

if(isset($_GET['upd'])){
$cat_id = $_GET['upd'];	

//Query for SELECTING ALL CATEGORIES
$query= "SELECT * FROM categories WHERE cat_id=$cat_id";
$select_cateagories_update = mysqli_query($connection,$query); //It is used at place where you use $result

while($row = mysqli_fetch_assoc($select_cateagories_update)){

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];
?>

<input value="<?php if(isset($cat_title)) { echo $cat_title; } ?>" class="form-control" type="text" name="cat_title">


<?php } }?>

<?php 
//UPDATE CATEGORY
if(isset($_POST['update_category'])){

$cat_title_upd=$_POST['cat_title'];

$query = "UPDATE categories SET cat_title= '{$cat_title_upd}' WHERE cat_id = {$cat_id_upd}";
$update_query = mysqli_query($connection,$query);
if(!$update_query){
	die("QUERY FAILED". mysqli_error($connection));
}
header("Location: categories.php");
}

?>

    </div>
    <div class="form-group">
<input class="btn btn-success" type="submit" name="update_category" value="Update Category">
    </div>

</form>
