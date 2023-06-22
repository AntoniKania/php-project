<?php
require_once '../config.php';

require_once 'header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$postId = $_GET['id'];

$post = $postTable->getPostById($postId);
$comments = $commentTable->getCommentsByPostId($postId);

$previousPostId = $postTable->getPreviousPostId($postId);
$nextPostId = $postTable->getNextPostId($postId);

if ($_SESSION['role'] === 'author' || $_SESSION['role'] === 'admin') {
    echo '<button id="editButton">Edit Post</button> ';
    echo '<button id="deleteButton">Delete Post</button> ';
}

?>
<div id="postContainer">
    <!--    filled by post.js script -->
</div>

<h3>Comments</h3>
<div id="commentSection">
    <!--    filled by add_comment.js script -->
</div>

<form id="commentForm">
    <textarea name="comment_content" rows="4" cols="40"></textarea>
    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
    <input type="hidden" name="user_id"
           value="<?php echo $_SESSION['user_id'] == null ? null : $_SESSION['user_id']; ?>">
    <br>
    <input type="submit" value="Submit Comment">
</form>

<script src="../script/post.js"></script>
<script src="../script/add_comment.js"></script>
<script src="../script/edit_post.js"></script>
<script src="../script/delete_post.js"></script>


<?php
echo '<div>';
if ($previousPostId !== null) {
    echo '<a href="post.php?id=' . $previousPostId . '">Previous Post</a> ';
}
if ($nextPostId !== null) {
    echo '<a href="post.php?id=' . $nextPostId . '">Next Post</a>';
}
echo '</div>';
?>
