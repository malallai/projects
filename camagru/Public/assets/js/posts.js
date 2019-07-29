function like() {
    event.preventDefault();
    let post = event.srcElement;
    let url = '/post/' + post.id + '/like';
    console.log(url);
    $.ajax({
        url: url,
        type: 'POST',
        success: function(msg) {
            console.log(msg);
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