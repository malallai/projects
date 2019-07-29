function like() {
    let post = this;
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