$(document).ready(function () {
    let show = 70;
    let moretext = "show more ";
    let lesstext = "show less";

    $(".showMore").each(function () {
        let content = $(this).html();

        if (content.length > show) {
            let cont = content.substr(0, show);
            let hide = content.substr(show, content.length - show);

            let html =
                cont +
                "<span class = 'text-end'>" +
                '&nbsp;</span><span class="morecontent"><span>' +
                hide +
                '</span>&nbsp;&nbsp;<a href="" class="morelink orange-custom ">' +
                moretext +
                "</a></span>";

            $(this).html(html);
        }
    });

    $(".morelink").click(function () {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
