let orderIndex = 0;

function nextSlide() {
    orderIndex %= slideOrder.length;

    let active = $('#slides').find('.slide.active');
    let next = $('#slides').find('#slide'+ slideOrder[orderIndex]);

    active.removeClass('active').fadeOut(250, function() {
        if ($('iframe', next).length) {
            let url = $('iframe', next).attr('src').split('#');
            $('iframe', next).attr('src', url[0] + '#'+ makeid(12))
        }
        next.addClass('active').fadeIn(250);
        if (next.data('slide')) {
            next.data('slide').show();
        }
        if (active.data('slide')) {
            active.data('slide').hide();
        }
    });

    let timeoutTime = parseInt(next.data('duration')) * 1000;

    $('#progress-bar .progress').css('width', 0).animate({
        width: '100%'
    }, timeoutTime, function() {
        nextSlide();
    });

    orderIndex++;
}

function makeid(length) {
    let text = "";
    let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (let i = 0; i < length; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

$('document').ready(function() {
    $('#slides .slide').first().addClass('active');
    nextSlide();
    $('#loading').hide();
});