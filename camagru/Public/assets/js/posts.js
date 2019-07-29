function postLoad() {
    let new_com = document.getElementsByClassName("new-comment");
    for (let item of new_com) {
        item.addEventListener("submit", function (event) {
            newComment();
        });
    }
}

function like() {
    event.preventDefault();
    let post = event.srcElement;
    let url = '/post/like';
    let token = document.getElementsByClassName("token")[0];
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            id: post.id,
            token: token.value
        },
        success: function(msg) {
            let postParent = document.getElementById("post " + post.id);
            let count = postParent.getElementsByClassName("like-counts")[0];
            if (msg['status'] === "unlike") {
                post.className = "far fa-heart";
            } else if (msg['status'] === "like") {
                post.className = "fas fa-heart red";
            }
            count.id = msg['likes'];
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
        dataType: 'json',
        data: {
            id: post.id,
            token: token.value
        },
        success: function (msg) {
            if (msg['status'] === "deleted")
                location.reload();
        }
    });
}

function newComment() {
    event.preventDefault();
    let input = event.srcElement;
    let url = '/post/comment';
    let token = document.getElementsByClassName("token")[0];
    let post = document.getElementById("input " + input.id);
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            id: input.id,
            token: token.value,
            comment: post.value
        },
        success: function(msg) {
            if (msg['status'] === "ok") {
                let row = document.getElementById("post " + input.id).getElementsByClassName("comments")[0].getElementsByClassName("row")[0];
                let newComment = document.createElement("div");
                let commentParent = newComment;
                let tmp;
                newComment.className = "comment";
                newComment.prepend((newComment = document.createElement("div")));
                newComment.className = "content";
                newComment.prepend((tmp = document.createElement("div")));
                tmp.className = "comment-message";
                tmp.innerHTML = msg['message'];
                newComment.prepend((tmp = document.createElement("div")));
                tmp.className = "comment-author";
                tmp.prepend((tmp = document.createElement("a")));
                tmp.innerHTML = msg['author'];
                row.append(commentParent);
            }
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