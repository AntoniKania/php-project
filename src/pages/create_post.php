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

<div class="container">
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea id="content" name="content" required class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Picture:</label>
            <input type="file" id="picture" name="picture" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<?php require_once 'footer.php' ?>
