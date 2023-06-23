<?php
require_once '../config.php';
session_start();

if ($_SESSION['role'] != User::$ADMIN) {
    header('Location: unauthorized.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($auth->registerUserWithGivenRole($username, $password, $role)) {
        echo "User created successfully";
    } else {
        $error = 'Failed to create the user account.';
    }
}

if (isset($_GET['delete'])) {
    $userId = $_GET['delete'];

    if ($userTable->deleteUser($userId)) {
        header('Location: manage_users.php');
        exit;
    } else {
        $error = 'Failed to delete the user account.';
    }
}

/**
 * @var User[] $users
 */
$users = $userTable->getAllUsers();

require_once 'header.php';
?>

<?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<div class="container">
    <h2>Manage Users</h2>

    <div class="container card" style="margin-bottom: 20px;">
        <h3>Add New User</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select id="role" name="role" class="form-select">
                    <option value="admin">Admin</option>
                    <option value="author">Author</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>

    <div class="container card">
        <h3>Users List</h3>
        <table class="table" style="background-color: whitesmoke; border-radius: 2px;">
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user->getUsername(); ?></td>
                    <td><?php echo $user->getRole(); ?></td>
                    <td><a href="?delete=<?php echo $user->getId(); ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</div>
<?php require_once 'footer.php' ?>
