<?php
session_start();

require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (strlen($password) < 8) {
        $error = 'Password should have at least 8 characters.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        if ($auth->registerUser($username, $password)) {
            header('Location: index.php');
            exit;
        } else {
            $error = 'Failed to create the user account.';
        }
    }
}

require_once 'header.php';
?>
<?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>
    <div class="container card">
        <h2>Create Account</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" class="common-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password: (at least 8 characters)</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="form-control">
            </div>
            <input type="submit" value="Create Account" class="btn btn-primary">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>


<?php require_once 'footer.php' ?>