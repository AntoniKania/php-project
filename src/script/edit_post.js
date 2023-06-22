const editButton = document.getElementById('editButton');

editButton.addEventListener('click', editPost);

function editPost() {
    let postElement = document.getElementById('postContainer');
    let contentElement = document.getElementById("postContent");
    let currentContent = contentElement.textContent;

    let textarea = document.createElement('textarea');
    textarea.value = currentContent;

    contentElement.parentNode.replaceChild(textarea, contentElement);

    let saveButton = document.createElement('button');
    saveButton.textContent = 'Save';

    saveButton.addEventListener('click', function() {
        let updatedContent = textarea.value;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../script/update_post.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('postId=' + postId + '&content=' + encodeURIComponent(updatedContent));
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                console.log(xhr.response);
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    console.log(response.message);
                    fetchPost(postId);
                }
            }
        };

    });

    postElement.appendChild(saveButton);
}