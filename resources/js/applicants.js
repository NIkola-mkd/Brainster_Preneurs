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
            user_id: id,
        },
        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.log(error.responseJSON.errors.message);
            $("#error").html(error.responseJSON.errors.message);
        },
    });
}
