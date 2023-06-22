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

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
</head>
<body>
<h2>Manage Users</h2>

<?php if (isset($error)) : ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<h3>Add New User</h3>
<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <label for="role">Role:</label>
    <select id="role" name="role">
        <option value="admin">Admin</option>
        <option value="author">Author</option>
        <option value="user">User</option>
    </select><br><br>
    <input type="submit" value="Add User">
</form>

<h3>Users List</h3>
<table>
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

<?php require_once 'footer.php' ?>
