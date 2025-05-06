"use strict";
var KTModalSocialTemplate = (function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            (i = new bootstrap.Modal(
                document.querySelector("#modal_social_template")
            )),
                // (r = document.querySelector("#modal_add_shortLink_form")),
                (e = document.querySelector("#modal_social_template_cancel")),
                (o = document.querySelector("#modal_social_template_close")),
                e.addEventListener("click", function (t) {
                    i.hide();
                    // Swal.fire({
                    //     text: "Are you sure you would like to cancel?",
                    //     icon: "warning",
                    //     showCancelButton: !0,
                    //     buttonsStyling: !1,
                    //     confirmButtonText: "Yes, cancel it!",
                    //     cancelButtonText: "No, return",
                    //     customClass: {
                    //         confirmButton: "btn btn-primary",
                    //         cancelButton: "btn btn-active-light",
                    //     },
                    // }).then(function (t) {
                    //     t.value
                    //         ? i.hide()
                    //         : "cancel" === t.dismiss &&
                    //           Swal.fire({
                    //               text: "Your form has not been cancelled!.",
                    //               icon: "error",
                    //               buttonsStyling: !1,
                    //               confirmButtonText: "Ok, got it!",
                    //               customClass: {
                    //                   confirmButton: "btn btn-primary",
                    //               },
                    //           });
                    // });
                }),
                o.addEventListener("click", function (t) {
                    i.hide();
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalSocialTemplate.init();
});

$(document).on("click", ".view-data", function () {
    $("#modal_social_template").css({ opacity: 0.9 });

    var templateViewURL = $(this).data("single");

    $.get(templateViewURL, function (singleViewItem) {
        console.log(singleViewItem);
        $("#StTitle").html(singleViewItem.title);
        $("#StText").html(singleViewItem.postMessage);
        if (singleViewItem.postImage !== "imageNotSet") {
            $("#StImage").css("display", "block");
            $("#StImage").attr("src", singleViewItem.postImage);
            $("#StImageNotFound").html(""); // Clear "Image Not Found" if image is available
        } else {
            $("#StImage").css("display", "none");
            $("#StImageNotFound").html("Image Not Found");
        }

        $("#modal_social_template").css({ opacity: 1 });
    });
});

//
// Start Social Report Model
//
var KTModalSocialReport = (function () {
    var t, Cancel, Close, Model;
    //var t, e, o, n, r, i;
    return {
        init: function () {
            (Model = new bootstrap.Modal(
                document.querySelector("#modal_social_report")
            )),
                // (r = document.querySelector("#modal_add_shortLink_form")),
                (Cancel = document.querySelector(
                    "#modal_social_report_cancel"
                )),
                (Close = document.querySelector("#modal_social_report_close")),
                Close.addEventListener("click", function (t) {
                    Model.hide();
                    $("#postContainer").empty();

                    // Swal.fire({
                    //     text: "Are you sure you would like to cancel?",
                    //     icon: "warning",
                    //     showCancelButton: !0,
                    //     buttonsStyling: !1,
                    //     confirmButtonText: "Yes, cancel it!",
                    //     cancelButtonText: "No, return",
                    //     customClass: {
                    //         confirmButton: "btn btn-primary",
                    //         cancelButton: "btn btn-active-light",
                    //     },
                    // }).then(function (t) {
                    //     t.value
                    //         ? i.hide()
                    //         : "cancel" === t.dismiss &&
                    //           Swal.fire({
                    //               text: "Your form has not been cancelled!.",
                    //               icon: "error",
                    //               buttonsStyling: !1,
                    //               confirmButtonText: "Ok, got it!",
                    //               customClass: {
                    //                   confirmButton: "btn btn-primary",
                    //               },
                    //           });
                    // });
                }),
                Cancel.addEventListener("click", function (t) {
                    Model.hide();

                    $("#postContainer").empty();
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalSocialReport.init();
});

$(document).on("click", ".report-data", function () {
    $("#modal_social_report").css({ opacity: 0.9 });

    var templateReport = $(this).data("report");
    //console.log(templateReport);

    $.get(templateReport, function (singleReportItem) {
        console.log(singleReportItem);
        const data = singleReportItem;

        // Start --------------------------------------------------------------------------
        // const tableBody = document.querySelector("#postTable tbody");

        // const groupedData = data.reduce((acc, post) => {
        //     if (!acc[post.postDateTime]) {
        //         acc[post.postDateTime] = [];
        //     }
        //     acc[post.postDateTime].push(post);
        //     return acc;
        // }, {});

        // for (const postDateTime in groupedData) {
        //     groupedData[postDateTime].forEach((post, index) => {
        //         const messageMatch =
        //             post.postMessage.match(/"message":"(.*?)"/);
        //         const message = messageMatch
        //             ? messageMatch[1]
        //             : post.postMessage;
        //         const row = document.createElement("tr");
        //         row.innerHTML = `
        //             ${
        //                 index === 0
        //                     ? `<td rowspan="${groupedData[postDateTime].length}">${postDateTime}</td>`
        //                     : ""
        //             }
        //             <td>${post.socialMedia}</td>
        //             <td>${message}</td>
        //             <td>${post.totalTryingNumber}</td>
        //         `;
        //         tableBody.appendChild(row);
        //     });
        // }
        // End----------------------------------------------------

        //Start ------------------------------------------------------
        const postContainer = document.getElementById("postContainer");

        const groupedData = data.reduce((acc, post) => {
            if (!acc[post.postDateTime]) {
                acc[post.postDateTime] = [];
            }
            acc[post.postDateTime].push(post);
            return acc;
        }, {});

        let index = 0;
        for (const postDateTime in groupedData) {
            const card = document.createElement("div");
            card.className = "card mb-5";

            const headerId = `heading${index}`;
            const collapseId = `collapse${index}`;

            card.innerHTML = `
                <div class="card-header" id="${headerId}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#${collapseId}" aria-expanded="true" aria-controls="${collapseId}">
                            Post Date Time: ${postDateTime}
                        </button>
                    </h5>
                </div>
                <div id="${collapseId}" class="collapse show ${
                index === 0 ? "show" : ""
            }" aria-labelledby="${headerId}" data-parent="#postContainer">
                    <div class="card-body">
                        ${groupedData[postDateTime]
                            .map((post) => {
                                const messageMatch =
                                    post.postMessage.match(/"message":"(.*?)"/);
                                const message = messageMatch
                                    ? messageMatch[1]
                                    : post.postMessage;

                                const messageStatusMatch =
                                    post.postMessage.match(/"status":"(.*?)"/);
                                const statusMessage = messageStatusMatch
                                    ? messageStatusMatch[1]
                                    : post.postMessage;

                                return `
                                <p><strong>Post Message:</strong> ${message}</p>

                                <hr>
                            `;
                            })
                            .join("")}
                    </div>
                </div>
            `;

            postContainer.appendChild(card);
            index++;
        }
        //End ------------------------------------------------------

        // $("#StTitle").html(singleViewItem.title);
        // $("#StText").html(singleViewItem.postMessage);
        // $("#StImage").attr("src", singleViewItem.postImage);
        $("#modal_social_report").css({ opacity: 1 });
    });
});

//<p><strong>Social Media:</strong> ${post.socialMedia}</p>
//<p><strong>Post Message:</strong> ${message}</p>
//<p><strong>Post Status:</strong>  ${statusMessage}</p>
//<p><strong>Total Trying Number:</strong> ${post.totalTryingNumber}</p>
