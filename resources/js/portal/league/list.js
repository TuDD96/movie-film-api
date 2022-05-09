$(document).ready(function (e) {
  $('.delete-league').click(function () {
    $('#league_id').val($(this).data('delete-league'));
  });
});
