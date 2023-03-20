function onWindowResize() {
    const resizeDelay = 200;
    window.setTimeout(function () {
        const e = $('.invesmentplan-holder').width();
        $("#invesmentplan").mapster("resize",e);
    }, resizeDelay);
}

$(document).ready(function(){
    $('#invesmentplan').mapster({
        fillColor: 'BA892F',
        fillOpacity: 0.6,
        clickNavigate: true
    });

    $('area[title]').each(function () {
        const elem = $(this), classAttr = $(this).attr('class');
        elem.qtip({
            content: $(this).attr('title'),
            position: {
                my: 'bottom center',
                at: 'bottom center',
                target: 'mouse',
                adjust: {x:0, y: -10} ,
            },
            style: {classes: classAttr,tip: {corner: true,mimic: false,width: 12, height: 8,border: true,offset: 0}},
            hide: {fixed: false, effect: false, show: false},
        });
    });
});

$(window).bind('resize', onWindowResize);
