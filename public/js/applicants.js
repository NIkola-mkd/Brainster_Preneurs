/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/applicants.js ***!
  \************************************/
$(function () {
  $(".apply").on("click", function () {
    var id = $(this).attr("id");
    approve(id);
  });
});

function approve(id) {
  $.ajax({
    url: "/api/accept/" + $("#projectID").val(),
    method: "PUT",
    data: {
      _token: $('meta[name="csrf-token"]').attr("content"),
      user_id: id
    },
    success: function success(response) {
      console.log(response);
    },
    error: function error(_error) {
      console.log(_error.responseJSON.errors.message);
      $("#error").html(_error.responseJSON.errors.message);
    }
  });
}
/******/ })()
;