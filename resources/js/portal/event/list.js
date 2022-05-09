import moment from "moment";

$(document).ready(function(e) {
    $("#title_event_preliminary").val(
        localStorage.getItem("title-preliminary")
    );
    $("#title_event_final").val(localStorage.getItem("title-final"));
    // $("#end_datetime_final").val(localStorage.getItem("end-date-final"));
    // $("#end_datetime").val(localStorage.getItem("end-date"));
    $("#upload-img").attr("src", localStorage.getItem("img-edit"));
    $("#id").val(localStorage.getItem("id"));
    let checkImageExistsInEdit = localStorage.getItem("img-edit");
    if (
        checkImageExistsInEdit &&
        checkImageExistsInEdit !== "/assets/icons/portal/ico_upload.png"
    ) {
        $(".upload-top").text("");
        $(".upload-bottom").text("");
    }
    $(".delete-event").click(function() {
        $("#event_id").val($(this).data("delete-event"));
    });
    $(".edit-event").click(function() {
        localStorage.setItem("id", $(this).data("edit-event"));
        $("#id").val(localStorage.getItem("id"));
        $("#title").val($(this).data("edit-title-event"));
        $("#body").val($(this).data("edit-body-event"));
        let imagePath = $(this).data("edit-image-event");
        if (imagePath) {
            localStorage.setItem("img-edit", $(this).data("edit-image-event"));
            $("#upload-img").attr("src", localStorage.getItem("img-edit"));
            $(".upload-top").text("");
            $(".upload-bottom").text("");
        } else {
            localStorage.setItem(
                "img-edit",
                "/assets/icons/portal/ico_upload.png"
            );
        }
    });
    $("#btn-edit-event").click(function(e) {
        e.preventDefault();
        localStorage.setItem("current_popup", "editEvent");
        $("#formEditEvent").submit();
    });
    $("#btn-add-event").click(function(e) {
        e.preventDefault();
        localStorage.setItem("current_popup", "addEvent");
        $("#formAddEvent").submit();
    });
    $(".create-preliminary-round").click(function(e) {
        // $('#title_event_preliminary').val($(this).data('create-title-preliminary'));
        localStorage.setItem(
            "title-preliminary",
            $(this).data("create-title-preliminary")
        );
        localStorage.setItem(
            "event_id_preliminary",
            $(this).data("create-event-id-preliminary")
        );
        $("#title_event_preliminary").val(
            localStorage.getItem("title-preliminary")
        );
        $("#event_id_preliminary").val(
            localStorage.getItem("event_id_preliminary")
        );
        $(".remove-data-preliminary-after-create").val("");
    });
    $(".create-final-round").click(function(e) {
        // $('#title_event_preliminary').val($(this).data('create-title-preliminary'));
        localStorage.setItem("title-final", $(this).data("create-title-final"));
        localStorage.setItem(
            "event_id_final",
            $(this).data("create-event-id-final")
        );
        $("#title_event_final").val(localStorage.getItem("title-final"));
        $("#event_id_final").val(localStorage.getItem("event_id_final"));
        $(".remove-data-final-after-create").val("");
    });
    $("#btn-add-preliminary").click(function(e) {
        e.preventDefault();
        localStorage.setItem("current_popup", "addPreliminary");
        $("#formAddPreliminary").submit();
    });
    $("#btn-add-final").click(function(e) {
        e.preventDefault();
        localStorage.setItem("current_popup", "addFinal");
        $("#formAddFinal").submit();
    });

    //click start time zen end time
    $(".start-time").change(function() {
        let startTime = $(".start-time").val();
        if (startTime) {
            var endTime = moment(startTime)
                .add(7, "days")
                .format('"YYYY-MM-DD HH:mm:ss"');
            endTime = endTime.substring(1, endTime.length - 1);

            $(".end-time").val(endTime);
            // localStorage.setItem("end-date", endTime);
            $("#end_datetime").val(endTime);
        }
    });

    //click start time final zen end time final
    $(".start-time-final").change(function() {
        let startTime = $(".start-time-final").val();
        if (startTime) {
            var endTime = moment(startTime)
                .add(7, "days")
                .format('"YYYY-MM-DD HH:mm:ss"');
            endTime = endTime.substring(1, endTime.length - 1);

            $(".end-time-final").val(endTime);
            // localStorage.setItem("end-date-final", endTime);
            $("#end_datetime_final").val(endTime);
        }
    });
});
