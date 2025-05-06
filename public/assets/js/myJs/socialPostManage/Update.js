"use strict";
var KTModalShortLinkUpdate = (function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            (i = new bootstrap.Modal(document.querySelector("#modal_update"))),
                (r = document.querySelector("#modal_update_form")),
                (t = r.querySelector("#modal_update_submit")),
                (e = r.querySelector("#modal_update_cancel")),
                (o = r.querySelector("#modal_update_close")),
                (n = FormValidation.formValidation(r, {
                    fields: {
                        titleUpdate: {
                            validators: {
                                notEmpty: {
                                    message: "Title is required",
                                },
                            },
                        },
                        "socialMediaUpdate[]": {
                            validators: {
                                notEmpty: {
                                    message: "Social Media is required",
                                },
                            },
                        },
                        "socialTemplateUpdate[]": {
                            validators: {
                                notEmpty: {
                                    message: "Social Template is required",
                                },
                            },
                        },

                        postRepeatTypeUpdate: {
                            validators: {
                                // notEmpty: {
                                //     message: "Post Repeat Type is required",
                                // },
                                callback: {
                                    message:
                                        "Post Repeat Type is required if Post Repeat is Allowed",
                                    callback: function (input) {
                                        const isChecked =
                                            document.getElementById(
                                                "postRepeatUpdate"
                                            ).checked;
                                        return (
                                            !isChecked ||
                                            (isChecked &&
                                                input.value.trim() !== "")
                                        );
                                    },
                                },
                            },
                        },

                        postStartDateUpdate: {
                            validators: {
                                // notEmpty: {
                                //     message: "Post Repeat Type is required",
                                // },
                                callback: {
                                    message:
                                        "Post Start Date is required if Post Repeat is Allowed",
                                    callback: function (input) {
                                        const isChecked =
                                            document.getElementById(
                                                "postRepeatUpdate"
                                            ).checked;
                                        return (
                                            !isChecked ||
                                            (isChecked &&
                                                input.value.trim() !== "")
                                        );
                                    },
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                })),
                t.addEventListener("click", function (e) {
                    e.preventDefault(),
                        n &&
                            n.validate().then(function (e) {
                                console.log("validated!"),
                                    "Valid" == e
                                        ? (t.setAttribute(
                                              "data-kt-indicator",
                                              "on"
                                          ),
                                          (t.disabled = !0),
                                          setTimeout(function () {
                                              let form =
                                                  $("#modal_update_form")[0];
                                              let data = new FormData(form);
                                              var actionURL =
                                                  form.getAttribute(
                                                      "data-kt-action-url"
                                                  );
                                              console.log(data);
                                              $.ajax({
                                                  headers: {
                                                      "X-CSRF-TOKEN": $(
                                                          'meta[name="_token"]'
                                                      ).attr("content"),
                                                  },
                                                  url: actionURL,
                                                  type: "POST",
                                                  data: data,
                                                  dataType: "JSON",
                                                  processData: false,
                                                  contentType: false,

                                                  success: function (response) {
                                                      //console.log(response);
                                                      t.removeAttribute(
                                                          "data-kt-indicator"
                                                      );
                                                      t.disabled = !1;

                                                      if (response.errors) {
                                                          // Start Error Message

                                                          Swal.fire({
                                                              text: response.errors,
                                                              icon: "error",
                                                              buttonsStyling:
                                                                  !1,
                                                              confirmButtonText:
                                                                  "Ok, got it!",
                                                              customClass: {
                                                                  confirmButton:
                                                                      "btn btn-primary",
                                                              },
                                                              timer: 5000,
                                                          });

                                                          // End Error Message
                                                      } else {
                                                          // Start Success Message
                                                          t.removeAttribute(
                                                              "data-kt-indicator"
                                                          ),
                                                              (t.disabled = !1),
                                                              Swal.fire({
                                                                  text: response.success,
                                                                  icon: "success",
                                                                  buttonsStyling:
                                                                      !1,
                                                                  confirmButtonText:
                                                                      "Ok, got it!",
                                                                  customClass: {
                                                                      confirmButton:
                                                                          "btn btn-primary",
                                                                  },
                                                                  allowOutsideClick: false,
                                                                  allowEscapeKey: false,
                                                                  timer: 2000,
                                                              }).then(function (
                                                                  t
                                                              ) {
                                                                  var rr =
                                                                      r.getAttribute(
                                                                          "data-kt-redirect"
                                                                      );
                                                                  window.location.href =
                                                                      rr;
                                                                  //   $(
                                                                  //       ".shortLinkDivRefresh"
                                                                  //   ).load(
                                                                  //       location.href +
                                                                  //           " .shortLinkDivRefresh"
                                                                  //   );
                                                                  //   r.reset(),
                                                                  //       i.hide();
                                                              });
                                                          // End Success Message
                                                      }
                                                  },
                                                  // error: function (
                                                  // ) {
                                                  // },
                                              });

                                              //   t.removeAttribute(
                                              //       "data-kt-indicator"
                                              //   ),
                                              //       Swal.fire({
                                              //           text: "Form has been successfully submitted!",
                                              //           icon: "success",
                                              //           buttonsStyling: !1,
                                              //           confirmButtonText:
                                              //               "Ok, got it!",
                                              //           customClass: {
                                              //               confirmButton:
                                              //                   "btn btn-primary",
                                              //           },
                                              //       }).then(function (e) {
                                              //           e.isConfirmed &&
                                              //               (i.hide(),
                                              //               (t.disabled = !1),
                                              //               (window.location =
                                              //                   r.getAttribute(
                                              //                       "data-kt-redirect"
                                              //                   )));
                                              //       });
                                          }, 2e3))
                                        : Swal.fire({
                                              text: "Sorry, looks like there are some errors detected, please try again.",
                                              icon: "error",
                                              buttonsStyling: !1,
                                              confirmButtonText: "Ok, got it!",
                                              customClass: {
                                                  confirmButton:
                                                      "btn btn-primary",
                                              },
                                          });

                                // console.log("validated!"),
                                //     "Valid" == e
                                //         ? (t.setAttribute(
                                //               "data-kt-indicator",
                                //               "on"
                                //           ),
                                //           (t.disabled = !0),
                                //           setTimeout(function () {
                                //               let form =
                                //                   $("#modal_update_form")[0];
                                //               // let data = new FormData(form);
                                //               var data = {
                                //                   title: $(
                                //                       "#titleUpdate"
                                //                   ).val(),
                                //                   emailSubject: $(
                                //                       "#emailSubjectUpdate"
                                //                   ).val(),
                                //                   description:
                                //                       $(
                                //                           "#descriptionUpdate"
                                //                       ).val(),
                                //               };
                                //               console.log(data);
                                //               var actionURL =
                                //                   form.getAttribute(
                                //                       "data-kt-action-url"
                                //                   );
                                //               console.log(actionURL);
                                //               $.ajax({
                                //                   headers: {
                                //                       "X-CSRF-TOKEN": $(
                                //                           'meta[name="_token"]'
                                //                       ).attr("content"),
                                //                   },
                                //                   type: "PUT",
                                //                   url: actionURL,
                                //                   data: data,
                                //                   dataType: "json",
                                //                   //processData: false,
                                //                   //contentType: false,
                                //                   // cache: false,
                                //                   success: function (response) {
                                //                       //console.log(response);
                                //                       t.removeAttribute(
                                //                           "data-kt-indicator"
                                //                       );
                                //                       t.disabled = !1;
                                //                       if (response.errors) {
                                //                           // Start Error Message
                                //                           Swal.fire({
                                //                               text: response.errors,
                                //                               icon: "error",
                                //                               buttonsStyling:
                                //                                   !1,
                                //                               confirmButtonText:
                                //                                   "Ok, got it!",
                                //                               customClass: {
                                //                                   confirmButton:
                                //                                       "btn btn-primary",
                                //                               },
                                //                               timer: 5000,
                                //                           });
                                //                           // End Error Message
                                //                       } else {
                                //                           // Start Success Message
                                //                           t.removeAttribute(
                                //                               "data-kt-indicator"
                                //                           ),
                                //                               (t.disabled = !1),
                                //                               Swal.fire({
                                //                                   text: response.success,
                                //                                   icon: "success",
                                //                                   buttonsStyling:
                                //                                       !1,
                                //                                   confirmButtonText:
                                //                                       "Ok, got it!",
                                //                                   customClass: {
                                //                                       confirmButton:
                                //                                           "btn btn-primary",
                                //                                   },
                                //                                   allowOutsideClick: false,
                                //                                   allowEscapeKey: false,
                                //                                   timer: 2000,
                                //                               }).then(function (
                                //                                   t
                                //                               ) {
                                //                                   var rr =
                                //                                       r.getAttribute(
                                //                                           "data-kt-redirect"
                                //                                       );
                                //                                   window.location.href =
                                //                                       rr;
                                //                               });
                                //                       }
                                //                   },
                                //               });
                                //           }, 2e3))
                                //         : Swal.fire({
                                //               text: "Sorry, looks like there are some errors detected, please try again.",
                                //               icon: "error",
                                //               buttonsStyling: !1,
                                //               confirmButtonText: "Ok, got it!",
                                //               customClass: {
                                //                   confirmButton:
                                //                       "btn btn-primary",
                                //               },
                                //           });
                            });
                }),
                e.addEventListener("click", function (t) {
                    t.preventDefault(),
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light",
                            },
                        }).then(function (t) {
                            t.value
                                ? (r.reset(), i.hide())
                                : "cancel" === t.dismiss &&
                                  Swal.fire({
                                      text: "Your form has not been cancelled!.",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "Ok, got it!",
                                      customClass: {
                                          confirmButton: "btn btn-primary",
                                      },
                                  });
                        });
                }),
                o.addEventListener("click", function (t) {
                    t.preventDefault(),
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light",
                            },
                        }).then(function (t) {
                            t.value
                                ? (r.reset(), i.hide())
                                : "cancel" === t.dismiss &&
                                  Swal.fire({
                                      text: "Your form has not been cancelled!.",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "Ok, got it!",
                                      customClass: {
                                          confirmButton: "btn btn-primary",
                                      },
                                  });
                        });
                });

            const postStartDateUpdate = $(
                r.querySelector('[name="postStartDateUpdate"]')
            ).flatpickr({
                enableTime: !0,
                dateFormat: "d, M Y, H:i",
                minDate: "today",
                onChange: function (selectedDates, dateStr, instance) {
                    // Set the minDate of end_date to the selected start_date
                    endDatePicker.set("minDate", dateStr);
                },
            });

            const endDatePicker = $(
                r.querySelector('[name="postEndDateUpdate"]')
            ).flatpickr({
                enableTime: !0,
                dateFormat: "d, M Y, H:i",
                minDate: "today", // Optional: ensure end date cannot be in the past
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalShortLinkUpdate.init();
});

