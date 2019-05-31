$(function () {
    var new_game = $("#new-game");
    var scores = $("#scores");
    var form = $("#play-form");

    new_game.on("click", function () {
        $('.new-game-content').removeClass('hidden');
        $('.scores-content').addClass('hidden');
        new_game.addClass('active');
        scores.removeClass('active');
    });

    scores.on("click", function () {
        $('.new-game-content').addClass('hidden');
        $('.scores-content').removeClass('hidden');
        new_game.removeClass('active');
        scores.addClass('active');
    });

    form.submit(function (event) {
        event.preventDefault();
        var p1 = $(this).find("input[name=player1]").val();
        var p2 = $(this).find("input[name=player2]").val();
        $('.container').html(null);
        $.ajax({
            url: './init_game.php',
            type: 'POST',
            data: {
                player1: p1,
                player2: p2
            }
        }).done(function (data) {
            init_game();
        });
    });

    function init_game() {
        $.ajax({
            url: './get_game.php',
            type: 'POST',
            dataType: 'json',
            data: {
                val: "get"
            }
        }).done(function (data) {
            var player1 = data['players'][0];
            var player2 = data['players'][1];

        });
    }
})