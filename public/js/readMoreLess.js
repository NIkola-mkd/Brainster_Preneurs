/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/readMoreLess.js ***!
  \**************************************/
$(function () {
  var show = 70;
  var moretext = "show more ";
  var lesstext = "show less";
  $(".showMore").each(function () {
    var content = $(this).html();

    if (content.length > show) {
      var cont = content.substr(0, show);
      var hide = content.substr(show, content.length - show);
      var html = cont + "<span class = 'text-end'>" + '&nbsp;</span><span class="morecontent"><span>' + hide + '</span>&nbsp;&nbsp;<a href="" class="morelink orange-custom ">' + moretext + "</a></span>";
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
/******/ })()
;