import moment from "moment";

window.mobileCheck = function() {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};

//detech platfom
console.log("start detech platfom");
// detect Platform
const is_OSX = /(Mac|iPhone|iPod|iPad)/i.test(navigator.platform);
const is_iOS = /(iPhone|iPod|iPad)/i.test(navigator.platform);
const is_Mac = navigator.platform.toUpperCase().indexOf("MAC") >= 0;
const is_iPhone = navigator.platform == "iPhone";
const is_iPod = navigator.platform == "iPod";
const is_iPad = navigator.platform == "iPad";

// detect Browser
const isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
const isFirefox = typeof InstallTrigger !== 'undefined';
const isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && window['safari'].pushNotification));
const isIE = /*@cc_on!@*/false || !!document.documentMode;
const isEdge = !isIE && !!window.StyleMedia;
const isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
const isEdgeChromium = isChrome && (navigator.userAgent.indexOf("Edg") != -1);
const isBlink = (isChrome || isOpera) && !!window.CSS;

var mMedia = window.matchMedia("(max-width: 535px)");
function resizeSafari(mMedia) {
    if (mMedia.matches) {
        console.log(true);
        document.querySelector(".form-group .btn-upload-file").style.lineHeight = "22px";
    } else {
        console.log(false);
        document.querySelector(".form-group .btn-upload-file").style.lineHeight = "51px";
    }
}

function resizeChrome(mMedia) {
    if (mMedia.matches) {
        console.log(true);
    } else {
        console.log(false);
    }
}
if (!is_OSX) {
    console.log("This NOT a Mac or an iOS Device!");
}
if (is_Mac) {
    resizeSafari(mMedia);
    mMedia.addListener(resizeSafari);
    $('.title-price').attr('style', 'margin-top: -6px;');
    if (isSafari) {
        $('.cartoon-name').attr('style', 'height: 31px')
        $('.title-upload-history').attr('style', 'height: 31px')
    }
}
if (is_iOS) {
    resizeChrome(mMedia);
    mMedia.addListener(resizeChrome);
    $('.league').addClass('league-ios');
    $('.info').attr('style', 'margin-top: -2px;');
    $('label.price').attr('style', 'top: -8px');
    $('.sub-box-content').attr('style', 'margin-bottom: -5px;');
    $('.title-input-upload').attr('style', 'margin-bottom: -5px;');
    $('.box-upload-pdf').attr('style', 'margin-top: 0px;');
    $('#uploadFileModal .btn-cancel').attr('style', 'line-height: 37px');
    $('#uploadFileModal .btn-upload-file').attr('style', 'line-height: 37px');
    $('#modalLogout .btn-confirm').attr('style', 'line-height: 35px');
    $('#modalLogout .btn-cancel').attr('style', 'line-height: 35px');
    // modalLogout
}
if (is_iPhone) {
    $('.header-modal').attr('style', 'height: 38px');
    $('.box-amount').attr('style', 'padding-top: 0');
    // $('.cartoon-name').attr('style', 'height: 17px')
    // $('.title-upload-history').attr('style', 'height: 17px')
}
if (is_iPod) {
    console.log("This is an iPod Touch!");
}
if (is_iPad) {
    console.log("This is an iPad!");
}

