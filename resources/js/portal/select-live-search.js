$(document).ready(function() {
  $('.live-search').select2({
    dropdownParent: $("#modal-content"),
    language: "ja"
  });

  $('.live-search-inventory').select2({
    dropdownParent: $("#modal-content-inventory"),
    language: "ja"
  });

  $('.live-search-edit').select2({
    language: "ja"
  });
});
