$(document).on("click", "#copySingleLinkIcon", function () {
    let imageUrl = $(this).data("image"); // data-image অ্যাট্রিবিউটের মান নেওয়া
    let tempInput = $("<input>"); // নতুন ইনপুট ফিল্ড তৈরি করা
    $("body").append(tempInput);
    tempInput.val(imageUrl).select(); // মান সেট করা ও নির্বাচন করা
    document.execCommand("copy"); // কপি করা
    tempInput.remove(); // ইনপুট মুছে ফেলা

    Swal.fire({
        text: "Link has been copied: " + imageUrl,
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
            confirmButton: "btn btn-primary",
        },
        allowOutsideClick: false,
        allowEscapeKey: false,
        timer: 2000,
    });
});
