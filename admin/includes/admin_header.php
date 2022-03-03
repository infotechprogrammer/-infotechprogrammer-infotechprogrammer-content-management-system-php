<?php ob_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "./functions.php"; ?>
<?php session_start(); ?>

<?php 

if(!isset($_SESSION['user_role'])){

    header("Location:/mycms/login.php");

 }else {
     if($_SESSION['user_role'] !== 'admin'){
        header("Location:/mycms/");
    }
 }

?>








<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

 <link href="css/loader.css" rel="stylesheet">

 
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>



 <script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>

    <!-- Can use this one below as well -->
<!--   <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script> -->


<script src="js/jquery.js"></script>


 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="ckeditor/ckeditor.js"></script>
                <script>
                        ClassicEditor
                                .create( document.querySelector( '#editor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>

                 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

<script> 

$(document).ready(function(){

    Pusher.logToConsole = true;

    var pusher = new Pusher('cf88bb7d6c0098376873', {
      cluster: 'ap2',
      encrypted: true
    });

    var notificationchannel = pusher.subscribe('notifications');
    notificationchannel.bind('new_user', function(notification) {

        var message = notification.message;

        toastr.success(`${message} just signed up`);




});




});

</script>
    
 
</head>

<body>
