$(function () {
    $.ajax({
        url: './get_players.php',
        dataType: 'json',
        type: 'POST',
        data: {
            val: "get"
        }
    }).done(function (data) {
        console.log(data);
    });
})