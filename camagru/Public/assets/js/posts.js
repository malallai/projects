function postReady() {
    let new_com = document.getElementsByClassName("new-comment");
    for (let item of new_com) {
        item.addEventListener("submit", function (event) {
            newComment();
        });
    }
}

function like(post) {
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
            if (msg['status'].includes('error')) {
                if (msg['status'].includes('log'))
                    window.location = "/user";
                else
                    new_snackbar("Une erreur est survenue. Merci de réessayer. (" + msg['status'] + ")");
                return;
            }
            let postParent = document.getElementById("post " + post.id);
            let count = postParent.getElementsByClassName("like-counts")[0];
            let child = post.firstChild;
            if (msg['status'] === "unlike") {
                child.className = "far fa-heart";
            } else if (msg['status'] === "like") {
                child.className = "fas fa-heart red";
            }
            count.id = msg['likes'];
            count.innerHTML = count.id + (count.id == 0 || count.id == 1 ? " j'aime" : " j'aimes");
        }
    });
}

function deletePost(post) {
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
            if (msg['status'].includes('error')) {
                if (msg['status'].includes('log'))
                    window.location = "/user";
                else
                    new_snackbar("Une erreur est survenue. Merci de réessayer. (" + msg['status'] + ")");
            } else if (msg['status'] === "deleted")
                location.reload();
        }
    });
}

function newComment(input) {
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
            if (msg['status'].includes('error')) {
                if (msg['status'].includes('log'))
                    window.location = "/user";
                else
                    new_snackbar("Une erreur est survenue. Merci de réessayer. (" + msg['status'] + ")");
                return;
            }
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
                post.value = "";
            } else if (msg['status'] === "spam") {
                new_snackbar("Merci de ne pas abuser des commentaires.");
            }
        }
    });
}

function copyLink(input) {
    document.getElementById("post-link-" + input.id).classList.remove("hidden");
}

function focusCommentInput() {
    let body = document.getElementsByTagName("body")[0];
    body.setAttribute("focus_comment", "");
}

function outFocusCommentInput() {
    let body = document.getElementsByTagName("body")[0];
    body.removeAttribute("focus_comment");
}

function showComments(element) {
    let parent = document.getElementById("post " + element.id);
    if (parent.hasAttribute("show_comments")) {
        parent.removeAttribute("show_comments");
    } else {
        let comments = parent.getElementsByClassName("comments")[0].getElementsByClassName("row")[0];
        parent.setAttribute("show_comments", "");
        comments.scrollTop = comments.scrollHeight;
    }
}