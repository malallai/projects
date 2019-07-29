function like() {
    let post = this;
    $.ajax({
        url: '/post/' + post.id + '/like',
        type: 'POST',
        data: {
            type: type
        },
        success: function(msg) {
            console.log(msg);
        }
    });
}