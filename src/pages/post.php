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

echo '<h2>' . $post->getTitle() . '</h2>';
echo '<p>' . $post->getContent() . '</p>';
echo '<p>Publication Date: ' . $post->getPublicationDate()->format(DATE_FORMAT) . '</p>';

echo '<h3>Comments</h3>';
?>

<div id="commentSection">
<!--    filled by js script -->
</div>

<form id="commentForm">
    <textarea name="comment_content" rows="4" cols="40"></textarea>
    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] == null ? null : $_SESSION['user_id']; ?>">
    <br>
    <input type="submit" value="Submit Comment">
</form>

<script>
    //todo: put this in separate file
    let postId = <?php echo $postId; ?>;

    document.getElementById('commentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let form = e.target;
        let formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../script/submit_comment.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log(xhr.responseText)
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    fetchComments();
                } else {
                    console.log("Couldn't add data to the comment table")
                }
            }
        };
        xhr.send(formData);
    });

    function fetchComments() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '../script/fetch_comments.php?postId=' + postId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    let comments = response.comments;
                    updateCommentSection(comments);
                }
            }
        };
        xhr.send();
    }

    function updateCommentSection(comments) {
        let commentSection = document.getElementById('commentSection');
        commentSection.innerHTML = '';

        comments.forEach(function(comment) {
            console.log(comment)
            let commentDiv = document.createElement('div');

            let contentParagraph = document.createElement('p');
            contentParagraph.textContent = comment.content;
            commentDiv.appendChild(contentParagraph);

            let authorParagraph = document.createElement('p');
            authorParagraph.textContent = 'Author: ' + comment.username;
            commentDiv.appendChild(authorParagraph);

            let dateParagraph = document.createElement('p');
            let commentDate = new Date(comment.comment_date);
            dateParagraph.textContent = 'Date: ' + commentDate.toLocaleString();
            commentDiv.appendChild(dateParagraph);

            commentSection.appendChild(commentDiv);
        });
    }

    fetchComments();

</script>

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
