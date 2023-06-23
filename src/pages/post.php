<?php
require_once '../config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$postId = $_GET['id'];

$post = $postTable->getPostById($postId);
$comments = $commentTable->getCommentsByPostId($postId);

$previousPostId = $postTable->getPreviousPostId($postId);
$nextPostId = $postTable->getNextPostId($postId);

if ($_SESSION['role'] === User::$AUTHOR || $_SESSION['role'] === User::$ADMIN) {
    echo '<button id="editButton" class="btn btn-primary">Edit Post</button> ';
    echo '<button id="deleteButton" class="btn btn-danger">Delete Post</button> ';
}

require_once 'header.php';
?>
<div class="container">
    <div id="postContainer" class="card">
        <!--    filled by post.js script -->
    </div>

    <h3>Comments</h3>
    <div id="commentSection" class="card" style="margin-bottom: 20px;">
        <!--    filled by add_comment.js script -->
    </div>

    <form id="commentForm">
        <div class="form-group">
            <textarea name="comment_content" rows="4" cols="40" class="form-control"></textarea>
        </div>
        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
        <input type="hidden" name="user_id"
               value="<?php echo $_SESSION['user_id'] == null ? null : $_SESSION['user_id']; ?>">
        <br>
        <input type="submit" value="Submit Comment" class="btn btn-primary">
    </form>
</div>

<div class="container" style="margin-top: 20px; bottom: 10px; right: 10px; display: flex; justify-content: space-between;
    align-items: center;">
    <?php
    if ($previousPostId !== null) {
        echo '<a href="post.php?id=' . $previousPostId . '" class="btn btn-primary">Previous Post</a> ';
    }
    if ($nextPostId !== null) {
        echo '<a href="post.php?id=' . $nextPostId . '" class="btn btn-primary float-end">Next Post</a>';
    }
    ?>
</div>

<script src="../script/post.js"></script>
<script src="../script/add_comment.js"></script>
<script src="../script/edit_post.js"></script>
<script src="../script/delete_post.js"></script>

<?php
require_once 'footer.php';
?>
