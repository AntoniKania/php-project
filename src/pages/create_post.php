<?php
session_start();

require_once '../config.php';

$role = $_SESSION['role'];

if (!($role === User::$AUTHOR || $role === User::$ADMIN)) {
    header('Location: unauthorized.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $photoFilename = null;

    if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $pictureTmpName = $_FILES['picture']['tmp_name'];
        $pictureName = $_FILES['picture']['name'];
        $pictureExtension = pathinfo($pictureName, PATHINFO_EXTENSION);

        $photoFilename = uniqid() . '.' . $pictureExtension;

        $pictureDestination = '../images/' . $photoFilename;
        move_uploaded_file($pictureTmpName, $pictureDestination);
    }

    $postId = $postTable->createPost($title, $content, $photoFilename);

    header('Location: post.php?id=' . $postId);
    exit();
}

require_once 'header.php';

?>

<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    <label for="content">Content:</label>
    <textarea id="content" name="content" required></textarea>
    <label for="picture">Picture:</label>
    <input type="file" id="picture" name="picture">
    <button type="submit">Create Post</button>
</form>

<?php require_once 'footer.php' ?>
