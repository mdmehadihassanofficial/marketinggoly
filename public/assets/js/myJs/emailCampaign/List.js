"use strict";
var KTCustomersList = (function () {
    var t,
        e,
        o,
        n,
        // Single Delete Start Here
        c = () => {
            /*------------------------------------------
            --------------------------------------------
            When click user on Delete Button
            --------------------------------------------
            --------------------------------------------*/
            $(document).on("click", ".delete-data", function () {
                var userURL = $(this).data("url");
                var ridurectURL = $(this).data("redirecturl");
                console.log(ridurectURL);
                var trObj = $(this);

                Swal.fire({
                    text: "Are you sure you want to delete?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary",
                    },
                }).then(function (e) {
                    if (e.value == true) {
                        $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="_token"]').attr(
                                    "content"
                                ),
                            },
                            url: userURL,
                            type: "DELETE",
                            dataType: "json",

                            success: function (response) {
                                console.log(response.errors);
                                console.log(response.success);
                                if (response.errors) {
                                    // Start Error Message

                                    Swal.fire({
                                        text: response.errors,
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                        timer: 5000,
                                    });

                                    // End Error Message
                                } else {
                                    Swal.fire({
                                        text: response.success,
                                        icon: "success",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary",
                                        },
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        timer: 2000,
                                    }).then(function (t) {
                                        trObj.parents("tr").remove();
                                    });
                                    // End Success Message
                                }
                            }, // Ajax Response
                        }); // Ajax End
                    } // End If
                }); // Confirm Message Than
            }); // On Click End
        },
        // End Single Delete
        // Start Multiple Delete
        r = () => {
            const e = n.querySelectorAll('[type="checkbox"]'),
                o = document.querySelector(
                    '[data-kt-customer-table-select="delete_selected"]'
                );
            e.forEach((t) => {
                t.addEventListener("click", function () {
                    setTimeout(function () {
                        l();
                    }, 50);
                });
            }),
                o.addEventListener("click", function () {
                    Swal.fire({
                        text: "Are you sure you want to delete selected?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton:
                                "btn fw-bold btn-active-light-primary",
                        },
                    }).then(function (o) {
                        if (o.value == true) {
                            // Start Custom Code Here
                            var multipleIds =
                                document.querySelectorAll("#multipleDeleteID");

                            var actionURL = $("#selectDeleteItem").val();

                            var multiDeleteIDsss = [];

                            [].forEach.call(multipleIds, function (multipleId) {
                                // do whatever
                                if (multipleId.checked) {
                                    var multipleVal =
                                        multipleId.getAttribute("value");

                                    multiDeleteIDsss.unshift(multipleVal);
                                    //console.log(multipleVal);
                                }
                            });

                            // console.log(multiDeleteIDsss);

                            var myJSONId = JSON.stringify(multiDeleteIDsss);

                            var data = {
                                deletedIds: myJSONId,
                            };

                            $.ajax({
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="_token"]'
                                    ).attr("content"),
                                },
                                url: actionURL,
                                data: data,
                                type: "post",
                                dataType: "json",

                                success: function (response) {
                                    // console.log(response.errors);
                                    //console.log(response.success);
                                    if (response.errors) {
                                        // Start Error Message

                                        Swal.fire({
                                            text: response.errors,
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton:
                                                    "btn btn-primary",
                                            },
                                            timer: 5000,
                                        });

                                        // End Error Message
                                    } else {
                                        Swal.fire({
                                            text: response.success,
                                            icon: "success",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton:
                                                    "btn btn-primary",
                                            },
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            timer: 2000,
                                        }).then(function (t) {
                                            // $("#selectDeleteItem").val();
                                            var redirectURl = document
                                                .querySelector(
                                                    "#selectDeleteItem"
                                                )
                                                .getAttribute(
                                                    "data-redirectUrl"
                                                );
                                            window.location.href = redirectURl;
                                            //trObj.parents("tr").remove();
                                            // e.forEach((e) => {
                                            //     //console.log(e.checked);
                                            //     console.log(e);
                                            //     console.log("gap");
                                            //     e.checked &&
                                            //         t
                                            //             .row(
                                            //                 $(
                                            //                     e.closest(
                                            //                         "tbody tr"
                                            //                     )
                                            //                 )
                                            //             )
                                            //             .remove()
                                            //             .draw();
                                            // });
                                            // n.querySelectorAll(
                                            //     '[type="checkbox"]'
                                            // )[0].checked = !1;
                                        });
                                        // End Success Message
                                    }
                                }, // Ajax Response
                            }); // Ajax End
                            console.log(myJSONId);
                            console.log(actionURL);
                            // End Custom Code Here

                            // o.value
                            //     ? Swal.fire({
                            //           text: "You have deleted all selected!.",
                            //           icon: "success",
                            //           buttonsStyling: !1,
                            //           confirmButtonText: "Ok, got it!",
                            //           customClass: {
                            //               confirmButton:
                            //                   "btn fw-bold btn-primary",
                            //           },
                            //       }).then(function () {
                            //           //  console.log(multipleId);
                            //           console.log(t);
                            //           e.forEach((e) => {
                            //               //console.log(e.checked);
                            //               e.checked &&
                            //                   t
                            //                       .row($(e.closest("tbody tr")))
                            //                       .remove()
                            //                       .draw();
                            //           });
                            //           n.querySelectorAll(
                            //               '[type="checkbox"]'
                            //           )[0].checked = !1;
                            //       })
                            //     : "cancel" === o.dismiss &&
                            //       Swal.fire({
                            //           text: "Selected customers was not deleted.",
                            //           icon: "error",
                            //           buttonsStyling: !1,
                            //           confirmButtonText: "Ok, got it!",
                            //           customClass: {
                            //               confirmButton:
                            //                   "btn fw-bold btn-primary",
                            //           },
                            //       });
                        }
                    });
                });
        };
    // Multiple Delete End Here
    const l = () => {
        const t = document.querySelector(
                '[data-kt-customer-table-toolbar="base"]'
            ),
            e = document.querySelector(
                '[data-kt-customer-table-toolbar="selected"]'
            ),
            o = document.querySelector(
                '[data-kt-customer-table-select="selected_count"]'
            ),
            c = n.querySelectorAll('tbody [type="checkbox"]');
        let r = !1,
            l = 0;
        c.forEach((t) => {
            t.checked && ((r = !0), l++);
        }),
            r
                ? ((o.innerHTML = l),
                  t.classList.add("d-none"),
                  e.classList.remove("d-none"))
                : (t.classList.remove("d-none"), e.classList.add("d-none"));
    };
    return {
        init: function () {
            (n = document.querySelector("#dataTable")) &&
                (n.querySelectorAll("tbody tr").forEach((t) => {
                    const e = t.querySelectorAll("td"),
                        o = moment(e[3].innerHTML, "DD MMM YYYY, LT").format();
                    e[3].setAttribute("data-order", o);
                }),
                (t = $(n).DataTable({
                    info: !1,
                    order: [],
                    columnDefs: [
                        { orderable: !1, targets: 0 },
                        { orderable: !1, targets: 3 },
                    ],
                })).on("draw", function () {
                    r(), c(), l(), KTMenu.init();
                }),
                r(),
                document
                    .querySelector('[data-kt-customer-table-filter="search"]')
                    .addEventListener("keyup", function (e) {
                        t.search(e.target.value).draw();
                    }),
                (e = $('[data-kt-customer-table-filter="month"]')),
                (o = document.querySelectorAll(
                    '[data-kt-customer-table-filter="payment_type"] [name="payment_type"]'
                )),
                document
                    .querySelector('[data-kt-customer-table-filter="filter"]')
                    .addEventListener("click", function () {
                        const n = e.val();
                        let c = "";
                        o.forEach((t) => {
                            t.checked && (c = t.value), "all" === c && (c = "");
                        });
                        const r = n + " " + c;
                        t.search(r).draw();
                    }),
                c(),
                document
                    .querySelector('[data-kt-customer-table-filter="reset"]')
                    .addEventListener("click", function () {
                        e.val(null).trigger("change"),
                            (o[0].checked = !0),
                            t.search("").draw();
                    }));
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTCustomersList.init();
});