$(document).ready(function() {
    const isMobile = window.mobileCheck();
    var previousOrientation = window.orientation;
    const pathStorage = $("#pathStorage").val();

    if (isMobile) {
        if (is_iOS) {
            $('.box-white').attr('style', 'height: 40px')
        }
        if (previousOrientation == 90 || previousOrientation == -90) {
            $('.modal').removeClass('pad-top-10');
            $('.modal').addClass('pad-top-50');
        } else {
            $('.modal').removeClass('pad-top-50');
            $('.modal').addClass('pad-top-10');
        }
    }
    var checkOrientation = function(){
        if(window.orientation !== previousOrientation){
            previousOrientation = window.orientation;
            if (isMobile) {
                if ( previousOrientation == 90 || previousOrientation == -90) {
                    $('.modal').removeClass('pad-top-10');
                    $('.modal').addClass('pad-top-50');
                } else {
                    $('.modal').removeClass('pad-top-50');
                    $('.modal').addClass('pad-top-10');
                }
            }
        }
    };

    window.addEventListener("orientationchange", checkOrientation, false);

    if ($("#hasLeague").val().length > 0) {
        $(".btn-upload-file").click();
    }
    // setTimeout(() => {
    //     $("div.loader-outer").remove();
    //     $("span.price").text("￥" + convertMoney($("#amountUser").val()));
    // }, 1000);

    let imgBookUpload, pdf, idBookSelect;
    $(".rectangle").on("click", function() {
        $(".image-file").click();
    });
    $(".photo").on("click", function() {
        $(".image-file").click();
    });
    $(".img-preview").on("click", function() {
        $(".image-file").click();
    });

    $(".image-file").on("change", function(e) {
        document.querySelector(".err-upload-image .errMsg").textContent = "";
        const imgType = this.files[0].type;
        const imgSize = this.files[0].size;
        const maxSize = 1024 * 1024 * 5;
        if (imgSize > maxSize) {
            document.querySelector(".err-upload-image .errMsg").textContent = "サムネイル画像 には、5MB以下のファイルを指定してください。";
            this.value = "";
            return;
        }
        if (
            imgType === "image/x-png" ||
            imgType === "image/jpeg" ||
            imgType === "image/png"
        ) {
            $(".img-preview").attr("src", URL.createObjectURL(this.files[0]));
            $(".img-preview").removeClass("d-none");
            $(".rectangle").addClass("d-none");
            $(".photo").addClass("d-none");
        } else {
            document.querySelector(".err-upload-image .errMsg").textContent = "PNG/JPG形式の画像を指定してください。";
            this.value = "";
        }
    });

    $(".btn-upload-pdf").on("click", function() {
        $(".pdf-file").click();
    });

    $(".pdf-file").on("change", function() {
        $("#uploadFileModal .box-upload-pdf").attr(
            "style",
            "border: 2px dashed #1d1c4182;"
        );
        document.querySelector(".err-upload-file .errMsg").textContent = "";
        const fileType = this.files[0].type;
        const iconPDF = pathStorage + `/pdf.svg`;
        const fileSize = this.files[0].size;
        const maxSize = 1024 * 1024 * 160;

        if (fileSize > maxSize) {
            document.querySelector(".err-upload-file .errMsg").textContent =
                "ファイルを選択には、160 MB以下のPDFファイルを指定してください。";
            this.value = "";
            return;
        }
        if (fileType === "application/pdf") {
            $(".cloud-computing").attr("src", iconPDF);
            if (!isMobile) $(".cloud-computing").attr("style", "left: calc(50% - 42px); width: 80px; height: 70px;");
            $(".title-upload-pdf").addClass("d-none");
            $(".title-or").text(this.files[0].name);
        } else {
            $("#uploadFileModal .box-upload-pdf").attr("style", "border: 2px dashed red;");
            document.querySelector(".err-upload-file .errMsg").textContent = "PDF形式の画像を指定してください。";
            $(".cloud-computing").attr("src", pathStorage + "/cloud-computing.svg");
            $(".cloud-computing").attr("style", "");
            $("label.title-upload-pdf").removeClass("d-none");
            $(".title-or").text("または");
        }
    });

    $(".btn-submit-modal").on("click", function() {
        $("#loading-overlay").show();

        let formData = new FormData();

        const thumbnail_url = !$(".image-file")[0].files[0]
            ? imgBookUpload
                ? imgBookUpload[0]
                : null
            : $(".image-file")[0].files[0];
        const ebook_url = !$(".pdf-file")[0].files[0]
            ? pdf
                ? pdf[0]
                : null
            : $(".pdf-file")[0].files[0];
        const league_id = $("#select-league").val();
        const league_name = $('option[value="'+ league_id + '"]').text();

        formData.append("league_id", league_id);
        formData.append("thumbnail_url", thumbnail_url);
        formData.append("title", $("input[name='title']").val());
        formData.append("ebook_url", ebook_url);

        $.ajax({
            type: "POST",
            url: $(this).data("url"),
            data: formData,
            contentType: false,
            processData: false,
            success: function(result) {
                const data = `
                    <div class="box-book-item ${result.data.data.book_id}">
                        <div class="image-book">
                            <img
                            class="video__image"
                            src="${result.data.data.thumbnail_url}"
                            alt=""
                            />
                        </div>
                        <div class="info-video">
                            <div class="box-info-video">
                            <label class="date">
                                ${moment(result.data.data.created_at).format(
                                    "YYYY/MM/DD"
                                )}
                            </label>
                            <label class="manga-name">
                                ${result.data.data.title}
                            </label>
                            <label class="league">
                                <span class="league-title">対戦ブロック: </span> <span class="league-name"> ${league_id == 0 ? '無し' : league_name}</span>
                            </label>
                            <label class="pdf">
                                <img src="${pathStorage}/pdf.svg" alt="">
                                <span>${result.data.data.fileName}</span>
                            </label>
                            </div>
                        </div>
                        <img data-id="${result.data.data.book_id}" class="icon_close" src="assets/icons/portal/delete_pdf.svg" alt="" class="icon-close" data-toggle="modal" data-target="#modalDeleteBook">
                    </div>
                    `;
                $(".history-upload").prepend(data);
                $('.league').addClass('league-ios');
                $("#loading-overlay").hide();
                $(".btn-cancel").click();
                if (league_id != 0) {
                    $("#select-league option[value=" + league_id + "]").remove();
                }
            },
            error: function(err) {
                $("#loading-overlay").hide();
                const error = JSON.parse(err.responseText);
                if (error.message === "Validation Error") {
                    error.data.errors.forEach(value => {
                        if (value.key === "league_id") {
                            document.querySelector(
                                ".err-select-league .errMsg"
                            ).textContent = value.error.replace(
                                "league id",
                                "対戦ブロック"
                            );
                        }
                        if (value.key === "thumbnail_url") {
                            document.querySelector(
                                ".err-upload-image .errMsg"
                            ).textContent = value.error.replace(
                                "thumbnail url",
                                "画像をアップロード"
                            );
                        }
                        if (value.key === "title") {
                            document.querySelector(
                                ".err-input-name .errMsg"
                            ).textContent = value.error.replace(
                                "title",
                                "漫画名"
                            );
                        }
                        if (value.key === "ebook_url") {
                            document.querySelector(
                                ".err-upload-file .errMsg"
                            ).textContent = value.error.replace(
                                "ebook url",
                                "ファイルを選択"
                            );
                        }
                    });
                } else {
                    document.querySelector(
                        ".err-upload-file .errMsg"
                    ).textContent = error.data.msg;
                }
            }
        });
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

    var counter = 0;
    $("#drag-drop-image").on("dragenter", function(e) {
        e.preventDefault();
        counter++;
        $(this).css("border", "#39b311 2px dashed");
        $(this).css("background", "#f1ffef");
    });

    $("#drag-drop-image").on("dragover", function(e) {
        e.preventDefault();
    });

    $("#drag-drop-image").on("dragleave", function(e) {
        e.preventDefault();
        counter--;
        if (counter === 0) {
            $(this).css("border", "#91b0b3 2px dashed");
            $(this).css("background", "#ebedef");
        }
    });

    $("#drag-drop-image").on("drop", function(e) {
        $(this).css("border", "#07c6f1 2px dashed");
        $(this).css("background", "#FFF");
        e.preventDefault();
        var img = e.originalEvent.dataTransfer.files;
        const imgType = img[0].type;
        const imgSize = img[0].size;
        imgBookUpload = img;
        $(".image-file").val("");

        document.querySelector(".err-upload-image .errMsg").textContent = "";
        const maxSize = 1024 * 1024 * 5;
        if (imgSize > maxSize) {
            document.querySelector(".err-upload-image .errMsg").textContent =
                "サムネイル画像 には、5MB以下のファイルを指定してください。";
            return;
        }
        if (
            imgType === "image/x-png" ||
            imgType === "image/jpeg" ||
            imgType === "image/png"
        ) {
            $(".img-preview").attr("src", URL.createObjectURL(img[0]));
            $(".img-preview").removeClass("d-none");
            $(".rectangle").addClass("d-none");
            $(".photo").addClass("d-none");
        } else {
            $(".img-preview").addClass("d-none");
            $(".rectangle").removeClass("d-none");
            $(".photo").removeClass("d-none");
            $(".image-file").val("");
            imgBookUpload = null;
            $("img#drag-drop-image").attr("style", "");
            document.querySelector(".err-upload-image .errMsg").textContent = "PNG/JPG形式の画像を指定してください。";
        }
    });

    $(".photo").on("dragenter", function(e) {
        e.preventDefault();
        counter++;
        $("#drag-drop-image").css("border", "#39b311 2px dashed");
        $("#drag-drop-image").css("background", "#f1ffef");
    });

    $(".photo").on("dragover", function(e) {
        e.preventDefault();
    });

    $(".photo").on("dragleave", function(e) {
        e.preventDefault();
        counter--;
        if (counter === 0) {
            $("#drag-drop-image").css("border", "#91b0b3 2px dashed");
            $("#drag-drop-image").css("background", "#ebedef");
        }
    });

    $(".photo").on("drop", function(e) {
        $("#drag-drop-image").css("border", "#07c6f1 2px dashed");
        $("#drag-drop-image").css("background", "#FFF");
        e.preventDefault();
        var img = e.originalEvent.dataTransfer.files;
        const imgType = img[0].type;
        const imgSize = img[0].size;
        imgBookUpload = img;
        $(".image-file").val("");

        document.querySelector(".err-upload-image .errMsg").textContent = "";
        const maxSize = 1024 * 1024 * 5;
        if (imgSize > maxSize) {
            document.querySelector(".err-upload-image .errMsg").textContent =
                "サムネイル画像 には、5MB以下のファイルを指定してください。";
            return;
        }
        if (
            imgType === "image/x-png" ||
            imgType === "image/jpeg" ||
            imgType === "image/png"
        ) {
            $(".img-preview").attr("src", URL.createObjectURL(img[0]));
            $(".img-preview").removeClass("d-none");
            $(".rectangle").addClass("d-none");
            $(".photo").addClass("d-none");
        } else {
            $(".img-preview").addClass("d-none");
            $(".rectangle").removeClass("d-none");
            $(".photo").removeClass("d-none");
            $(".image-file").val("");
            imgBookUpload = null;
            $("img#drag-drop-image").attr("style", "");
            document.querySelector(".err-upload-image .errMsg").textContent = "PNG/JPG形式の画像を指定してください。";
        }
    });

    $(".img-preview").on("dragenter", function(e) {
        e.preventDefault();
        counter++;
        $(this).css("border", "#39b311 2px dashed");
        $(this).css("background", "#f1ffef");
    });

    $(".img-preview").on("dragover", function(e) {
        e.preventDefault();
    });

    $(".img-preview").on("dragleave", function(e) {
        e.preventDefault();
        counter--;
        if (counter === 0) {
            $(this).css("border", "#91b0b3 2px dashed");
            $(this).css("background", "#ebedef");
        }
    });

    $(".img-preview").on("drop", function(e) {
        $(this).css("border", "#07c6f1 2px dashed");
        $(this).css("background", "#FFF");
        e.preventDefault();
        var img = e.originalEvent.dataTransfer.files;
        const imgType = img[0].type;
        const imgSize = img[0].size;
        imgBookUpload = img;
        $(".image-file").val("");

        document.querySelector(".err-upload-image .errMsg").textContent = "";
        const maxSize = 1024 * 1024 * 5;
        if (imgSize > maxSize) {
            document.querySelector(".err-upload-image .errMsg").textContent =
                "サムネイル画像 には、5MB以下のファイルを指定してください。";
            return;
        }
        if (
            imgType === "image/x-png" ||
            imgType === "image/jpeg" ||
            imgType === "image/png"
        ) {
            $(".img-preview").attr("src", URL.createObjectURL(img[0]));
            $(".img-preview").removeClass("d-none");
            $(".rectangle").addClass("d-none");
            $(".photo").addClass("d-none");
            $(this).css("border", "#07c6f1 0px dashed");
        } else {
            $(".img-preview").addClass("d-none");
            $(".rectangle").removeClass("d-none");
            $(".photo").removeClass("d-none");
            $(".image-file").val("");
            $("img#drag-drop-image").attr("style", "");
            imgBookUpload = null;
            document.querySelector(".err-upload-image .errMsg").textContent = "PNG/JPG形式の画像を指定してください。";
        }
    });

    let loading = false;
    let page = 1;
    let lastPage = $("#lastPage").val();

    $(window).scroll(function() {
        var position = parseInt($(window).scrollTop());
        var bottom = parseInt($(document).height() - $(window).height());
        if (page >= lastPage) {
            $(".loading").addClass("d-none");

            return;
        }
        if (position >= bottom - 300 && !loading && page < lastPage) {
            loading = true;
            if (loading) {
                $(".loading").removeClass("d-none");
                page = page + 1;
                $.ajax({
                    type: "GET",
                    url: "/client/book?page=" + page,
                    success: function(result) {
                        console.log(result);
                        var data = ``;
                        result.data.forEach(elm => {
                            data =
                                data +
                                `
                                <div class="box-book-item book_${elm.book_id}">
                                    <div class="image-book">
                                        <img
                                        class="video__image"
                                        src="${elm.thumbnail_url}"
                                        alt=""
                                        />
                                    </div>
                                    <div class="info-video">
                                        <div class="box-info-video">
                                        <label class="date">
                                            ${moment(elm.created_at).format(
                                                "YYYY/MM/DD"
                                            )}
                                        </label>
                                        <label class="manga-name">
                                            ${elm.title}
                                        </label>
                                        <label class="league">
                                            <span class="league-title">対戦ブロック: </span> <span class="league-name"> ${elm.league_name == null ? '無し' : elm.league_name}</span>
                                        </label>
                                        <label class="pdf">
                                            <img src="assets/icons/portal/pdf.svg" alt="">
                                            <span>${elm.fileName}</span>
                                        </label>
                                        </div>
                                    </div>
                                    <img data-id="${elm.book_id}" class="icon_close" src="assets/icons/portal/delete_pdf.svg" alt="" class="icon-close" data-toggle="modal" data-target="#modalDeleteBook">
                                </div>
                                `;
                            loading = false;
                        });
                        $(".history-upload").append(data);
                        $('.league').addClass('league-ios');
                        $(".icon_close").click(function() {
                            $("#modalDeleteBook .btn-confirm").attr("data-id", $(this).data("id"));
                        });
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        }
    });

    $("#modalDeleteBook .btn-confirm").on("click", function() {
        $("#loading-overlay").show();
        const bookId = $(this).attr("data-id");
        $.ajax({
            type: "DELETE",
            url: "/client/book/" + bookId,
            success: function(result) {
                if (result.status) {
                    $(".book_" + bookId).remove();
                    $("#loading-overlay").hide();
                }
            },
            error: function(err) {
                $("#loading-overlay").hide();
                console.log(err);
            }
        });
    });

    $(".icon_close").click(function() {
        console.log($(this).data("id"));
        $("#modalDeleteBook .btn-confirm").attr("data-id", $(this).data("id"));
    });

    $("#select-league").on("change", function() {
        document.querySelector(".err-select-league .errMsg").textContent = "";
    });

    $(".input-catoon-name").on("input", function() {
        document.querySelector(".err-input-name .errMsg").textContent = "";
    });
    $(".input-catoon-name").on("change", function() {
        this.value = this.value.trim();
    });

    var counterPdf = 0;

    $(".box-upload-pdf").on("dragenter", function(e) {
        e.preventDefault();
        counterPdf++;
        $(".box-upload-pdf").css("border", "#39b311 2px dashed");
        $(".box-upload-pdf").css("background", "#f1ffef");
    });

    $(".box-upload-pdf").on("dragover", function(e) {
        e.preventDefault();
    });

    $(".box-upload-pdf").on("dragleave", function(e) {
        e.preventDefault();
        counterPdf--;
        if (counterPdf === 0) {
            $(".box-upload-pdf").css("border", "#91b0b3 2px dashed");
            $(".box-upload-pdf").css("background", "#ebedef");
        }
    });

    $(".box-upload-pdf").on("drop", function(e) {
        $(".box-upload-pdf").css("border", "#07c6f1 2px dashed");
        $(".box-upload-pdf").css("background", "transparent linear-gradient(180deg, #ffffff 0%, #fff6f6 100%) 0% 0% no-repeat padding-box");
        e.preventDefault();
        var file = e.originalEvent.dataTransfer.files;
        const fileType = file[0].type;
        console.log(file[0].type);
        pdf = file;
        $(".pdf-file").val("");

        document.querySelector(".err-upload-file .errMsg").textContent = "";
        if (fileType === "application/pdf") {
            $(".cloud-computing").attr("src", "assets/icons/portal/pdf.svg");
            if (!isMobile) $(".cloud-computing").attr("style", "left: calc(50% - 48px); width: 80px; height: 70px;");
            $(".title-upload-pdf").addClass("d-none");
            $(".title-or").html(file[0].name);
        } else {
            $("#uploadFileModal .box-upload-pdf").attr("style", "border: 2px dashed red;");
            $(".cloud-computing").attr("src", "assets/icons/portal/cloud-computing.svg");
            $(".cloud-computing").attr("style", "");
            $(".title-upload-pdf").removeClass("d-none");
            $(".title-or").html("または");
            $(".pdf-file").val("");
            document.querySelector(".err-upload-file .errMsg").textContent = "PDF形式の画像を指定してください。";
        }
    });

    // window.addEventListener(
    //     "resize",
    //     function() {
    //         fixFontPrice();
    //     },
    //     true
    // );

    function fixFontPrice() {
        const viewSize = $(window).width();
        const amount = $("#amountUser").val();
        const lableAmount = $("label.price");
        var fontSize;
        if (amount > 999999) {
            fontSize = viewSize < 510 ? 19 : 24;
        }
        if (amount > 9999999) {
            fontSize = viewSize < 510 ? 18 : 22;
        }
        if (amount > 99999999) {
            fontSize = viewSize < 510 ? 16 : 20;
        }
        if (amount > 999999999) {
            fontSize = viewSize < 510 ? 14 : 19;
        }
        if (amount > 9999999999) {
            fontSize = viewSize < 510 ? 14 : 19;
        }
        if (amount > 99999999999) {
            fontSize = viewSize < 510 ? 14 : 17;
        }

        if (fontSize) {
            lableAmount.attr(
                "style",
                "font: normal normal bold " +
                    fontSize +
                    "px Noto Sans !important;"
            );
        }
    }

    function convertMoney(money) {
        console.log(Math.abs(money));
        if (Math.abs(money) > 1000000000000) {
            return (Math.sign(money) * ((Math.abs(money) % 100000000))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '億'
        } else if (Math.abs(money) > 100000000) {
            return (Math.sign(money) * ((Math.abs(money) % 10000))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '万';
        } else if (Math.abs(money) > 100000) {
            return (Math.sign(money) * ((Math.abs(money) % 1000))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '千';
        } else {
            return (Math.sign(money) * (Math.abs(money))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    }

    $("#uploadFileModal").on('hide.bs.modal', function () {
        $("#form-upload-book")[0].reset();
        $("img.img-preview").addClass("d-none")
        $("img.rectangle").removeClass("d-none")
        $("img.photo").removeClass("d-none")
        $("#drag-drop-image").attr("style", "");
        $("#uploadFileModal .box-upload-pdf").attr("style", "border: 2px dashed #1d1c4182;");
        $(".cloud-computing").attr("src", pathStorage + "/cloud-computing.svg");
        $(".cloud-computing").attr("style", "");
        $(".title-upload-pdf").removeClass("d-none");
        $(".title-or").html("または");
        const errMsg = document.querySelectorAll(".errMsg");
        errMsg.forEach(err => {
            err.textContent = "";
        });
    });

    $(".btn-confirm.btn-logout").on("click", function() {
        const url = $(this).attr("data-url");
        window.location.href = url;
    })

    $("#select-league").on({
        "change": function() {
            console.log("change");
          $(this).blur();
        },
        'focus': function() {
          console.log("displayed");
        },
        "blur": function() {
          console.log("blur: not displayed");
        },
        "keyup": function(e) {
          if (e.keyCode == 27)
            console.log("displayed");
        }
    });
});
