<?php
include 'delete_modal.php';
?>

                
                <table class="table table-bordered table-hover">
                	<thead>
                		<tr>
                			<th>ID</th>
                			<th>Username</th>
                			<th>Firstname</th>
                			<th>Lastname</th>
                			<th>Email</th>
                			<th>Role</th>
                			<th>Make Admin</th>
                			<th>Make Subscriber</th><th>UPDATE</th>
                			<th>DELETE</th>
                		</tr>
                	</thead>

                <tbody>

<?php 

$query= "SELECT * FROM users";
$select_users = mysqli_query($connection,$query); //It is used at place where you use $result

while($row = mysqli_fetch_assoc($select_users)){

$user_id  = $row['user_id'];
$username = $row['username'];
$user_password = $row['user_password'];
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];
$user_email = $row['user_email'];
$user_image = $row['user_image'];
$user_role = $row['user_role'];
?><tr>
<?php
echo "<td> {$user_id} </td>";
echo "<td> {$username} </td>";
echo "<td> {$user_firstname} </td>";
echo "<td> {$user_lastname} </td>";
echo "<td> {$user_email} </td>";
echo "<td> {$user_role} </td>";

echo "<td><a class='btn btn-warning' href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
echo "<td><a class='btn btn-info' href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
echo "<td><a class='btn btn-success' href='users.php?source=edit_user&upd={$user_id}'> UPDATE </a></td>";

?>
<script type="text/javascript">
        function del(){
confirm("Do you really want to delete this user then Press OK");
        }
</script>

<form method="post">

<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
<?php
echo '<td><input class="btn btn-danger " type="submit" name="delete" value="Delete" onClick="del()"></td>';
?>

<!-- echo "<td><a  rel='$user_id' href='' class='btn btn-danger delete_link' data-toggle='modal' data-target='#deleteuserModal'> DELETE </a></td>";
 --></form>
<?php

// echo "<td><a class='btn btn-danger' href='users.php?del={$user_id}' onClick=\"javascript: return confirm('Are you sure you want to Delete this User');\"> DELETE </a></td>";
}

?>
</tr>	


 <?php 

if(isset($_POST['delete'])){

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                

$del_user_id = $_POST['user_id'];

$query= "DELETE FROM users WHERE user_id={$del_user_id} ";
$delete_query_user= mysqli_query($connection,$query);

checkerror($delete_query_user);

header("Location:users.php");

}

}
?>


<?php 

if(isset($_GET['change_to_admin'])){


$the_user_id= escape($_GET['change_to_admin']);

$query= "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
$change_to_admin_query= mysqli_query($connection,$query);

checkerror($change_to_admin_query);

header("Location:users.php");

}


?>


<?php 

if(isset($_GET['change_to_subscriber'])){


$the_user_id= escape($_GET['change_to_subscriber']);

$query= "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
$change_to_subscriber_query= mysqli_query($connection,$query);

checkerror($change_to_subscriber_query);

header("Location:users.php");

}

?>

<!-- <script>
    
$(document).ready(function(){



$(".delete_link").on('click', function(){


var id =$(this).attr("rel");

var delete_url = "users.php?del="+ id +" ";


$(".modal_delete_link").attr("href", delete_url);

});




});


</script> -->