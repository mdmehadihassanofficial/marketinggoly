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
                        // Start Item
                        CONSUMER_KEY: {
                            validators: {
                                notEmpty: {
                                    message: "Consumer Key is required",
                                },
                            },
                        },
                        // End Item
                        // Start Item
                        CONSUMER_SECRET: {
                            validators: {
                                notEmpty: {
                                    message: "Consumer Secret is required",
                                },
                            },
                        },
                        // End Item
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
                                                          window.location.href =
                                                              response.success;
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
