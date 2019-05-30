$(function () {
    var new_game = $("#new-game");
    var scores = $("#scores");
    var form = $("#play-form");

    new_game.on("click", function () {
        $('#new-game-row').removeClass('hidden');
        $('#scores-row').addClass('hidden');
        new_game.addClass('active');
        scores.removeClass('active');
    });

    scores.on("click", function () {
        $('#new-game-row').addClass('hidden');
        $('#scores-row').removeClass('hidden');
        new_game.removeClass('active');
        scores.addClass('active');
    });

    form.submit(function (event) {
        event.preventDefault();
        $('.container').html(null);
        var p1 = $("#player1").val();
        var p2 = $("#player2").val();
        console.log("test1");
        $.ajax({
            url: './init_game.php',
            type: 'POST',
            data: {
                player1: p1,
                player2: p2
            }
        }).done(function (data) {
            console.log("test 2");
            refresh_game();
        });
    });

    function refresh_game() {
        $.ajax({
            url: './get_game.php',
            type: 'POST',
            dataType: 'json',
            data: {
                val: "get"
            }
        }).done(function (data) {
            console.log(data);
        });
    }
})