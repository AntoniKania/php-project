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
                form.reset();
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
        commentDiv.setAttribute('class', 'comment')

        let contentParagraph = document.createElement('p');
        contentParagraph.textContent = comment.content;
        commentDiv.appendChild(contentParagraph);

        let authorParagraph = document.createElement('p');
        authorParagraph.textContent = 'Author: ' + comment.username;
        commentDiv.appendChild(authorParagraph);

        let dateParagraph = document.createElement('p');
        let commentDate = new Date(comment.comment_date);
        dateParagraph.textContent = 'Date: ' + commentDate.toLocaleString("en-UK");
        commentDiv.appendChild(dateParagraph);

        commentSection.appendChild(commentDiv);
    });
}

fetchComments();
