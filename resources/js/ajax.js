$(function () {
    var authcheck = $('meta[name="auth-check"]').attr("content");

    $.ajax({
        url: "/api/allProjects",
        method: "GET",
        success: function (data) {
            console.log(data);
            projects(data);
        },
        error: function (error) {
            console.log("error: ", error);
        },
    });
});

function projects(data) {
    for (let i = 0; i < data.data.length; i++) {
        let card =
            `<div class="col-lg-12 col-md-10 col-12 my-7 ">
                        <div class="card mb-3 rounded mt-5 ">
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
                                <div class="col-6 text-center">
                                    <span class="gray-custom semi-bold-bolder text-center">I'm looking for</span>
                                </div>
                                <div class="col-12">`;

        for (let j = 0; j < data.data[i].academies.length; j++) {
            card +=
                `
                                    <span class="text-wrap academies-circles text-white text-center semi-bold bg-green-custom p-1">` +
                data.data[i].academies[j].name +
                `</span>
                               `;
        }

        if (data.data[i].users_count > 0) {
            // console.log("ulegna");

            for (let k = 0; k < data.data[i].users.length; k++) {
                console.log("num: " + i + " " + data.data[i].users[k].id);
            }

            // card += `<div class="col-4">
            //                 <img src="custom_icons/assembled.png" class="assembled " alt="">
            //             </div>`;
        }
        card += ` </div>
                
                            </div>
                        </div></div>
                </div>
            </div>
        </div>`;

        $("#projectsCards").append(card);
    }
}
