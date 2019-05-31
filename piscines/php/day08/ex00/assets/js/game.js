$(function () {
    var moves = $(".move-key");

    moves.children().on("click", function () {
        console.log("click " + $(this));
        if ($(this).hasClass('move')) {
            var direction = $(this).attr('id');
            console.log(direction);
            $.ajax({
                url: './move.php',
                type: 'POST',
                data: {
                    direction: direction
                }
            }).done(function (data) {
                console.log(data);
            });
        }
    });

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