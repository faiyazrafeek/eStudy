<?php
require('config/config.php');
require('config/db.php');

//check for submit
if (isset($_POST['submit'])) {
    //Get form data
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "UPDATE posts SET 
                title = '$title',
                author = '$author',
                body = '$author'
            WHERE id = {$update_id}";

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
<br>
<!--Body -->
<div class="container">
    <h1>Edit Post</h1>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $post['title']; ?>">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" class="form-control" name="author" value="<?php echo $post['author']; ?>">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea class="form-control" name="body" ><?php echo $post['title']; ?></textarea>
        </div>
        <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
        <input type="submit" class="btn btn-primary" name="submit" value="Update">
    </form>
</div>

<?php include('inc/footer.php'); ?>