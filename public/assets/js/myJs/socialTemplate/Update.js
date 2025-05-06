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
                        postMessageUpdate: {
                            validators: {
                                notEmpty: {
                                    message: "Post Message is required",
                                },
                            },
                        },
                        postMessageShortUpdate: {
                            validators: {
                                notEmpty: {
                                    message: "Post Message Short is required",
                                },
                                stringLength: {
                                    min: 10,
                                    max: 250,
                                    message:
                                        "Post Message must be between 10 and 250 characters",
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
                                              let data = new FormData(form); // Use FormData to handle file uploads automatically
                                              data.append(
                                                  "titleUpdate",
                                                  $("#titleUpdate").val()
                                              );
                                              data.append(
                                                  "postMessageUpdate",
                                                  $("#postMessageUpdate").val()
                                              );
                                              data.append(
                                                  "postMessageShortUpdate",
                                                  $(
                                                      "#postMessageShortUpdate"
                                                  ).val()
                                              );
                                              data.append(
                                                  "postImageUpdate",
                                                  $("#postImageUpdate")[0]
                                                      .files[0]
                                              );

                                              var actionURL =
                                                  form.getAttribute(
                                                      "data-kt-action-url"
                                                  );
                                              console.log(actionURL);

                                              $.ajax({
                                                  headers: {
                                                      "X-CSRF-TOKEN": $(
                                                          'meta[name="_token"]'
                                                      ).attr("content"),
                                                  },
                                                  type: "POST",
                                                  url: actionURL,
                                                  data: data,
                                                  processData: false, // Required for file upload
                                                  contentType: false, // Required for file upload
                                                  dataType: "json",
                                                  success: function (response) {
                                                      // Handle the success or error message
                                                      t.removeAttribute(
                                                          "data-kt-indicator"
                                                      );
                                                      t.disabled = !1;

                                                      if (response.errors) {
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
                                                      } else {
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
                                                          }).then(function (t) {
                                                              var rr =
                                                                  r.getAttribute(
                                                                      "data-kt-redirect"
                                                                  );
                                                              window.location.href =
                                                                  rr;
                                                          });
                                                      }
                                                  },
                                              });
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
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalShortLinkUpdate.init();
});

$(document).on("click", ".update-data", function () {
    $("#modal_update").css({ opacity: 0.9 });
    $("#modal_update_submit").css({ display: "none" });

    var SingleURL = $(this).data("single");
    var UpdateURL = $(this).data("updateurl");

    $("#modal_update_form").attr("data-kt-action-url", UpdateURL);

    $.get(SingleURL, function (single) {
        console.log(single);
        console.log(UpdateURL);
        $("#titleUpdate").val(single.title);
        $("#postMessageUpdate").val(single.postMessage);
        $("#postMessageShortUpdate").val(single.postMessageShort);
        if (single.postImage != "imageNotSet") {
            $("#postImageUpdateSrc").css({ display: "block" });
            $("#postImageUpdateSrc").attr("src", single.postImage);
        } else {
            $("#postImageUpdateSrc").css({ display: "none" });
            $("#postImageUpdateSrc").attr("src", " ");
        }

        $("#modal_update").css({ opacity: 1 });
        $("#modal_update_submit").css({ display: "block" });
    });
});

$(document).ready(function () {
    // When the input changes (i.e., when a file is selected)
    $("#postImageUpdate").on("change", function (event) {
        var file = event.target.files[0]; // Get the selected file
        if (file) {
            var reader = new FileReader();

            // When the file is loaded, set it as the src for the img tag
            reader.onload = function (e) {
                $("#postImageUpdateSrc").attr("src", e.target.result);
                $("#postImageUpdateSrc").show(); // Display the image preview
            };

            reader.readAsDataURL(file); // Read the file as a data URL
        } else {
            $("#postImageUpdateSrc").hide(); // Hide the image preview if no file is selected
        }
    });
});
