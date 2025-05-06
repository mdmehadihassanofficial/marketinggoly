"use strict";
var KTModalShortLinkAdd = (function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            (i = new bootstrap.Modal(document.querySelector("#modal_add"))),
                (r = document.querySelector("#modal_add_form")),
                (t = r.querySelector("#modal_add_submit")),
                (e = r.querySelector("#modal_add_cancel")),
                (o = r.querySelector("#modal_add_close")),
                (n = FormValidation.formValidation(r, {
                    fields: {
                        title: {
                            validators: {
                                notEmpty: {
                                    message: "Title is required",
                                },
                            },
                        },
                        "socialMedia[]": {
                            validators: {
                                notEmpty: {
                                    message: "Social Media is required",
                                },
                            },
                        },
                        "socialTemplate[]": {
                            validators: {
                                notEmpty: {
                                    message: "Social Template is required",
                                },
                            },
                        },

                        postRepeatType: {
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
                                                "postRepeat"
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

                        postStartDate: {
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
                                                "postRepeat"
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
                                                  $("#modal_add_form")[0];
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

            const startDatePicker = $(
                r.querySelector('[name="postStartDate"]')
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
                r.querySelector('[name="postEndDate"]')
            ).flatpickr({
                enableTime: !0,
                dateFormat: "d, M Y, H:i",
                minDate: "today", // Optional: ensure end date cannot be in the past
            });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalShortLinkAdd.init();
});

$(document).ready(function () {
    // Toggle visibility of Title field based on checkbox state
    const checkbox = document.getElementById("postRepeat");
    const postRepeatTypeBox = document.getElementById("postRepeatTypeBox");
    const postStartDateBox = document.getElementById("postStartDateBox");
    const postEndDateBox = document.getElementById("postEndDateBox");

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
