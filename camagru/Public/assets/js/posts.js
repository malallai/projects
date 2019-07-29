function like() {
    event.preventDefault();
    let post = event.srcElement;
    let url = '/post/like';
    let token = document.getElementsByClassName("token")[0];
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id: post.id,
            token: token.value
        },
        success: function(msg) {
            let postParent = document.getElementById("post " + post.id);
            let count = postParent.getElementsByClassName("like-counts")[0];
            if (msg.split("/")[0] === "unlike") {
                post.className = "far fa-heart";
            } else if (msg.split("/")[0] === "like") {
                post.className = "fas fa-heart red";
            }
            count.id = msg.split("/")[1];
            count.innerHTML = count.id + (count.id == 0 || count.id == 1 ? " j'aime" : " j'aimes");
        }
    });
}

function deletePost() {
    event.preventDefault();
    let post = event.srcElement;
    let url = '/post/delete';
    let token = document.getElementsByClassName("token")[0];
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id: post.id,
            token: token.value
        },
        success: function (msg) {
            if (msg === "deleted")
                location.reload();
        }
    });
}

function focusCommentInput() {
    event.preventDefault();
    let body = document.getElementsByTagName("body")[0];
    body.setAttribute("focus_comment", "");
}

function outFocusCommentInput() {
    event.preventDefault();
    let body = document.getElementsByTagName("body")[0];
    body.removeAttribute("focus_comment");
}

function showComments() {
    event.preventDefault();
    let parent = document.getElementById("post " + event.srcElement.id);
    if (parent.hasAttribute("show_comments")) {
        parent.removeAttribute("show_comments");
    } else {
        parent.setAttribute("show_comments", "");
    }
}