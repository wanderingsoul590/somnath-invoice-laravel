$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

toastr.options = {
    closeButton: true,
};

function getPageLengthDatatable() {
    return [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
    ];
}

function deleteValueSet(id) {
    $("#id").val(id);
}

function sendInvoiceValueSet(id) {
    $("#invoice_id").val(id);
}

function previewImgValueSet(value) {
    $("#previewImg").attr("src", value);
}

function identityPreviewImgValueSet(value) {
    $("#identityPreviewImg").attr("src", value);
}

$(document).on("click", ".custom_click_cls", function () {
    $("#id").val($(this).attr("data-id"));
});

function deleteInviteValueSet(id) {
    $("#invite_id").val(id);
}

function resendEmailInviteValueSet(id) {
    $("#resend_invite_id").val(id);
}

function deleteDeceasedValue(id) {
    $("#deceased_id").val(id);
}

function ajaxfunc(url, data, type, callback) {
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function (data) {
            //NProgress.done();
            callback(data);
        },
        error: function (xhr, status, error, data) {
            //NProgress.done();
            errorHandle(xhr.status, xhr);
            //errorHandle(xhr.responseJSON.status,xhr)
        },
    });
}

function removeQueryStringInURL() {
    var queryString = window.location.href.split('?');
    if (queryString.length == 2) {
        window.history.pushState(null, null, window.location.href.split('?')[0]);
    }

}