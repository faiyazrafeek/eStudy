<?php
require('config/config.php');
require('config/db.php');

//check for delete
if (isset($_POST['delete'])) {
    //Get form data
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

$query = "DELETE FROM posts WHERE id = {$delete_id}";

    if (mysqli_query($conn, $query)) {
        header('Location:' . ROOT_URL . '');
    } else {
        echo 'Error: ' . mysqli_errno($conn);
    }
}

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
    <br><br>
    <h2><?php echo $post['title'] ?></h2>

    <p class="card-text"><?php echo $post['body']; ?></p>
    <blockquote>
        <small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
    </blockquote>
    <hr>
    <form class="float-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
        <input type="submit" value="Delete" name="delete" class="btn btn-danger">
    </form>
    <a href="<?php echo ROOT_URL; ?>editPost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
</div>

<?php include('inc/footer.php'); ?>