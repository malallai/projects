$(function () {
    var moves = $(".move-key");
    getPlayers();
    getAsteroids();

    document.addEventListener('keydown', function(e) {
        switch (e.keyCode) {
            case 38:
                $('i[id=0]').click();
                break;
            case 40:
                $('i[id=1]').click();
                break;
            case 37:
                $('i[id=2]').click();
                break;
            case 39:
                $('i[id=3]').click();
                break;
            default : break;
        }
    });

    var ships = [];

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
                console.log(data);
                if (data) {
                    clearShips();
                    getPlayers();
                }
            });
        }
    });

    function clear() {
        $('td').removeClass('red').removeClass('blue').removeClass('asteroid');
    }

    function clearShips() {
        for (var n = 0; n < 2; n++) {
            for (var m = 0; m < ships[n].length; m++) {
                var x = ships[n][m]['x'];
                var y = ships[n][m]['y'];
                $('tr[id=' + y + '] td[id=' + x + ']').removeClass('red').removeClass('blue');
            }
        }
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
                ships[n] = data[n]['ship'];
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