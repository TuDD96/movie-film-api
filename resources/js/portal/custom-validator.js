jQuery.extend(jQuery.validator.messages, {
    // required: "This field is required.",
    // remote: "Please fix this field.",
    // email: "Please enter a valid email address.",
    // url: "Please enter a valid URL.",
    // date: "Please enter a valid date.",
    // dateISO: "Please enter a valid date (ISO).",
    // number: "Please enter a valid number.",
    // digits: "Please enter only digits.",
    // creditcard: "Please enter a valid credit card number.",
    // equalTo: "Please enter the same value again.",
    // accept: "Please enter a value with a valid extension.",
    // maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    // minlength: jQuery.validator.format("Please enter at least {0} characters."),
    // rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    // range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    // max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    // min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

// jQuery.validator.addMethod('valid_zip_code', function (value) {
//   var regex = /^[0-9, -]+$/;
//
//   return value.trim().match(regex);
// });
//   $('form').validate({
//     rules: {
//       zip_code: {
//         minlength: 7,
//         maxlength: 8,
//         valid_zip_code: true
//       },
//     },
//     messages: {
//       "zip_code": {
//         valid_zip_code: "xxx"
//       },
//     },
//     submitHandler: function(form) {
//       form.submit();
//     }
//   });

$(document).ready(function(e) {
    // Auto open modal add when has validate error
    autoOpenModalWhenHasError();

    // Remove error when keyup
    removeErrorWhenKeyup();

    // Remove error when click button add
    removeErrorWhenClickButtonAdd();

    // Remove data when click button add
    removeDataWhenClickButtonAdd();

    // Remove img when click button edit event
    removeImgWhenClickButtonAdd();

    // Trim space
    trimSpace();

    actionClickImageDefaule();
});

function actionClickImageDefaule() {
    $("#upload-img-add").on("click", function() {
        $("#upload-image-add").click();
    });
    $("#upload-img").on("click", function() {
        $("#upload-image").click();
    });
}

function autoOpenModalWhenHasError() {
    let errors = $(".error,.errors");
    let subDirectory = $("#sub_directory").val().length > 0 ?  "/" + $("#sub_directory").val() : "";

    if (errors.length > 0 && $(".modal-add").length != 0) {
        // check products screen has four modal add (event add, event edit, create final round and path round)
        if (window.location.pathname.search(subDirectory + "/events") === 0) {
            let currentModal = localStorage.getItem("current_popup");
            if (currentModal === "editEvent") {
                $(".modal-add#eventEditModal").modal("show");
            } else if (currentModal === "addEvent") {
                $(".modal-add#eventAddModal").modal("show");
            } else if (currentModal === "addPreliminary") {
                $(".modal-add#leagueCreatePreliminaryModal").modal("show");
            } else if (currentModal === "addFinal") {
                $(".modal-add#leagueCreateFinalModal").modal("show");
            }
        } else if (window.location.pathname.search(subDirectory + "/videos") === 0) {
            let currentVideoModal = localStorage.getItem("video_create");
            if (currentVideoModal === "videoCreate") {
                $(".modal-add#videoAddModal").modal("show");
            }
        } else {
            $(".modal-add").modal("show");
        }
    }
}

function removeErrorWhenKeyup() {
    $(document).on("keyup", "input.error,textarea.error", function() {
        $(this).removeClass("error");
        $(this)
            .next()
            .remove();
    });

    $(document).on("change", "select.error", function() {
        $(this).removeClass("error");
        $(this)
            .next()
            .remove();
    });

    $(document).on("change", ".error.hasDatepicker", function() {
        $(this).removeClass("error");
        $(this)
            .parent()
            .find(".error")
            .remove();
    });
}

function removeDataWhenClickButtonAdd() {
    $(".btn-add-popup").click(function() {
        $(".title").val("");
        $(".body").val("");
    });
}

function removeImgWhenClickButtonAdd() {
    $(".remove-event-img").click(function() {
        $("#msgError p").html("");
        $(".dropzone-wrapper").attr(
            "style",
            "height: 250px; border: 2px dashed #91b0b3 !important"
        );
        $("#upload-img").attr(
            "src",
            "/assets/icons/portal/ico_upload.png"
        );
        $("#upload-image").val("");
        $(".upload-top").text("ここにファイルをドロップ");
        $(".upload-bottom").text("または");
    });
    $(".remove-event-img-add").click(function() {
        $("#msgError p").html("");
        $(".dropzone-wrapper-add").attr(
            "style",
            "height: 250px; border: 2px dashed #91b0b3 !important"
        );
        $("#upload-img-add").attr(
            "src",
            "/assets/icons/portal/ico_upload.png"
        );
        $("#upload-image-add").val("");
        $(".upload-top-add").text("ここにファイルをドロップ");
        $(".upload-bottom-add").text("または");
    });
}

function removeErrorWhenClickButtonAdd() {
    $(".add-popup").click(function() {
        $(
            "input.error, textarea.error, select.error, .error.hasDatepicker"
        ).removeClass("error");
        $("label.error, div.errors").remove();
    });
}

function trimSpace() {
    const trim = document.querySelectorAll("#trim");

    for (var i = 0; i < trim.length; i++) {
        trim[i].addEventListener("change", function() {
            this.value = this.value.trim();
        });
    }
}
