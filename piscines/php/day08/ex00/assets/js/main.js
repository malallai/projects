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
    });
})