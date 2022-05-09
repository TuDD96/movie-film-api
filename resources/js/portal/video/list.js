$(document).ready(function (e) {
  $('.delete-btn').click(function () {
    $('#video-id').val($(this).data('delete-video'));
  });
  $('.add-video').click(function () {
    localStorage.setItem('video_create', 'videoCreate');
    $('#formAddVideo').submit();
  });
  const videoSrc = document.querySelector("#video-source");
  const videoTag = document.querySelector("#video-tag");
  const inputTag = document.querySelector("#input-tag");

  inputTag.addEventListener('change',  readVideo)

  function readFileVid(input, vid = null) {
    $(".delete-error-after-true-video").html("");
    $("#msgError span").html("");
    $("#video-tag").removeClass("d-none");
    $(".box-upload-video").addClass("d-none");

    if (vid && vid[0]) {
      let typeVideo = vid[0].type;
      if (typeVideo == '' || typeVideo !== "video/mp4") {
        $(".dropzone-wrapper-video").attr("style", "height: 250px; border: 2px dashed #dc3545 !important");
        $('#msgError span').attr("style", "color: #dc3545 !important; text-align: left");
        $('#msgError span').html("MP4形式の画像を指定してください。");
        return;
      }
      if (vid[0].size > 500*1024*1024) {
        $(".dropzone-wrapper-video").attr("style", "height: 250px; border: 2px dashed #dc3545 !important");
        $('#msgError span').attr("style", "color: #dc3545 !important; text-align: left");
        $('#msgError span').html("動画には、500MB以下のファイルを指定してください。");
        return;
      }
      var reader = new FileReader();
      $('#msgError span').html("");
      $(".dropzone-wrapper-video").attr("style", "border: 2px dashed #91b0b3 !important");

      reader.onload = function(e) {
        videoSrc.src = e.target.result
        videoTag.load()
      }.bind(this)

      document.getElementById('input-tag').files = vid;
      reader.readAsDataURL(vid[0]);
    }
  }

  $(document).ready(function() {
    var counter = 0;
    $("#drag-drop-video").on('dragenter', function(e) {
        e.preventDefault();
        counter++;
        $(this).css('border', '#39b311 2px dashed');
        $(this).css('background', '#f1ffef');
    });

    $("#drag-drop-video").on('dragover', function(e) {
        e.preventDefault();
    });

    $("#drag-drop-video").on('dragleave', function(e) {
        e.preventDefault();
        counter--;
        if (counter === 0) { 
            $(this).css('border', '#91b0b3 2px dashed');
            $(this).css('background', '#ebedef');
        }
    });

    $("#drag-drop-video").on('drop', function(e) {
        $(this).css('border', '#07c6f1 2px dashed');
        $(this).css('background', '#FFF');
        e.preventDefault();
        var vid = e.originalEvent.dataTransfer.files;
        readFileVid($(this).children("#input-tag"), vid);
    });
  });

  function readVideo(event) {
    $(".delete-error-after-true-video").html("");
    $("#msgError span").html("");

    if (event.target.files && event.target.files[0]) {
      let typeVideo = event.target.files[0].type;
      if (typeVideo == '' || typeVideo !== "video/mp4") {
        $(".dropzone-wrapper-video").attr("style", "height: 250px; border: 2px dashed #dc3545 !important");
        $('#msgError span').attr("style", "color: #dc3545 !important; text-align: left");
        $('#msgError span').html("MP4形式の画像を指定してください。");
        return;
      }
      if (event.target.files[0].size > 500*1024*1024) {
        $(".dropzone-wrapper-video").attr("style", "height: 250px; border: 2px dashed #dc3545 !important");
        $('#msgError span').attr("style", "color: #dc3545 !important; text-align: left");
        $('#msgError span').html("動画には、500MB以下のファイルを指定してください。");
        return;
      }
      var reader = new FileReader();
      $('#msgError span').html("");
      $(".dropzone-wrapper-video").attr("style", "border: 2px dashed #91b0b3 !important");

      reader.onload = function(e) {
        videoSrc.src = e.target.result
        videoTag.load()
      }.bind(this)

      reader.readAsDataURL(event.target.files[0]);
    }
  }

  $('.icons').click(function () {
    $('#video-source-add').attr('src', $(this).data('upload-video'));
    $("#video-show")[0].load();
  });
  $('.btn-add-popup').click(function () {
    $('#video-source').attr('src', '');
    $("#video-tag")[0].load();
    $('input.error, textarea.error, select.error, .error.hasDatepicker').removeClass('error');
    $('label.error, div.errors').remove();
    $("#input-tag").val('');
    $('#msgError p').html("");
    $('#msgError span').html("");
    $(".dropzone-wrapper-video").attr("style", "border: 2px dashed #91b0b3 !important");
    $(".dropzone-wrapper").attr("style", "border: 2px dashed #91b0b3 !important");
  });
});
