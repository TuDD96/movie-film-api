$(document).ready(function() {
    // set value limit record
    setValueLimitRecord();

    // handle click limit record
    handleClickLimitRecord();

    // get value sort in url
    getValueSortInUrl();

    // handleClickIconSort
    handleClickIconSort();
    console.log("sttSort", sttSort);
});

// handle limit record

let currentUrl = $(location).attr("href");
let url = new URL(currentUrl);
let limitUrl = url.searchParams.get("limit") || 10;
var sttSort = true;

function getParamsUrl(url) {
    var params = {};
    var parser = document.createElement("a");
    parser.href = url;
    var query = parser.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        params[pair[0]] = decodeURIComponent(pair[1]);
    }
    return params;
}

function linkedParam(objects, keys) {
    let newObj = "";
    Object.keys(objects).forEach(key => {
        if (!keys.includes(key)) {
            newObj += "&" + key + "=" + objects[key];
        }
    });
    return newObj.replace("&", "");
}

function setValueLimitRecord() {
    $("#limit").val(limitUrl);
}

function handleClickLimitRecord() {
    $(".per-page").change(function() {
        let limit = $(".per-page option:selected").val();
        if (currentUrl.indexOf("limit") !== -1) {
            var href = new URL(currentUrl);
            href.searchParams.set("page", "1");

            let redirectUrl = href
                .toString()
                .replace("limit=" + limitUrl, "limit=" + limit);
            window.location = redirectUrl;
        } else {
            let href = new URL(currentUrl);
            href.searchParams.set("page", "1");

            href += href.toString().indexOf("?") !== -1 ? "&limit=" : "?limit=";
            href += limit;

            window.location = href;
        }
    });
}

let sortInput = url.searchParams.get("sort");

function getValueSortInUrl() {
    $("#sort").val(sortInput);
    if (sortInput) {
        let sortArray = sortInput.split(",");
        sortArray.forEach(function(value, index) {
            let dataInput = value.split("-");
            $(".parent_" + dataInput[0]).attr(
                "aria-sort",
                dataInput[1] === "asc" ? "ascending" : "descending"
            );
        });
    }
}

function handleClickIconSort() {
    $(".sort").click(function() {
        let currentButtonSort = $(this).attr("aria-sort");
        if (sttSort) {
            // none -> asc -> desc -> none
            switch (currentButtonSort) {
                case "none":
                    sortASC($(this));
                    break;
                case "ascending":
                    sortDESC($(this));
                    break;
                case "descending":
                    sortNone($(this));
                    break;
            }
            sttSort = !sttSort;
        }
    });
}

function sortASC(elementSort) {
    elementSort.attr("aria-sort", "ascending");
    fieldSort = elementSort.find("input").val();
    if (sortInput === "") {
        window.location = currentUrl.replace(
            "sort=",
            "sort=" + fieldSort + "-asc"
        );
    } else {
        if (currentUrl.indexOf("sort") !== -1) {
            var regex = /[?&]([^=#]+)=([^&#]*)/g,
                params = {},
                match;
            while ((match = regex.exec(currentUrl))) {
                params[match[1]] = match[2];
            }
            window.location = currentUrl.replace(
                "sort=" + params["sort"],
                "sort=" + params["sort"] + "," + fieldSort + "-asc"
            );
        } else {
            let href = currentUrl;
            href += currentUrl.indexOf("?") !== -1 ? "&sort=" : "?sort=";
            href += fieldSort + "-asc";

            window.location = href;
        }
    }
}

function sortDESC(elementSort) {
    elementSort.attr("aria-sort", "descending");
    fieldSort = elementSort.find("input").val();
    if (currentUrl.indexOf("sort") !== -1) {
        if (sortInput.indexOf(fieldSort) !== -1) {
            window.location = currentUrl.replace(
                fieldSort + "-asc",
                fieldSort + "-desc"
            );
        } else {
            window.location = currentUrl.replace(
                "sort=" + sortInput,
                "sort=" + sortInput + "," + fieldSort + "-desc"
            );
        }
    }
}

function sortNone(elementSort) {
    elementSort.attr("aria-sort", "none");
    fieldSort = elementSort.find("input").val();
    var params = getParamsUrl(currentUrl);
    var paramSort = params.sort
        .split(",")
        .filter(function(item) {
            return item != fieldSort + "-asc" && item != fieldSort + "-desc";
        })
        .join(",");
    var paramSearch = linkedParam(params, "sort");
    var pathname = window.location.pathname;
    var href =
        window.location.origin +
        pathname +
        "?" +
        paramSearch +
        (paramSearch ? "&" : "") +
        "sort=" +
        paramSort;
    window.location = href;
}
