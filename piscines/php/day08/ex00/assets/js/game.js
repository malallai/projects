$(function () {
    $.ajax({
        url: './get_players.php',
        dataType: 'json',
        type: 'POST',
        data: {
            val: "get"
        }
    }).done(function (data) {
        for (var n = 0; n < data.length; n++) {
            draw_ship(data[n]['ship']);
            console.log(data);
        }
    });

    function draw_ship(data) {
        for (var n = 0; n < data.length; n++) {
            console.log(data[n]);
            var x = data[n]['x'];
            var y = data[n]['y'];
            $('tr[id=' + y + '] td[id=' + x + ']').addClass('blue');
        }
    }

})