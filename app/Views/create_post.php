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
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Post</div>
                <div class="card-body">
                    <?php

                    if (isset($_SESSION['error_createPost_message'])) {
                        echo '<p style="color: red;">' . $_SESSION['error_createPost_message'] . '</p>';
                        unset($_SESSION['error_createPost_message']);
                    }
                    ?>
                    <form method="POST" action="/blog/create-post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'app\Views\Layout\script.php' ?>
<?php require_once 'app\Views\Layout\footer.php' ?>
</body>
</html>