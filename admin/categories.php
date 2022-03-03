<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <h1 class="page-header">
                           Welcome Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

<div class="col-xs-6"> 
<?php
insert_categories();
?>                       
<form action="" method="post">
    <div class="form-group">
    	<label for="cat_title">Category Name:     </label> 
<input class="form-control" type="text" name="cat_title">
    </div>
    <div class="form-group">
<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
    </div>


</form>

 <?php 
//UPDATE QUERY ICLUDED FROM FILE

if(isset($_GET['upd'])){

	$cat_id_upd=$_GET['upd'];

	include "includes/update_category.php";
}

 ?>

</div>

 <div class="col-xs-6"> 
 	


<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Category Title</th>
			<th>DELETE</th>
			<th>UPDATE</th>
		</tr>
	</thead>
<tbody>
<?php

selectallcategories();

?>

<?php 
//DELETE QUERY
del_category();

 ?>


</tbody>
</table>

 </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
