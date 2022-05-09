$(document).ready(function(e) {
    // set locale
    jQuery.datetimepicker.setLocale("ja");

    // init
    initDatetimepicker();

    handleClickIcon();
    trimStartDatepicker();
    handelActionChangeDatepicker();
    removeIconSelectYear();
});

function initDatetimepicker() {
    // init datetimepicker
    let datetimepicker = $(".datetimepicker");

    $.each(datetimepicker, function(index, element) {
        let value = element.dataset.value ?? "";
        let format = element.dataset.format ?? "";

        let allowChoosePastTime =
            Boolean(element.dataset.allow_choose_past_time) ?? false;

        let option = {};

        if (value.length !== 0) {
            option.value = value;
        } else if (format.length !== 0) {
            option.format = "Y-m-d H:i:s";
        }
        option.format = "Y-m-d H:i:s";
        let date = new Date();

        if (allowChoosePastTime) {
            option.minDate = date.getTime();
            option.minTime = date.getHours() + ":" + date.getMinutes();
        }
        $('.datetimepicker[name="' + element.name + '"]').datetimepicker({
            ...option,
            onChangeDateTime: function(dp, $input) {
                // const _this = $('.datetimepicker[name="' + element.name + '"]');
                // _this.val(_this.val().slice(0, -2) + "00");
            },
            onSelectDate: function(ct, $i) {
                const seft = $('.datetimepicker[name="' + element.name + '"]');
                for (let i = 0; i < seft.length; i++) {
                    const element = seft[i];
                    element.value = element.value.slice(0, -2) + "00";
                }
            },
            onSelectTime: function(ct, $i) {
                const seft = $('.datetimepicker[name="' + element.name + '"]');
                for (let i = 0; i < seft.length; i++) {
                    const element = seft[i];
                    element.value = element.value.slice(0, -2) + "00";
                }
            }
        });
    });
}

function handleClickIcon() {
    let datetimepickerIcon = $(".datetimepicker-icon");

    $(document).on("click", ".datetimepicker-icon", function() {
        $(this)
            .prev()
            .datetimepicker("toggle");
    });
}

function trimStartDatepicker() {
    // $(".datetimepicker").on("change", function(event) {
    //     if (
    //         event.keyCode != 37 &&
    //         event.keyCode != 38 &&
    //         event.keyCode != 39 &&
    //         event.keyCode != 40
    //     ) {
    //         this.value = this.value.trim();
    //     }
    // });
}

function handelActionChangeDatepicker() {
    // var patt = new RegExp("^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$");

    // $(".datetimepicker").on("change", function() {
    //     const invalidDate = moment(this.value).format('"YYYY-MM-DD HH:mm:ss"').toString() === "Invalid date";
    //     let now;
    //     if (!patt.test(this.value) || invalidDate) {
    //         now = moment().format('"YYYY-MM-DD HH:mm:ss"');
    //         now = now.substring(1, now.length - 1);
    //     }
        
    //     if (now) this.value = now
    // });
}

function removeIconSelectYear() {
    $(".xdsoft_datetimepicker .xdsoft_year i").remove();
}