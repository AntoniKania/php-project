<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

//    todo: send email to author?
//    mail();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
</head>
<body>
<h1>Contact The Author</h1>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    <label for="name">Your Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Your Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea><br><br>

    <input type="submit" value="Submit">
</form>
</body>
</html>
