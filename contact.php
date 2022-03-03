<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<!-- <?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("sahilbatra158@gmail.com","My subject",$msg);
?> -->

<?php 

if (isset($_POST['submit'])) {
    
$to       = "sahilbatra158@gmail.com";
$subject = $_POST['subject'];
$user_email = $_POST['email'];
$body       = $_POST['body'];
}
 ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <h1 class="text-primary text-center">Contact</h1>
        <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
        <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
        var setting = {"height":512,"width":1200,"zoom":15,"queryString":"CT Group of Institutions, Jalandhar, Punjab, India","place_id":"ChIJ53jzautcGjkRBSibPaVJgQo","satellite":false,"centerCoord":[31.2378773596318,75.55452815000001],"cid":"0xa8149a53d9b2805","cityUrl":"/india/jalandhar-18909","id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3","embed_id":"63580"};
        var d = document;
        var s = d.createElement('script');
        s.src = 'https://1map.com/js/script-for-user.js?embed_id=63580';
        s.async = true;
        s.onload = function (e) {
          window.OneMap.initMap(setting)
        };
        var to = d.getElementsByTagName('script')[0];
        to.parentNode.insertBefore(s, to);
      })();</script><a href="https://1map.com/map-embed?embed_id=63580">1map.com</a></div>
      <br><hr>
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <form role="form" action="registration.php" method="post" id="login-form">


                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Emter your email">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your Subject">
                        </div>
<div class="form-group">
                        <textarea class="form-control" name="body" rows="5" id="body">Enter your message here</textarea>
</div>          
                        <input type="submit" name="submit" id="btn-login" class="btn btn-info btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->

    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