function formatDate(dateString) {
    const date = new Date(dateString); // Parse the date string
    const days = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
    const months = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];

    const day = date.getDate().toString().padStart(2, "0"); // Day of the month
    const month = months[date.getMonth()]; // Abbreviated month
    const year = date.getFullYear(); // Year
    const hours = date.getHours().toString().padStart(2, "0"); // Hours
    const minutes = date.getMinutes().toString().padStart(2, "0"); // Minutes

    return `${day}, ${month} ${year}, ${hours}:${minutes}`;
}

$(document).on("click", ".update-smpid", function () {
    $("#modal_update").css({ opacity: 0.9 });
    $("#modal_update_submit").css({ display: "none" });

    var SingleURL = $(this).data("single");
    var UpdateURL = $(this).data("updateurl");

    $("#modal_update_form").attr("data-kt-action-url", UpdateURL);

    $.get(SingleURL, function (single) {
        console.log(single);
        console.log(UpdateURL);
        // Title Value Set
        $("#titleUpdate").val(single.title);

        // Social Media Item Selected
        if (single.socialMedia) {
            // Parse the JSON string to an array
            const socialLinks = JSON.parse(single.socialMedia); // Assuming `single.socialMedia` is a JSON string like '["Twitter", "Linkedin"]'

            // Set the selected values for the select2 input
            $("#socialMediaUpdate").val(socialLinks).trigger("change"); // Directly pass the array of values
        }

        // Social Post Template Item Selected
        if (single.socialTemplateId) {
            // Parse the JSON string to an array
            const socialTemplateIds = JSON.parse(single.socialTemplateId); // Assuming `single.socialMedia` is a JSON string like '["Twitter", "Linkedin"]'

            // Set the selected values for the select2 input
            $("#socialTemplateUpdate").val(socialTemplateIds).trigger("change"); // Directly pass the array of values
        }

        //Post Repeat Status Checked
        const postRepeatTypeBox = document.getElementById(
            "postRepeatTypeBoxUpdate"
        );
        const postStartDateBox = document.getElementById(
            "postStartDateBoxUpdate"
        );
        const postEndDateBox = document.getElementById("postEndDateBoxUpdate");

        if (single.postRepeatStatus == 1) {
            $("#postRepeatUpdate").prop("checked", true); // Correct way to set a checkbox checked in jQuery
            postRepeatTypeBox.style.setProperty(
                "display",
                "block",
                "important"
            );
            postStartDateBox.style.setProperty("display", "block", "important");
            postEndDateBox.style.setProperty("display", "block", "important");
        } else {
            postRepeatTypeBox.style.setProperty("display", "none", "important");
            postStartDateBox.style.setProperty("display", "none", "important");
            postEndDateBox.style.setProperty("display", "none", "important");
        }

        // Post Repeat Type Selected
        if (single.postRepeatType == "daily") {
            $("#postRepeatTypeUpdate").val("daily");
        } else if (single.postRepeatType == "weekly") {
            $("#postRepeatTypeUpdate").val("weekly");
        } else if (single.postRepeatType == "monthly") {
            $("#postRepeatTypeUpdate").val("monthly");
        }

        //Post Start Date Time
        const formattedStartDateTime = formatDate(single.postDateTime);
        const formattedEndPostDateTime = formatDate(single.endPostDateTime);

        const postStartDateUpdates = flatpickr("#postStartDateUpdate", {
            enableTime: true, // Enables time picker
            dateFormat: "d, M Y, H:i", // Format for both date and time
            defaultDate: formattedStartDateTime, // Correct date-time format with seconds
            //time_24hr: true, // Use 24-hour format (optional)
            minDate: "today",
            onChange: function (selectedDates, dateStr, instance) {
                // Set the minDate of end_date to the selected start_date
                endDatePickers.set("minDate", dateStr);
            },
        });

        //  Post End Date Time
        const endDatePickers = flatpickr("#postEndDateUpdate", {
            enableTime: true, // Enables time picker
            dateFormat: "d, M Y, H:i", // Format for both date and time
            defaultDate: formattedEndPostDateTime, // Correct date-time format with seconds
            //time_24hr: true, // Use 24-hour format (optional)
            minDate: "today", // Optional: ensure end date cannot be in the past
        });

        // $("#postStartDateUpdate").val(single.postDateTime);

        $("#modal_update").css({ opacity: 1 });
        $("#modal_update_submit").css({ display: "block" });
    });
});

$(document).ready(function () {
    // Toggle visibility of Title field based on checkbox state
    const checkbox = document.getElementById("postRepeatUpdate");
    const postRepeatTypeBox = document.getElementById(
        "postRepeatTypeBoxUpdate"
    );
    const postStartDateBox = document.getElementById("postStartDateBoxUpdate");
    const postEndDateBox = document.getElementById("postEndDateBoxUpdate");

    checkbox.addEventListener("change", function () {
        if (this.checked) {
            postRepeatTypeBox.style.setProperty(
                "display",
                "block",
                "important"
            );
            postStartDateBox.style.setProperty("display", "block", "important");
            postEndDateBox.style.setProperty("display", "block", "important");
        } else {
            postRepeatTypeBox.style.setProperty("display", "none", "important");
            postStartDateBox.style.setProperty("display", "none", "important");
            postEndDateBox.style.setProperty("display", "none", "important");
        }
    });
});
