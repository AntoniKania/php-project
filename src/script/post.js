const urlParams = new URLSearchParams(window.location.search);
const postId = urlParams.get('id');

function fetchPost(postId) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../script/fetch_post.php?postId=' + postId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.success) {
                let post = response.post;
                console.log(post);
                updatePostDOM(post);
            }
        }
    };
    xhr.send();
}

function updatePostDOM(post) {
    let postContainer = document.getElementById('postContainer');
    postContainer.innerHTML = '';

    let titleElement = document.createElement('h2');
    titleElement.setAttribute("id", "postTitle");
    titleElement.textContent = post.title;
    postContainer.appendChild(titleElement);

    let contentElement = document.createElement('p');
    contentElement.setAttribute("id", "postContent");
    contentElement.textContent = post.content;
    postContainer.appendChild(contentElement);

    let publicationDateElement = document.createElement('p');
    let publicationDate = new Date(post.publicationDate);
    publicationDateElement.textContent = 'Date: ' + publicationDate.toLocaleString();
    publicationDateElement.setAttribute("id", "postPublicationDate");
    postContainer.appendChild(publicationDateElement);
}

fetchPost(postId);