"use strict";
var KTModalEmailCollectionAdd = (function () {
    var t, e, o, n, r, i;
    return {
        init: function () {
            (i = new bootstrap.Modal(
                document.querySelector("#modal_email_add")
            )),
                (r = document.querySelector("#modal_email_form")),
                (t = r.querySelector("#modal_email_submit")),
                (e = r.querySelector("#modal_email_cancel")),
                (o = r.querySelector("#modal_email_close")),
                new Tagify(r.querySelector('[name="emailSingle"]'), {
                    whitelist: ["demo@gmail.com", "my@gmail.com"],
                    maxTags: 30,
                    dropdown: { maxItems: 30, enabled: 0, closeOnSelect: !1 },
                }).on("change", function () {
                    n.revalidateField("emailSingle");
                }),
                (n = FormValidation.formValidation(r, {
                    fields: {
                        emailOrExcel: {
                            validators: {
                                notEmpty: {
                                    message: "Please Select Your Data Type",
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
                                                  $("#modal_email_form")[0];

                                              var dataName = $(
                                                  'input[name="emailOrExcel"]:checked'
                                              ).val();

                                              var fileCheck =
                                                  $("#excelFile")[0].files[0];
                                              console.log(fileCheck);

                                              var formData = new FormData();
                                              formData.append(
                                                  "emailOrExcel",
                                                  dataName
                                              );
                                              formData.append(
                                                  "emailSingle",
                                                  $("#emailSingle").val()
                                              );
                                              formData.append(
                                                  "excelFile",
                                                  $("#excelFile")[0].files[0]
                                              );

                                              var actionURL =
                                                  form.getAttribute(
                                                      "data-kt-action-url"
                                                  );
                                              console.log(formData);

                                              $.ajax({
                                                  headers: {
                                                      "X-CSRF-TOKEN": $(
                                                          'meta[name="_token"]'
                                                      ).attr("content"),
                                                  },
                                                  url: actionURL,
                                                  type: "POST",
                                                  data: formData,
                                                  dataType: "JSON",
                                                  processData: false, // Important to set this to false when using FormData
                                                  contentType: false, // Important to set this to false when using FormData
                                                  success: function (response) {
                                                      t.removeAttribute(
                                                          "data-kt-indicator"
                                                      );
                                                      t.disabled = false;

                                                      if (response.errors) {
                                                          // Error handling
                                                          Swal.fire({
                                                              text: response.errors,
                                                              icon: "error",
                                                              buttonsStyling: false,
                                                              confirmButtonText:
                                                                  "Ok, got it!",
                                                              customClass: {
                                                                  confirmButton:
                                                                      "btn btn-primary",
                                                              },
                                                              timer: 15000,
                                                          });
                                                      } else {
                                                          // Success handling
                                                          Swal.fire({
                                                              text: response.success,
                                                              icon: "success",
                                                              buttonsStyling: false,
                                                              confirmButtonText:
                                                                  "Ok, got it!",
                                                              customClass: {
                                                                  confirmButton:
                                                                      "btn btn-primary",
                                                              },
                                                              allowOutsideClick: false,
                                                              allowEscapeKey: false,
                                                              timer: 10000,
                                                          }).then(function () {
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
    KTModalEmailCollectionAdd.init();
});

$(document).ready(function () {
    // Listen for changes on the radio buttons
    $('input[name="emailOrExcel"]').change(function () {
        if ($(this).val() === "emailExcel") {
            // Show the extra field and make it required
            $("#emailExcelInputDiv").removeClass("hidden");
            $("#excelFile").prop("required", true);
            $("#emailSingle").prop("required", false);
            $("#emailSingle").val("");
            $("#emailInputDiv").addClass("hidden");
        } else if ($(this).val() === "emailInput") {
            $("#emailInputDiv").removeClass("hidden");
            $("#emailSingle").prop("required", true);
            $("#emailExcelInputDiv").addClass("hidden");
            $("#excelFile").prop("required", false);
            $("#excelFile").val("");
        } else {
            // Hide the extra field and remove the required attribute
            $("#emailExcelInputDiv").addClass("hidden");
            $("#emailInputDiv").addClass("hidden");
            $("#excelFile").prop("required", false);
            $("#emailSingle").prop("required", false);
        }
    });

    // Form submit handler
    $("#myForm").on("submit", function (e) {
        // Prevent form submission if validation fails
        if (!this.checkValidity()) {
            e.preventDefault();
            alert("Please fill in the required fields!");
        }
    });
});

$(document).on("click", "#modal_email_add_btn", function () {
    $("#modal_email_add").css({ opacity: 0.9 });
    $("#modal_email_submit").css({ display: "none" });

    var UpdateURL = $(this).data("updateurl");

    $("#modal_email_form").attr("data-kt-action-url", UpdateURL);
    $("#modal_email_add").css({ opacity: 1 });
    $("#modal_email_submit").css({ display: "block" });
});
