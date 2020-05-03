<?php
require('config/config.php');
require('config/db.php');

//Message vars
$msg = '';
$msgClass = '';

//check for submit
if (filter_has_var(INPUT_POST, 'submit')) {
    //Get form Data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    //check for require fields
    if (!empty($email) && !empty($name) && !empty($message)) {
        //Passed
        //check email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            //Failed
            $msg = 'Please use a valid email';
            $msgClass = 'alert alert-danger';
        } else {
            //Passed
            //Recipient Email
            $toEmail = 'fadesign001@gmail.com';
            $subject = 'Contact Request from ' . $name;
            $body = '<h2>Contact Request</h2>
                <h4>Name</h4><p>' . $name . '</p>
                <h4>Email</h4><p>' . $email . '</p>
                <h4>Message</h4><p>' . $message . '</p>
            ';

            //Email Headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-Type: text/html;charset=UTF-8" . "\r\n";

            //Additional Headers
            $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

            if (mail($toEmail, $subject, $body, $headers)) {
                //Email sent
                $msg = 'Your email has been sent';
                $msgClass = 'alert alert-success';
            } else {
                $msg = 'Your email was not sent';
                $msgClass = 'alert alert-danger';
            }
        }
    } else {
        //Failed
        $msg = 'Please fill in all fields';
        $msgClass = 'alert alert-danger';
    }
}
?>

<?php include('inc/header.php'); ?>
<br>
<!--Body -->
<div class="container">
    <h2>Get in touch with us</h2>
    <?php if ($msg != '') : ?>
        <div class="<?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" name="message"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

<?php include('inc/footer.php'); ?>