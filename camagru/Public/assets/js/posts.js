function like() {
    let post = this;
    $.ajax({
        url: '/post/' + post.id + '/like',
        type: 'POST',
        success: function(msg) {
            console.log(msg);
        }
    });
}