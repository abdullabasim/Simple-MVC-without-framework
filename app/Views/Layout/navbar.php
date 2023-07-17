<?php


// Check if the user is logged in
$loggedIn = isset($_SESSION['user']);


// Get the username if logged in
$username = "";
if ($loggedIn) {
    $username = $_SESSION['user']['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/blog/">My Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href=/blog/#">Home</a>
                </li>
                <?php if ($loggedIn)  {?>
                <li class="nav-item">
                    <a class="nav-link" href="/blog/create-post">Create Post</a>
                </li>
                <?php }  ?>

                <?php if ($loggedIn) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/logout">Logout (<?php echo $username; ?>)</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/register">Register</a>
                    </li>


                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Rest of your HTML content -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
