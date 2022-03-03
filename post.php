<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

<?php

 if(isset($_POST['liked'])) {

     $post_id = $_POST['post_id'];
     $user_id = $_POST['user_id'];

      //1 =  FETCHING THE RIGHT POST

     $query = "SELECT * FROM posts WHERE post_id=$post_id";
     $postResult = mysqli_query($connection, $query);
     $post = mysqli_fetch_array($postResult);
     $likes = $post['likes'];

     // 2 = UPDATE - INCREMENTING WITH LIKES

     mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id=$post_id");

     // 3 = CREATE LIKES FOR POST

     mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
     exit();


 }



 if(isset($_POST['unliked'])) {



     $post_id = $_POST['post_id'];
     $user_id = $_POST['user_id'];

     //1 =  FETCHING THE RIGHT POST

     $query = "SELECT * FROM posts WHERE post_id=$post_id";
     $postResult = mysqli_query($connection, $query);
     $post = mysqli_fetch_array($postResult);
     $likes = $post['likes'];

     //2 = DELETE LIKES

     mysqli_query($connection, "DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id");


     //3 = UPDATE WITH DECREMENTING WITH LIKES

     mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id=$post_id");

     exit();


 }



 ?>






    <!-- Page Content -->
    <div class="container">
 
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

if(isset($_GET['p_id'])){

$the_post_id=$_GET['p_id'];

$query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
$send_count_query = mysqli_query($connection,$query) or die("QUERY ERROR" . mysqli_error($connection));


if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){

$query = "SELECT * FROM posts WHERE post_id='{$the_post_id}'";
}else{

 $query = "SELECT * FROM posts WHERE post_id='{$the_post_id}' AND post_status='published'";

}



               
                $select_all_posts_query = mysqli_query($connection,$query)or die(mysqli_error($connection)); //It is used at place where you use $result

 if(mysqli_num_rows($select_all_posts_query) < 1){
        echo"<h2>No posts yet</h2>";
    }else{

while($row = mysqli_fetch_assoc($select_all_posts_query)){

$post_id = $row['post_id'];
$post_title = $row['post_title'];
$post_user = $row['post_user'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_content = $row['post_content'];
?>

<h1 class="page-header">
                   Post
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="/mycms/post/<?php echo $post_id; ?>"><b><i><?php echo $post_title; ?></i></b></a>
                </h2>
                <p class="lead">
                    by <a href="/mycms/author_posts.php?author=<?php echo $post_user; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="/mycms/images/<?php echo img_placeholder($post_image); ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

   <?php

        // FREEING RESULT


        ?>

           <?php

                if(isset($_SESSION['user_role'])){ ?>


                    <div class="row">
                        <p class="pull-left"><a style="font-size: 25px;"
                                class="<?php echo userLikedThisPost($the_post_id) ? 'unlike' : 'like'; ?>"
                                href=""><span class="glyphicon glyphicon-thumbs-up"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?php echo userLikedThisPost($the_post_id) ? ' You liked this before' : 'You can like it'; ?>"



                                >
                                <?php echo userLikedThisPost($the_post_id) ? ' Unlike' : ' Like'; ?>



                            </a>
</span></p>
                    </div>


              <?php  } else { ?>

                    <div class="row">
                        <p class="pull-right login-to-post">You need to <a href="/cms/login.php">Login</a> to like </p>
                    </div>


                <?php }


            ?>



                <div class="row">
                    <p style="font-size: 16px" class="pull-right likes"><b>Likes:</b> <?php getPostlikes($the_post_id); ?></p>
                </div>

                 <div class="clearfix"></div>






<?php



    }


?>

 <!-- Blog Comments -->

<?php

if(isset($_POST['create_comment'])){


$comment_author = $_POST['comment_author'];
$comment_email = $_POST['comment_email'];
$comment_content = $_POST['comment_content'];

    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
        
    



$query = "INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES ('{$the_post_id}','{$comment_author}','{$comment_email}','{$comment_content}','approved',now())";

$create_comment_query = mysqli_query($connection,$query) or die(mysqli_error($connection));

// $query = " UPDATE posts SET post_comment_count= post_comment_count +1 WHERE post_id =$the_post_id";
// $update_comment_count = mysqli_query($connection,$query);



} else {
    echo"<script>alert('Fields Cannot be Empty')</script>";
}

}
?>




                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post">
                        <label for="comment_author">Your Name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Your Email</label>
                            <input type="text" class="form-control" name="comment_email">
                        </div>

                        <div class="form-group">
                            <label for="comment_content">
                            Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
<h4><i>Comments:</i></h4>               
 <!-- Comment -->
                <?php 

$query = " SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status ='approved' ORDER BY comment_id DESC ";
$show_comment_query = mysqli_query($connection,$query) or die('Query Failed' . mysqli_error($connection));
while ($row = mysqli_fetch_array($show_comment_query)) {
    $comment_date = $row['comment_date'];
    $comment_content = $row['comment_content'];
    $comment_author = $row['comment_author'];

?>
                <div class="media">


                    <a class="pull-left" href="#">
                        <img class="media-object" src="" alt="img">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ; ?>
                            <small><?php echo $comment_date ; ?></small>
                        </h4>
                        <?php echo $comment_content ; ?>
                    </div>
                </div>      
  <?php } } }else{
    header("Location:/mycms/");
  }?>
            </div>


            <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

 <?php include"includes/footer.php"; ?>

        <script>
            $(document).ready(function(){

                  $("[data-toggle='tooltip']").tooltip();
                    var post_id = <?php echo $the_post_id; ?>;
                    var user_id = <?php echo  loggedInUserId(); ?>;

                // LIKING

                $('.like').click(function(){
                    $.ajax({
                        url: "/mycms/post.php?p_id=<?php echo $the_post_id; ?>",
                        type: 'post',
                        data: {
                            'liked': 1,
                            'post_id': post_id,
                            'user_id': user_id
                        }
                    });
                });

                // UNLIKING

                $('.unlike').click(function(){

                    $.ajax({

                        url: "/mycms/post.php?p_id=<?php echo $the_post_id; ?>",
                        type: 'post',
                        data: {
                            'unliked': 1,
                            'post_id': post_id,
                            'user_id': user_id

                        }


                    });

                });





            });




        </script>