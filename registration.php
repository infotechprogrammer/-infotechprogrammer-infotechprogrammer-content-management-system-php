<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php

require 'vendor/autoload.php';

 $options = array(
    'cluster' => 'ap2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'cf88bb7d6c0098376873',
    '9f6b7b97a78f4e43ab3a',
    '1044307',
    $options
  );



 ?>

<?php 

if (isset($_POST['submit'])) {
    
$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$error = [

    'user_firstname'=>'',
    'user_lastname'=>'',
    'username'=>'',
    'email'=>'',
    'password'=>''
    
];

if($user_firstname == ''){
    $error['user_firstname'] = 'Firstname cannot be Empty';
}

if($user_lastname == ''){
    $error['user_lastname'] = 'Lastname cannot be Empty';
}

if(strlen($username) < 3 ){
    $error['username'] = 'Username is too short';
}

if(strlen($username) > 18){
    $error['username'] = 'Username is too long';
}

if($username == ''){
    $error['username'] = 'Username cannot be Empty';
}

if(username_exists($username)){
    $error['username'] = 'This usename already exists try something else';
}

if($email == ''){
    $error['email'] = 'Email cannot be Empty';
}

if(email_exists($email)){
    $error['email'] = 'This email already exists use another';
}

if($password == ''){
    $error['password'] = 'Password cannot be Empty';
}

foreach ($error as $key => $value) {
    if(empty($value)){

        unset($error[$key]);
    }
}//foreach

if(empty($error)){

$username = mysqli_real_escape_string($connection, $username);
$email = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);


$encpassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

// $query = "SELECT randSalt FROM users";
// $select_randsalt_query = mysqli_query($connection,$query) or die("QUERY FAILED".mysqli_error($connection));


// $row = mysqli_fetch_array($select_randsalt_query);
// $salt = $row['randSalt'];
// $password = crypt($password, $salt);

$query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) VALUES ('{$username}', '{$encpassword}','{$user_firstname}', '{$user_lastname}', '{$email}', 'subscriber')";
$register_user_query = mysqli_query($connection,$query) or die(mysqli_error($connection));

$msg="Registration Successful You can go to homepage to login now <a href='index.php'>Homepage</a>";
}
else{
$msg="";
}
$data['message'] = $username;
$pusher->trigger('notifications', 'new_user', $data);
}
else{
$msg="";
}

 ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-primary text-center">Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h4 class="text-center text-danger"><?php echo $msg; ?></h4>
                        <div class="form-group">
                     <label for="user_firstname" class="sr-only">Firstname</label>
                     <input type="text" class="form-control" name="user_firstname" placeholder="Enter your Firstname" autocomplete="on" value="<?php echo isset($user_firstname) ? $user_firstname : '' ?>">
                     <p align="center" style="color: red"><?php echo isset($error['user_firstname']) ? $error['user_firstname'] : '' ?></p>
                 </div>  

<div class="form-group">
    <label for="user_lastname" class="sr-only">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" placeholder="Enter your Lastname" autocomplete="on" value="<?php echo isset($user_lastname) ? $user_lastname : '' ?>">
    <p align="center" style="color: red"><?php echo isset($error['user_lastname']) ? $error['user_lastname'] : '' ?></p>
</div>  
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
    <p align="center" style="color: red"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                            <p align="center" style="color: red"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" value="<?php echo isset($password) ? $password : '' ?>">
                            <p align="center" style="color: red"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-info btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
