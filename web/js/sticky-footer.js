$(window).bind("load", function () {
    bindFooter();
});

$(window).resize(function () {
    bindFooter();
});

function bindFooter()
{
    var footer = $("#footer");
    var pos = footer.position();
    var height = $(window).height();
    height = height - pos.top;
    height = height - footer.height();
    if (height > 0) {
        footer.css({
            'margin-top': height + 'px'
        });
    }
}