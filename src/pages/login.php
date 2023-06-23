<?php
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($auth->authenticateUser($username, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}

require_once 'header.php';
?>
    <div class="container card">
        <h2>Login</h2>
        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" class="common-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>
            <input type="submit" value="Login" class="btn btn-primary">
        </form>
        <p>Don't have an account? <a href="register.php">Create an account</a></p>
    </div>

<?php require_once 'footer.php' ?>