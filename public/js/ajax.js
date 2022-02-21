/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/ajax.js ***!
  \******************************/
$(function () {
  $("#all").prop("checked", true);
  var value = $("input[name='academies']:checked").val();
  fetchProjects(value);
  $("input[name = 'academies']").on("change", function () {
    value = $("input[name='academies']:checked").val();
    fetchProjects(value);
  });
  $("#applyModal .send").on("click", function () {
    $.ajax({
      url: "/api/apply/" + $("#projectID").val(),
      method: "POST",
      data: {
        _token: $('meta[name="csrf-token"]').attr("content"),
        id: $("#projectID").val(),
        message: $("#message").val()
      },
      success: function success(response) {
        console.log(response);
        $("#applyModal").modal("hide");
        swal("Application is sent!", "Please wait to be approved!", "success");
        fetchProjects(value);
        $("#message").val("");
      },
      error: function error(_error) {
        console.log(_error.responseJSON.errors.message);
        $("#error").html(_error.responseJSON.errors.message);
      }
    });
  });
});

function projects(data) {
  var authcheck = $('meta[name="auth-check"]').attr("content");
  var authcomplete = $('meta[name="auth-completed"]').attr("content");

  for (var i = 0; i < data.data.length; i++) {
    var card = "<div class=\"col-lg-12 col-md-10 col-12 my-7 \">\n                        <div class=\"card mb-3 rounded mt-5 \">\n                            <div class=\"row g-0\">\n                                <div class=\"col-lg-4 col-md-4 col-12\">\n                                    <div class=\"col-3 mx-auto\">\n                                        <div class=\"card-image\">\n                                <img src=\"avatars/" + data.data[i].author.image + "\" class=\" mx-auto project-image\" alt=\"...\">\n                            </div>\n                        </div>\n                        <div class=\"col-12\">\n                            <div class=\"row\">\n                                <div class=\"col-12\">\n                                    <p class=\"mt-5  text-center semi-bold-bolder\">" + data.data[i].author.name + " " + data.data[i].author.surname + "</p>\n                                    <p class=\"mt-1 orange-custom classic-bold text-center \">I'm " + data.data[i].author.academies.profession + "</p>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                    <div class=\"col-lg-8 col-md-7 col-12\">\n                        <div class=\"card-body \">\n                            <h5 class=\"card-title classic-bold\">" + data.data[i].title + "</h5>\n                            <p class=\"classic mt-3 showMore\">" + data.data[i].description + "</p>\n                            <button class=\"applicants btn btn-applicants p-lg-1 p-md-1 p-0\">\n                                <span class=\"font-applicants classic-bold\">" + data.data[i].users_count + "</span>\n                                <p class=\"font-applicants classic\">applicants</p>\n                            </button>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"card-footer bg-white\">\n                    <div class=\"row g-0\">\n                        <div class=\"col-lg-8 col-md-7 col-12 \">\n                            <div class=\"row mt-4 mx-auto\">\n                                <div class=\"col-6 text-center\">\n                                    <span class=\"gray-custom semi-bold-bolder text-center\">I'm looking for</span>\n                                </div>\n                                <div class=\"col-12 mt-2\">";

    for (var j = 0; j < data.data[i].academies.length; j++) {
      card += "\n                                    <span class=\"text-wrap academies-circles text-white text-center semi-bold bg-green-custom p-3\">" + data.data[i].academies[j].name + "</span>\n                               ";
    }

    var btn = "  </div>\n                        </div>\n                        </div>\n                        <div class=\"col-4 mt-5 \">\n                           <div class = 'd-grid gap-2 d-md-flex justify-content-md-end'>\n                                <button id = '".concat(data.data[i].id, "' class = 'btn btn-success px-5 applyBtn'>I AM IN</button>\n                            </div>\n                        </div>\n                         </div>             \n                </div>\n            </div>\n        </div>");

    if (authcomplete == "") {
      btn = "  </div>\n                        </div>\n                        </div>\n                        <div class=\"col-4 mt-5 \">\n                           <div class = 'd-grid gap-2 d-md-flex justify-content-md-end'>\n                                <button id = 'apply' class = 'btn btn-success px-5 applyBtn' disabled>I AM IN</button>\n                            </div>\n                        </div>\n                         </div>             \n                </div>\n            </div>\n        </div>";
    } else if (data.data[i].users_count > 0) {
      for (var k = 0; k < data.data[i].users.length; k++) {
        if (authcheck == data.data[i].users[k].id) {
          btn = "  </div>\n                        </div>\n                        </div>\n                        <div class=\"col-4 mt-5 \">\n                           <div class = 'd-grid gap-2 d-md-flex justify-content-md-end'>\n                                <button id = 'apply' class = 'btn btn-success px-5 applyBtn' disabled>I AM IN</button>\n                            </div>\n                        </div>\n                         </div>             \n                </div>\n            </div>\n        </div>";
        }
      }
    }

    $("#projectsCards").append(card + btn);
  }

  readMore();
  $(".applyBtn").on("click", function () {
    var id = $(this).attr("id");
    $("#projectID").val(id);
    $("#applyModal").modal("show");
  });
}

function readMore() {
  var show = 50;
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
}

function fetchProjects(value) {
  $("#pagination").twbsPagination("destroy");
  $.ajax({
    url: "/api/allProjects",
    method: "GET",
    cache: false,
    async: true,
    data: {
      category: value
    },
    success: function success(data) {
      var totalPages = data.last_page;

      if (totalPages == 1) {
        var page = 1;
        paginate(value, page);
      }

      $("#pagination").twbsPagination({
        totalPages: totalPages,
        visiblePages: 5,
        next: "Next",
        prev: "Prev",
        onPageClick: function onPageClick(event, page) {
          paginate(value, page);
        }
      });
    },
    error: function error(_error2) {
      console.log("error: ", _error2);
      alert(_error2.responseJSON.message);
    }
  });
}

function paginate(value, page) {
  $.ajax({
    url: "/api/allProjects?page=" + page,
    method: "GET",
    cache: false,
    async: true,
    data: {
      category: value
    },
    success: function success(data) {
      // totalPages = data.last_page;
      $(".card").hide();
      projects(data);
    },
    error: function error(_error3) {
      console.log("error: ", _error3);
      alert(_error3.responseJSON.message);
    }
  });
}
/******/ })()
;