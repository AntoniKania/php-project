<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

//    todo: send email to author?
//    mail();
}
require_once 'header.php';
?>
<div class="container card">
    <h1>Contact The Author</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" class="common-form">
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required class="form-control"></textarea>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>
</div>
<?php require_once 'footer.php'; ?>
