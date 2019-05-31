$(function () {
    var moves = $(".move-key");
    getPlayers();
    getAsteroids();

    moves.children().on("click", function () {
        console.log("click " + $(this));
        if ($(this).hasClass('move')) {
            var direction = $(this).attr('id');
            console.log(direction);
            $.ajax({
                url: './move.php',
                dataType: 'json',
                type: 'POST',
                data: {
                    direction: direction
                }
            }).done(function (data) {
                if (data == true) {
                    clear();
                    getPlayers();
                    getAsteroids();
                }
            });
        }
    });

    function clear() {
        $('td').removeClass('red').removeClass('blue').removeClass('asteroid');
    }

    function getPlayers() {
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
    }

    function getAsteroids() {
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
    }

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