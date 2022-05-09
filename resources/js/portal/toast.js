toastr.options = {
  "closeButton": true,
  "progressBar": true,
  "positionClass": "toast-top-center",
  "timeOut": "2000",
}

$(document).ready(function (e) {
  let toastSuccess = $('#show-toast-success');
  let toastError = $('#show-toast-error');

  if (toastSuccess.length > 0) {
    toastr.info(toastSuccess.data('msg'));
  } else if (toastError.length > 0) {
    toastr.error(toastError.data('msg'));
  }
});
