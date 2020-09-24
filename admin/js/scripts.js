$(document).ready(function () {
  $("#summernote").summernote({
    styleTags: [
      "p",
      {
        title: "Blockquote",
        tag: "blockquote",
        className: "blockquote",
        value: "blockquote",
      },
      "pre",
      "h1",
      "h2",
      "h3",
      "h4",
      "h5",
      "h6",
    ],
    fontSizeUnits: ["px", "pt"],

    height: $(window).height() - 300,
    callbacks: {
      onImageUpload: function (image) {
        uploadImage(image[0]);
      },
    },
  });

  function uploadImage(image) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
      url: "./cms/img02",
      cache: false,
      contentType: false,
      processData: false,
      data: data,
      type: "post",
      success: function (url) {
        var image = $("<img>").attr("src", "http://" + url);
        $("#summernote").summernote("insertNode", image[0]);
      },
      error: function (data) {
        console.log(data);
      },
    });
  }
});

$(document).ready(function () {
  $("#selectAllBoxes").click(function () {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });
});

function loadUsersOnline() {
  $.get("functions.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
  });
}

setInterval(function () {
  loadUsersOnline();
}, 500);
