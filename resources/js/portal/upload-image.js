$(document).ready(function(e) {
    let isOpenChooseFile = true;
    $(document).on("click", ".choose-file", function() {
        isOpenChooseFile = false;
        $(".dropzone").trigger("click");
        isOpenChooseFile = true;
    });

    $(".dropzone-wrapper").on("click", function(e) {
        if (isOpenChooseFile) {
            e.preventDefault();
        }
    });

    $(".dropzone-wrapper").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass("dragover");
    });

    $(".dropzone-wrapper").on("dragleave", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass("dragover");
    });
    let isOpenChooseFileAdd = true;
    $(document).on("click", ".choose-file-add", function() {
        isOpenChooseFileAdd = false;
        $(".dropzone-add").trigger("click");
        isOpenChooseFileAdd = true;
    });

    $(".dropzone-wrapper-add").on("click", function(e) {
        if (isOpenChooseFileAdd) {
            e.preventDefault();
        }
    });

    $(".dropzone-wrapper-add").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass("dragover-add");
    });

    $(".dropzone-wrapper-video").on("dragleave", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass("dragover-video");
    });
    let isOpenChooseFileVideo = true;
    $(document).on("click", ".choose-file-video", function() {
        isOpenChooseFileVideo = false;
        $(".dropzone-video").trigger("click");
        isOpenChooseFileVideo = true;
    });

    $(".dropzone-wrapper-video").on("click", function(e) {
        if (isOpenChooseFileVideo) {
            e.preventDefault();
        }
    });

    $(".dropzone-wrapper-video").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass("dragover-video");
    });

    $(".dropzone-wrapper-add").on("dragleave", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass("dragover-video");
    });
});
function readFile(input, file = null) {
    $(".dropzone-wrapper").attr("style", "height: 250px");
    $(".delete-error-after-true-image").html("");
    $("#msgError p").html("");
    if (file != null) input.files = file;
    if (input.files && input.files[0]) {
        if (
            input.files[0].type !== "image/jpeg" &&
            input.files[0].type !== "image/png"
        ) {
            $(".dropzone-wrapper").attr(
                "style",
                "height: 250px; border: 2px dashed #dc3545 !important"
            );
            $("#msgError p").attr(
                "style",
                "color: #dc3545 !important; text-align: left"
            );
            $("#msgError p").html("PNG/JPG形式の画像を指定してください。");
            return;
        }
        if (input.files[0].size > 5 * 1024 * 1024) {
            $(".dropzone-wrapper").attr(
                "style",
                "height: 250px; border: 2px dashed #dc3545 !important"
            );
            $("#msgError p").attr(
                "style",
                "color: #dc3545 !important; text-align: left"
            );
            $("#msgError p").html("サムネイル画像 には、5120KB以下のファイルを指定してください。");
            return;
        }
        var reader = new FileReader();

        reader.onload = function(e) {
            var wrapperZone = $(input).parent();
            var previewZone = $(input)
                .parent()
                .parent()
                .find(".preview-zone");

            wrapperZone.removeClass("dragover");
            previewZone.removeClass("hidden");
            $("#upload-img").attr("src", e.target.result);
            $(".upload").text("");
        };
        $("#msgError p").html("");
        $(".dropzone-wrapper").removeClass("errorr-img");
        $(".form-text.text-danger.error.delete-error-after-true-image").hide();

        document.getElementById('upload-image').files = file;
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    var counter = 0;
    $("#drag-drop-image").on('dragenter', function(e) {
        e.preventDefault();
        counter++;
        $(this).css('border', '#39b311 2px dashed');
        $(this).css('background', '#f1ffef');
    });

    $("#drag-drop-image").on('dragover', function(e) {
        e.preventDefault();
    });

    $("#drag-drop-image").on('dragleave', function(e) {
        e.preventDefault();
        counter--;
        if (counter === 0) { 
            $(this).css('border', '#91b0b3 2px dashed');
            $(this).css('background', '#ebedef');
        }
    });

    $("#drag-drop-image").on('drop', function(e) {
        $(this).css('border', '#07c6f1 2px dashed');
        $(this).css('background', '#FFF');
        e.preventDefault();
        var image = e.originalEvent.dataTransfer.files;
        readFile($(this).children("#upload-img"), image);
    });
});

