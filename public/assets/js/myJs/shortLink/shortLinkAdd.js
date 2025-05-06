"use strict";
var KTModalShortLinkAdd = (function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            (i = new bootstrap.Modal(
                document.querySelector("#modal_add_shortLink")
            )),
                (r = document.querySelector("#modal_add_shortLink_form")),
                (t = r.querySelector("#modal_add_shortLink_submit")),
                (e = r.querySelector("#modal_add_shortLink_cancel")),
                (o = r.querySelector("#modal_add_shortLink_close")),
                (n = FormValidation.formValidation(r, {
                    fields: {
                        title: {
                            validators: {
                                notEmpty: {
                                    message: "Title is required",
                                },
                            },
                        },
                        longLink: {
                            validators: {
                                notEmpty: {
                                    message: "Long URL  is required",
                                },
                                uri: {
                                    message: "Please Enter a Valid URL",
                                    protocol: "http, https",
                                },
                            },
                        },
                        shortCode: {
                            validators: {
                                stringLength: {
                                    max: 50,
                                    message:
                                        "Short Code Character Limit Minimum 6 Maximum 50.",
                                    min: 6,
                                },
                            },
                        },

                        seoTitle: {
                            validators: {
                                // notEmpty: {
                                //     message: "Post Repeat Type is required",
                                // },
                                callback: {
                                    message:
                                        "SEO Title is required if Short Link SEO is Allowed",
                                    callback: function (input) {
                                        const isChecked =
                                            document.getElementById(
                                                "linkSEO"
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

                        seoDescription: {
                            validators: {
                                // notEmpty: {
                                //     message: "Post Repeat Type is required",
                                // },
                                callback: {
                                    message:
                                        "SEO Description is required if Short Link SEO is Allowed",
                                    callback: function (input) {
                                        const isChecked =
                                            document.getElementById(
                                                "linkSEO"
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

                        seoUrl: {
                            validators: {
                                // notEmpty: {
                                //     message: "Post Repeat Type is required",
                                // },
                                callback: {
                                    message:
                                        "SEO URL is required if Short Link SEO is Allowed",
                                    callback: function (input) {
                                        const isChecked =
                                            document.getElementById(
                                                "linkSEO"
                                            ).checked;
                                        return (
                                            !isChecked ||
                                            (isChecked &&
                                                input.value.trim() !== "")
                                        );
                                    },
                                },
                                uri: {
                                    message: "Please Enter a Valid URL",
                                    protocol: "http, https",
                                },
                            },
                        },

                        seoImage: {
                            validators: {
                                // notEmpty: {
                                //     message: "Post Repeat Type is required",
                                // },
                                callback: {
                                    message:
                                        "SEO Image is required if Short Link SEO is Allowed",
                                    callback: function (input) {
                                        const isChecked =
                                            document.getElementById(
                                                "linkSEO"
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

                        // seoUrl: {
                        //     validators: {
                        //         uri: {
                        //             message: "Please Enter a Valid URL",
                        //             protocol: "http, https",
                        //         },
                        //     },
                        // },
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
                                              let form = $(
                                                  "#modal_add_shortLink_form"
                                              )[0];
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
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalShortLinkAdd.init();
});

$(document).ready(function () {
    // When the input changes (i.e., when a file is selected)
    $("#seoImage").on("change", function (event) {
        var file = event.target.files[0]; // Get the selected file
        if (file) {
            var reader = new FileReader();

            // When the file is loaded, set it as the src for the img tag
            reader.onload = function (e) {
                $("#seoImagePreview").attr("src", e.target.result);
                $("#seoImagePreview").show(); // Display the image preview
            };

            reader.readAsDataURL(file); // Read the file as a data URL
        } else {
            $("#seoImagePreview").hide(); // Hide the image preview if no file is selected
        }
    });
});

$(document).ready(function () {
    // Toggle visibility of Title field based on checkbox state
    const checkbox = document.getElementById("linkSEO");
    const seoTitle = document.getElementById("seoTitleBox");
    const seoDescription = document.getElementById("seoDescriptionBox");
    const seoUrl = document.getElementById("seoUrlBox");
    const seoImage = document.getElementById("seoImageBox");

    checkbox.addEventListener("change", function () {
        if (this.checked) {
            seoTitle.style.setProperty("display", "block", "important");
            seoDescription.style.setProperty("display", "block", "important");
            seoUrl.style.setProperty("display", "block", "important");
            seoImage.style.setProperty("display", "block", "important");
        } else {
            seoTitle.style.setProperty("display", "none", "important");
            seoDescription.style.setProperty("display", "none", "important");
            seoUrl.style.setProperty("display", "none", "important");
            seoImage.style.setProperty("display", "none", "important");
        }
    });
});
