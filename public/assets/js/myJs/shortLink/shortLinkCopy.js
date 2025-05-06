// function copyLink() {
//     //console.log(this);
// }

$(document).on("click", "#copySingleLink", function () {
    //let copyText = document.querySelector(".copy-text");
    // copyText.querySelector("button").addEventListener("click", function () {
    let input = $(this);
    input.select();
    document.execCommand("copy");
    //copyText.classList.add("active");
    let inputVa = $(this).val();
    Swal.fire({
        text: "Link has been copied: " + inputVa,
        icon: "success",
        buttonsStyling: !1,
        confirmButtonText: "Ok, got it!",
        customClass: {
            confirmButton: "btn btn-primary",
        },
        allowOutsideClick: false,
        allowEscapeKey: false,
        timer: 2000,
    });
    //     window.getSelection().removeAllRanges();
    //     setTimeout(function () {
    //         //copyText.classList.remove("active");
    //     }, 2500);
    //});
    // console.log($(this).val());
});