$(document).ready(function() {
    var counter = 0;
    $("#drag-drop-image-add").on('dragenter', function(e) {
        console.log('here');
        e.preventDefault();
        counter++;
        $(this).css('border', '#39b311 2px dashed');
        $(this).css('background', '#f1ffef');
    });

    $("#drag-drop-image-add").on('dragover', function(e) {
        e.preventDefault();
    });

    $("#drag-drop-image-add").on('dragleave', function(e) {
        e.preventDefault();
        counter--;
        if (counter === 0) { 
            $(this).css('border', '#91b0b3 2px dashed');
            $(this).css('background', '#ebedef');
        }
    });

    $("#drag-drop-image-add").on('drop', function(e) {
        $(this).css('border', '#07c6f1 2px dashed');
        $(this).css('background', '#FFF');
        e.preventDefault();
        var image = e.originalEvent.dataTransfer.files;
        readFileAdd($(this).children("#upload-image-add"), image);
    });
});

function readFileAdd(input, file = null) {
    $(".dropzone-wrapper-add").attr("style", "height: 250px");
    $("#msgError label").html("");
    if (file != null) input.files = file;
    if (input.files && input.files[0]) {
        if (
            input.files[0].type !== "image/jpeg" &&
            input.files[0].type !== "image/png"
        ) {
            $(".dropzone-wrapper-add").attr(
                "style",
                "height: 250px; border: 2px dashed #dc3545 !important"
            );
            $("#msgError label").html("PNG/JPG形式の画像を指定してください。");
            $("#msgError p").attr(
                "style",
                "color: #dc3545 !important; text-align: left"
            );
            $("#msgError p").html("PNG/JPG形式の画像を指定してください。");
            return;
        }
        if (input.files[0].size > 1000 * 1024) {
            $(".dropzone-wrapper-add").attr(
                "style",
                "height: 250px; border: 2px dashed #dc3545 !important"
            );
            $("#msgError label").html("イベント画像 には、1000KB以下のファイルを指定してください。");
            $("#msgError p").attr(
                "style",
                "color: #dc3545 !important; text-align: left"
            );
            $("#msgError p").html("イベント画像 には、1000KB以下のファイルを指定してください。");
            return;
        }
        var reader = new FileReader();

        reader.onload = function(e) {
            var wrapperZone = $(input).parent();
            var previewZone = $(input)
                .parent()
                .parent()
                .find(".preview-zone");

            wrapperZone.removeClass("dragover-add");
            previewZone.removeClass("hidden");
            $("#upload-img-add").attr("src", e.target.result);
            $(".upload-add").text("");
        };
        $("#msgError p").html("");
        $(".dropzone-wrapper-add").removeClass("errorr-img");
        $(".form-text.text-danger.error.delete-error-after-true-image").hide();

        document.getElementById('upload-image-add').files = file;
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    const nick = `{{nickname}}`.toString();
    let initListUid = $("input#listUserID")
        .val()
        .split(",");
    $.ajax({
        type: "GET",
        url: "/get-list-name",
        data: {
            listUserID: initListUid
        },
        success: function(response) {
            $("input#listUserID2").val(response);
            $("input#listUserID3").val(response);
        },
        error: function(e) {
            console.log(e);
        }
    });

    $("input#listUserID").on("change", function() {
        if (this.value.charAt(0) === ",") {
            this.value = this.value.substring(1);
        }
        if (this.value.charAt(this.value.length - 1) === ",") {
            this.value = this.value.slice(0, -1);
        }
        let listUserID = this.value.split(",");
        $.ajax({
            type: "GET",
            url: "/get-list-name",
            data: {
                listUserID: listUserID
            },
            success: function(response) {
                if ($("input#listUserID").val().length == 0) {
                    $("#body_push_noti").val(
                        $("#body_push_noti")
                            .val()
                            .replaceAll($("input#listUserID3").val(), nick)
                    );
                    $("input#listUserID2").val(response);
                    $("input#listUserID3").val(response);
                } else {
                    $("input#listUserID2").val(response);
                    if ($("input#listUserID3").val().length > 0) {
                        $("#body_push_noti").val(
                            $("#body_push_noti")
                                .val()
                                .replaceAll(
                                    $("input#listUserID3").val(),
                                    response
                                )
                        );
                    }
                    if (
                        $("#body_push_noti")
                            .val()
                            .includes(nick)
                    ) {
                        $("#body_push_noti").val(
                            $("#body_push_noti")
                                .val()
                                .replaceAll(nick, response)
                        );
                    }
                    $("input#listUserID3").val(response);
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    });

    $("#body_push_noti").on("blur", function() {
        const textChange = $("input#listUserID2").val();
        if (textChange.length > 0) {
            this.value = this.value.replaceAll(nick, textChange);
            $("#body-push-noti2").val(this.value.replaceAll(textChange, nick));
        }
    });

    $("#body_push_noti").on("focus", function() {
        const textChange = $("input#listUserID2").val();
        if (textChange.length > 0) {
            this.value = this.value.replaceAll(textChange, nick);
        }
    });

    $("#body_push_noti").on("change", function() {
        $("#body-push-noti2").val(this.value);
    });
});

$(document).ready(function() {
    let url = $("#upload-img").attr("src");
    $(document).on('show.bs.modal','#videoAddModal', function () {
        $("#upload-image").val("");
        $("#input-tag").val("");
        $("#upload-img").attr("src", url);
        $(".upload-top").html("ここにファイルをドロップ");
        $(".upload-bottom").html("または");
        $("#video-tag").addClass("d-none");
        $(".box-upload-video").removeClass("d-none");
    });
});

function readFileEdit(input, file = null) {
    $(".dropzone-wrapper").attr("style", "height: 250px");
    $(".delete-error-after-true-image").html("");
    $("#msgError p").html("");
    if (file != null) input.files = file;
    if (input.files && input.files[0]) {
        if (
            input.files[0].type !== "image/jpeg" &&
            input.files[0].type !== "image/png"
        ) {
            $(".dropzone-wrapper").attr(
                "style",
                "height: 250px; border: 2px dashed #dc3545 !important"
            );
            $("#msgError p").attr(
                "style",
                "color: #dc3545 !important; text-align: left"
            );
            $("#msgError p").html("PNG/JPG形式の画像を指定してください。");
            return;
        }
        if (input.files[0].size > 1000 * 1024) {
            $(".dropzone-wrapper").attr(
                "style",
                "height: 250px; border: 2px dashed #dc3545 !important"
            );
            $("#msgError p").attr(
                "style",
                "color: #dc3545 !important; text-align: left"
            );
            $("#msgError p").html("イベント画像 には、1000KB以下のファイルを指定してください。");
            return;
        }
        var reader = new FileReader();

        reader.onload = function(e) {
            var wrapperZone = $(input).parent();
            var previewZone = $(input)
                .parent()
                .parent()
                .find(".preview-zone");

            wrapperZone.removeClass("dragover");
            previewZone.removeClass("hidden");
            $("#upload-img").attr("src", e.target.result);
            $(".upload").text("");
        };
        $("#msgError p").html("");
        $(".dropzone-wrapper").removeClass("errorr-img");
        $(".form-text.text-danger.error.delete-error-after-true-image").hide();

        document.getElementById('upload-image').files = file;
        reader.readAsDataURL(input.files[0]);
    }
}
