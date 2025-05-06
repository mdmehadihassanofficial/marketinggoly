// Sart Deactive Data
$(document).on("click", ".deactive-data", function () {
    var userURL = $(this).data("url");
    //var ridurectURL = $(this).data("redirecturl");
    // console.log(ridurectURL);
    var trObj = $(this);

    Swal.fire({
        text: "Are you sure you want to deactive?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Yes, Deactive!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
        },
    }).then(function (e) {
        if (e.value == true) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
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
                            trObj
                                .parents("tr")
                                .css("background-color", "#ff00000a");

                            $(".menu-item-deactive").css("display", "none");
                            $(".menu-item-active").css("display", "block");
                            $(".designBtnDiv").css("display", "none");
                        });
                        // End Success Message
                    }
                }, // Ajax Response
            }); // Ajax End
        } // End If
    }); // Confirm Message Than
}); // On Click End
// End Deactive Data
// Sart Active Data
$(document).on("click", ".active-data", function () {
    var userURL = $(this).data("url");
    //var ridurectURL = $(this).data("redirecturl");
    // console.log(ridurectURL);
    var trObj = $(this);

    Swal.fire({
        text: "Are you sure you want to active?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Yes, Active!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
        },
    }).then(function (e) {
        if (e.value == true) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
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
                            trObj
                                .parents("tr")
                                .css("background-color", "#ff000000");

                            $(".menu-item-deactive").css("display", "block");
                            $(".menu-item-active").css("display", "none");
                            $(".designBtnDiv").css("display", "block");
                            //trObj.parents("tr").addClass("bg-light");
                        });
                        // End Success Message
                    }
                }, // Ajax Response
            }); // Ajax End
        } // End If
    }); // Confirm Message Than
}); // On Click End
// End Active Data
