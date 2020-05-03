<?php
require('config/config.php');
require('config/db.php');

//get id
$id = mysqli_real_escape_string($conn, $_GET['id']);

//create query
$query = 'SELECT * FROM posts WHERE id=' . $id;

//get result
$result = mysqli_query($conn, $query);

//Fetch Data
$post = mysqli_fetch_assoc($result);
//var_dump($posts);

//Free result
mysqli_free_result($result);

//close connection
mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>

<!--Body -->
<br>
<div class="container">
    <a href="<?php echo ROOT_URL; ?>" class="btn btn-primary">Back</a>
    <br>
    <h2><?php echo $post['title'] ?></h2>

    <p class="card-text"><?php echo $post['body']; ?></p>
    <blockquote>
        <small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
    </blockquote>
</div>

<?php include('inc/footer.php'); ?>