<?php session_start(); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">


            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

<?php

$pagename = basename($_SERVER['PHP_SELF']);
$registration = 'registration.php';
$contact = 'contact.php';
$login = 'login.php';


if($pagename == $registration){
    $registration_class = 'active';
}else{
    $registration_class = '';
}

if($pagename == $contact){
    $contact_class = 'active';
}else{
    $contact_class = '';
}

if($pagename == $login){
    $login_class = 'active';
}else{
    $login_class = '';
}

?>


                <a class="navbar-brand" href="/mycms"><i>My CMS</i></a>
            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="<?php echo $contact_class; ?>">
                        <a href="/mycms/contact">Contact</a>
                    </li>
                     <?php 

    if(!isset($_SESSION['user_role'])) {
    echo "<li class='$login_class'><a href='/mycms/login.php'>Login</a></li>";    
    }

    if(isset($_SESSION['user_role'])) {

    
        if(isset($_GET['p_id'])) {
            
          $the_post_id = $_GET['p_id'];
      
        if($_SESSION['user_role'] == 'admin') {  
        echo "<li><a href='/mycms/admin/post.php?source=edit_post&upd={$the_post_id}'>Edit Post</a></li>";
        }else{
        echo "<li><a href='/mycms/dashboard/post.php?source=edit_post&upd={$the_post_id}'>Edit Post</a></li>";    
        }
    }
    
    if($_SESSION['user_role'] == 'admin') {

      echo "<li><a href='/mycms/admin/'>Admin</a></li>";   
    }else{
        echo "<li><a href='/mycms/dashboard'>Admin</a></li>"; 
    }
    }
    
    ?>
                    <li class="<?php echo $registration_class; ?>">
                        <a href="/mycms/registration">SignUp</a>
                    </li>


                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>