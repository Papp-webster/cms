//CK EDITOR
ClassicEditor.create(document.querySelector("#editor"), {
  toolbar: [
    "heading",
    "|",
    "bold",
    "italic",
    "link",
    "bulletedList",
    "numberedList",
    "blockQuote",
    "|",
    "ckfinder",
    "mediaEmbed",
    "imageUpload",
    "imageResize",
    "|",
    "undo",
    "redo",
  ],

  image: {
    upload: "../img02",
    types: ["png", "jpeg", "webp"],
    resizeUnit: "%",
    resizeOptions: [
      {
        name: "imageResize:original",
        value: null,
      },
      {
        name: "imageResize:50",
        value: "50",
      },
      {
        name: "imageResize:75",
        value: "75",
      },
    ],
  },
  ckfinder: {
    uploadUrl: "../img02",
  },
  mediaEmbed: {
    extraProviders: [
      {
        name: "extraProvider",
        url: /^example\.com\/media\/(\w+)/,
        html: (match) =>
          '<div style="position:relative; padding-bottom:100%; height:0">' +
          '<iframe src="..." frameborder="0" ' +
          'style="position:absolute; width:100%; height:100%; top:0; left:0">' +
          "</iframe>" +
          "</div>",
      },
    ],
  },

  heading: {
    options: [
      {
        model: "paragraph",
        title: "Paragraph",
        class: "ck-heading_paragraph",
      },
      {
        model: "heading1",
        view: "h1",
        title: "Főcim 1",
        class: "ck-heading_heading1",
      },
      {
        model: "heading2",
        view: "h2",
        title: "Főcim 2",
        class: "ck-heading_heading2",
      },
      {
        model: "heading3",
        view: "h3",
        title: "Főcim 3",
        class: "ck-heading_heading3",
      },
      {
        model: "heading4",
        view: "h4",
        title: "Főcim 4",
        class: "ck-heading_heading4",
      },
    ],
  },
}).catch((error) => {
  console.error("Hiba az editorba!", error);
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
