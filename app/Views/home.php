
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
        <?php

        if (isset($_SESSION['success_message'])) {
            echo '<p style="color: green;">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']);
        }
        ?>
        <div class="row">
            <?php foreach ($posts as $post): ?>
            <div class="col-lg-4 col-md-6 mb-2-6" style="margin-bottom: 10px;margin-top: 10px">
                <article class="card card-style2">
                    <div class="card-img">
                        <img class="rounded-top" height="280px" width="350px"  src="<?php echo '/blog/public/'.$post['image']; ?>" alt="...">

                    </div>
                    <div class="card-body">
                        <h3 class="h5"><a href="/blog/post/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h3>
                        <p class="display-30"><?php

                            $limitedContent = substr($post['content'], 0, 50);
                            if (strlen($post['content']) > 50)
                            $limitedContent .= "...";

                            echo $limitedContent; ?></p>
                        <a href="/blog/post/<?php echo $post['id']; ?>" class="read-more">read more</a><br/>
                        <small ><?php echo  date("F j, Y h:i:s A", strtotime($post['created_at'])); ?></small>
                    </div>
                    <div class="card-footer">
                        <ul>
                            <li><a href="#!"><i class="fas fa-user"></i><?php echo $post['author_name']; ?></a></li>
                            <li><a href="#!"><i class="far fa-comment-dots"></i><span><?php echo $post['comments_count']; ?></span></a></li>
                        </ul>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once 'app\Views\Layout\script.php' ?>
<?php require_once 'app\Views\Layout\footer.php' ?>

</body>
</html>

