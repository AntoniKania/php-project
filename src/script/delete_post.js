const deleteButton = document.getElementById('deleteButton');

deleteButton.addEventListener('click', deletePost);

function deletePost() {
    const confirmDelete = confirm('Are you sure you want to delete this post?');
    if (confirmDelete) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../script/delete_post.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log(xhr.response);
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('Post deleted successfully.');
                    window.location.replace("../pages/index.php");
                } else {
                    alert('Error deleting post.');
                }
            }
        };
        xhr.send('postId=' + postId);
    }
}
