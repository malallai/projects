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
            draw_ship(data[n]['ship'], data[n]['color']);
        }
    });

    $.ajax({
        url: './get_asteroids.php',
        dataType: 'json',
        type: 'POST',
        data: {
            val: "get"
        }
    }).done(function (data) {
        for (var n = 0; n < data.length; n++) {
            draw_asteroid(data[n]['asteroid']);
        }
    });

    function draw_ship(data, color) {
        for (var n = 0; n < data.length; n++) {
            var x = data[n]['x'];
            var y = data[n]['y'];
            $('tr[id=' + y + '] td[id=' + x + ']').addClass(color);
        }
    }

    function draw_asteroid(data) {
        for (var n = 0; n < data.length; n++) {
            var x = data[n]['x'];
            var y = data[n]['y'];
            $('tr[id=' + y + '] td[id=' + x + ']').addClass('asteroid');
        }
    }

})