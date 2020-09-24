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
  });
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
