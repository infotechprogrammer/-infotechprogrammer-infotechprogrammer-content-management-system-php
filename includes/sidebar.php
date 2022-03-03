  <div class="col-md-4">
<style type="text/css">
#fixed{
    position: fixed;
    padding-right: 100px;
}  

</style>
<div id="fixed">
                <!-- Blog Search Well -->
                <div class="well" id="">
                    <h4>Blog Search</h4>
                    <form action="search.php " method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Enter the title of the post">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                </form> <!-- Search Form-->
                    <!-- /.input-group -->
                </div>



<!-- Login -->
                <div class="well">

<?php if(isset($_SESSION['user_role'])): ?>

<h4> Logged in as <b><?php echo $_SESSION['username']; ?></b> </h4>
<a class="btn btn-success" href="/mycms/includes/logout.php">LOGOUT</a>

<?php else: ?>

  <h3>Login</h3>
                    <form action="login.php " method="post">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>
                      <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Login</button>
                        </span>
                    </div>
                    <div class="form-group">
                        <a href="/mycms/forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password ?</a>
                    </div>
                </form> <!-- Search Form-->
                    <!-- /.input-group -->


<?php endif; ?>
                  




                </div>

                <!-- Blog Categories Well -->
                <div class="well">
<?php



$query= "SELECT * FROM categories";
$select_cateagories_sidebar = mysqli_query($connection,$query); //It is used at place where you use $result

?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
 <?php                            while($row = mysqli_fetch_assoc($select_cateagories_sidebar)){

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];

echo "<li><a href='/mycms/category/$cat_id'> {$cat_title} </li> </a>";

}
?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>




                <!-- Side Widget Well -->
<?php include "widget.php"; ?>
</div>
            </div>