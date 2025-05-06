"use strict";
var KTModalSocialTemplate = (function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            (i = new bootstrap.Modal(
                document.querySelector("#modal_email_template")
            )),
                // (r = document.querySelector("#modal_add_shortLink_form")),
                (e = document.querySelector("#modal_email_template_cancel")),
                (o = document.querySelector("#modal_email_template_close")),
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
    $("#modal_email_template").css({ opacity: 0.9 });

    var templateViewURL = $(this).data("single");

    var myValue = $(this).text().trim();

    $.get(templateViewURL, function (singleViewItem) {
        console.log(singleViewItem);
        $("#StTitle").html(myValue);
        $("#StCSS").html(singleViewItem.css);
        $("#StHTML").html(singleViewItem.html);
        //$("#StText").html(singleViewItem.postMessage);
        // if (singleViewItem.postImage !== "imageNotSet") {
        //     $("#StImage").css("display", "block");
        //     $("#StImage").attr("src", singleViewItem.postImage);
        //     $("#StImageNotFound").html(""); // Clear "Image Not Found" if image is available
        // } else {
        //     $("#StImage").css("display", "none");
        //     $("#StImageNotFound").html("Image Not Found");
        // }

        $("#modal_email_template").css({ opacity: 1 });
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
                document.querySelector("#modal_campaign_email")
            )),
                // (r = document.querySelector("#modal_add_shortLink_form")),
                (Cancel = document.querySelector(
                    "#modal_campaign_email_cancel"
                )),
                (Close = document.querySelector("#modal_campaign_email_close")),
                Close.addEventListener("click", function (t) {
                    Model.hide();
                    $("#emailStatusTable tbody").empty();

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

                    $("#emailStatusTable tbody").empty();
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalSocialReport.init();
});

$(document).on("click", ".email-list", function () {
    const campaignEmailData = $(this).data("campaignemail"); // Get the campaign email data URL
    //console.log(campaignEmailData);

    // Open the modal with initial opacity
    $("#modal_campaign_email").css({ opacity: 0.9 });

    // Clear previous table rows to avoid duplicates
    const tableBody = $("#emailStatusTable tbody");
    //tableBody.empty();

    // Make an AJAX GET request to fetch the campaign data
    $.get(campaignEmailData, function (singleReportItem) {
        // console.log(singleReportItem);

        // Populate the table with new data
        singleReportItem.forEach((item) => {
            const statusText = item.status === 1 ? "Active" : "Deactive";
            console.log(item.email);
            const row = `
              <tr>
                <td>${item.email}</td>
                <td>${statusText}</td>
              </tr>
            `;
            tableBody.append(row);
        });

        // Make the modal fully visible
        $("#modal_campaign_email").css({ opacity: 1 });
    }).fail(function (error) {
        // Handle AJAX errors
        console.error("Error fetching campaign data:", error);
        alert("Failed to load campaign data. Please try again.");
    });
});

//<p><strong>Social Media:</strong> ${post.socialMedia}</p>
//<p><strong>Post Message:</strong> ${message}</p>
//<p><strong>Post Status:</strong>  ${statusMessage}</p>
//<p><strong>Total Trying Number:</strong> ${post.totalTryingNumber}</p>

$(document).ready(function () {
    $("#emailTemplateId").on("change", function () {
        // Get the selected option
        var selectedOption = $(this).find("option:selected");
        console.log(selectedOption);
        // Get the data-subject attribute of the selected option
        var subject = selectedOption.data("subject");

        // Set the value of the emailSubject input
        $("#emailSubject").val(subject);
        $("#emailSubject").removeAttr("readonly");
    });
});
