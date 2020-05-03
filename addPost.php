<?php
require('config/config.php');
require('config/db.php');

//check for submit
if(isset($_POST['submit'])){
    //Get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "INSERT INTO posts(title, author, body) VALUES ('$title', '$author', '$body')";

    if(mysqli_query($conn, $query)){
        header('Location:' .ROOT_URL.'');
    }else{
        echo 'Error: '. mysqli_errno($conn);
    }

}
?>

<?php include('inc/header.php'); ?>
<br>
<!--Body -->
<div class="container">
    <h1>Add Post</h1>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" class="form-control" name="author">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea class="form-control" name="body"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
    </form>
</div>

<?php include('inc/footer.php'); ?>