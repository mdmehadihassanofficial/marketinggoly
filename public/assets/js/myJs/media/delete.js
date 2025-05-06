$(document).on("click", "#deleteImage", function () {
    console.log("Delete");
    var userURL = $(this).data("url");
    var ridurectURL = $(this).data("redirecturl");
    //console.log(ridurectURL);
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
                            trObj.parents(".gallery-item").remove();
                        });
                        // End Success Message
                    }
                }, // Ajax Response
            }); // Ajax End
        } // End If
    }); // Confirm Message Than
}); // On Click End
