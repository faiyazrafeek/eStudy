<?php
require('config/config.php');
require('config/db.php');

//create query
$query = 'SELECT * FROM posts ORDER BY created_at DESC';

//get result
$result = mysqli_query($conn, $query);

//Fetch Data
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
//var_dump($posts);

//Free result
mysqli_free_result($result);

//close connection
mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>

<!--Jumbotron-->
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Welcome to eStudy</h1>
        <p class="lead">Fully free e-learning system for the current prevailing situation</p>
        <hr class="my-4">
        <p>Teachers can get registered and enroll you students</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Register Now</a>
        </p>
    </div>
</div>

<!--Body -->
<div class="container">
    <h1 class="text-center">Featured Posts</h1>
    <hr>
    <?php foreach ($posts as $post) : ?>
        <div class="card bg-light mb-3">
            <div class="card-header"><?php echo $post['title'] ?></div>
            <div class="card-body">
                <p class="card-text"><?php echo $post['body']; ?></p>
                <blockquote>
                    <small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
                </blockquote>
                <a href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include('inc/footer.php'); ?>