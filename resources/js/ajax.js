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
                message: $("#message").val(),
            },
            success: function (response) {
                console.log(response);
                $("#applyModal").modal("hide");
                swal(
                    "Application is sent!",
                    "Please wait to be approved!",
                    "success"
                );
                fetchProjects(value);
                $("#message").val("");
            },
            error: function (error) {
                console.log(error.responseJSON.errors.message);
                $("#error").html(error.responseJSON.errors.message);
            },
        });
    });
});

function projects(data) {
    var authcheck = $('meta[name="auth-check"]').attr("content");
    var authcomplete = $('meta[name="auth-completed"]').attr("content");
    for (let i = 0; i < data.data.length; i++) {
        let card =
            `<div class="col-lg-12 col-md-12 col-12 my-7 ">
                        <div class="card mb-lg-3 mb-5 rounded mt-5 ">
                            <div class="row g-0">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="col-3 mx-auto">
                                        <div class="card-image">
                                <img src="avatars/` +
            data.data[i].author.image +
            `" class=" mx-auto project-image" alt="...">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <p class="mt-5  text-center semi-bold-bolder">` +
            data.data[i].author.name +
            ` ` +
            data.data[i].author.surname +
            `</p>
                                    <p class="mt-1 orange-custom classic-bold text-center ">I'm ` +
            data.data[i].author.academies.profession +
            `</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="card-body ">
                            <h5 class="card-title classic-bold">` +
            data.data[i].title +
            `</h5>
                            <p class="classic mt-3 showMore">` +
            data.data[i].description +
            `</p>
                            <button class="applicants btn btn-applicants p-lg-1 p-md-1 p-0">
                                <span class="font-applicants classic-bold">` +
            data.data[i].users_count +
            `</span>
                                <p class="font-applicants classic">applicants</p>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="row g-0">
                        <div class="col-lg-8 col-md-7 col-12 ">
                            <div class="row mt-4 mx-auto">
                                <div class="col-lg-6 col-12 text-center">
                                    <span class="gray-custom semi-bold-bolder text-center">I'm looking for</span>
                                </div>
                                <div class="col-12 mt-2">`;

        for (let j = 0; j < data.data[i].academies.length; j++) {
            card +=
                `
                                    <span class="text-wrap academies-circles text-white text-center semi-bold bg-green-custom p-lg-3 p-1">` +
                data.data[i].academies[j].name +
                `</span>
                               `;
        }
        var btn = `  </div>
                        </div>
                        </div>
                        <div class="col-md-4 col-12 mt-5 ">
                           <div class = 'd-grid gap-2 d-md-flex justify-content-md-end'>
                                <button id = '${data.data[i].id}' class = 'btn btn-success px-lg-5 px-2 applyBtn'>I AM IN</button>
                            </div>
                        </div>
                         </div>             
                </div>
            </div>
        </div>`;
        if (authcomplete == "") {
            btn = `  </div>
                        </div>
                        </div>
                        <div class="col-md-4 col-12 mt-5 ">
                           <div class = 'd-grid gap-2 d-md-flex justify-content-md-end'>
                                <button id = 'apply' class = 'btn btn-success px-lg-5 px-2 applyBtn' disabled>I AM IN</button>
                            </div>
                        </div>
                         </div>             
                </div>
            </div>
        </div>`;
        } else if (data.data[i].users_count > 0) {
            for (let k = 0; k < data.data[i].users.length; k++) {
                if (authcheck == data.data[i].users[k].id) {
                    btn = `  </div>
                        </div>
                        </div>
                        <div class="col-md-4 col-12 mt-5 ">
                           <div class = 'd-grid gap-2 d-md-flex justify-content-md-end'>
                                <button id = 'apply' class = 'btn btn-success px-lg-5 px-2 applyBtn' disabled>I AM IN</button>
                            </div>
                        </div>
                         </div>             
                </div>
            </div>
        </div>`;
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
    let show = 50;
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
}

function fetchProjects(value) {
    $("#pagination").twbsPagination("destroy");

    $.ajax({
        url: "/api/allProjects",
        method: "GET",
        cache: false,
        async: true,
        data: {
            category: value,
        },
        success: function (data) {
            var totalPages = data.last_page;
            if (totalPages == 1) {
                let page = 1;
                paginate(value, page);
            }
            $("#pagination").twbsPagination({
                totalPages: totalPages,
                visiblePages: 5,
                next: "Next",
                prev: "Prev",
                onPageClick: function (event, page) {
                    paginate(value, page);
                },
            });
        },
        error: function (error) {
            console.log("error: ", error);
            alert(error.responseJSON.message);
        },
    });
}

function paginate(value, page) {
    $.ajax({
        url: "/api/allProjects?page=" + page,
        method: "GET",
        cache: false,
        async: true,
        data: {
            category: value,
        },
        success: function (data) {
            // totalPages = data.last_page;
            $(".card").hide();
            projects(data);
        },
        error: function (error) {
            console.log("error: ", error);
            alert(error.responseJSON.message);
        },
    });
}
