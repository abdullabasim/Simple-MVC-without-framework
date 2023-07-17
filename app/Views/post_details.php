
<!DOCTYPE html>
<html lang="en">
<?php require_once 'app\Views\Layout\head.php' ?>
<body>
<?php require_once 'app\Views\Layout\navbar.php' ?>
<div class="jumbotron">
    <div class="container ">
        <h1 class="display-4">Blog</h1>
        <p class="lead">Discover the latest articles and insights from our expert authors.</p>
    </div>
</div>
<section>
    <div class="container">
        <div id="main-content" class="blog-page">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 left-box">
                        <div class="card single_post">
                            <div class="body">
                                <?php

                                if (isset($_SESSION['success_comment_message'])) {
                                    echo '<p style="color: green;">' . $_SESSION['success_comment_message'] . '</p>';
                                    unset($_SESSION['success_comment_message']);
                                }
                                ?>
                                <div class="img-post" style="text-align: center">
                                    <img  class="d-block img-fluid" width="400px"  src="<?php echo '/blog/public/'.$post['image']; ?>" alt="First slide">
                                </div>
                                <h3><a href="#"><?php echo $post['title']; ?></a></h3>
                                <p><?php echo $post['content']; ?></p>
                                <small ><?php echo  date("F j, Y h:i:s A", strtotime($post['created_at'])); ?></small>
                            </div>
                        </div>
                        <div class="card" style="margin-top: 20px">
                            <div class="header">
                                <h2>Comments </h2>
                            </div>
                            <div class="body">
                                <ul class="comment-reply list-unstyled">


                                    <?php foreach ($comments as $comment): ?>
                                    <li class="row clearfix">
                                        <div class="icon-box col-md-2 col-4"><img class="img-fluid img-thumbnail" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Awesome Image"></div>
                                        <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                            <h5 class="m-b-0"><?php echo $comment['username']; ?> </h5>
                                            <p><?php echo $comment['comment']; ?> </p>
                                            <ul class="list-inline">
                                                <p></p>
                                                <li><a href="javascript:void(0);"><?php echo  date("F j, Y h:i:s A", strtotime($comment['created_at'])); ?></a></li>

                                            </ul>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                        </div>
                        <div class="card" style="margin-top: 20px">
                            <div class="header">
                                <h2>Leave a reply <small></small></h2>
                            </div>
                            <div class="body">
                                <div class="comment-form">
                                    <form class="row clearfix" action="/blog/comment/create/<?php echo $post['id']; ?>" method="post">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea rows="4" name="comment" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">SUBMIT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once 'app\Views\Layout\script.php' ?>
<?php require_once 'app\Views\Layout\footer.php' ?>

</body>
</html>

