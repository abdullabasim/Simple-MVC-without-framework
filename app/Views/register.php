<!DOCTYPE html>
<html lang="en">
<?php require_once 'app\Views\Layout\head.php' ?>
<body>
<?php require_once 'app\Views\Layout\navbar.php' ?>

<div class="container" style="margin-top: 100px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create User</div>
                <div class="card-body">
                    <?php


                    if (isset($_SESSION['error_register_message'])) {
                        echo '<p style="color: green;">' . $_SESSION['error_register_message'] . '</p>';
                        unset($_SESSION['error_register_message']); // Clear the success message
                    }
                    ?>
                    <form method="POST" action="/blog/register">
                        <div class="form-group">
                            <label for="email">UserName</label>
                            <input type="text" name="username"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
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
