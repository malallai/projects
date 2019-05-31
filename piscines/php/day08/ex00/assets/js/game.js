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
        }
    });

    function draw_ship(data) {
        for (var n = 0; n < data.length; n++) {
            var test = $('td#y=' + data[n]['y'] + ' tr#x=' + data[n]['x']);
            console.log(test);
        }
    }

})