$(function () {
    var new_game = $("#new-game");
    var scores = $("#scores");

    new_game.on("click", function () {
        $('#new-game-form').removeClass('hidden');
        $('#scores-row').addClass('hidden');
        new_game.addClass('active');
        scores.removeClass('active');
    });

    scores.on("click", function () {
        $('#new-game-form').addClass('hidden');
        $('#scores-row').removeClass('hidden');
        new_game.removeClass('active');
        scores.addClass('active');
    });
})