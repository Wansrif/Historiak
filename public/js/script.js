// PREVIEW IMAGE
function previewImg() {
  const gambar = document.querySelector('#gambar');
  const gambarLabel = document.querySelector('.custom-file-label');
  const imgPreview = document.querySelector('.img-preview');

  gambarLabel.textContent = gambar.files[0].name;

  const fileGambar = new FileReader();
  fileGambar.readAsDataURL(gambar.files[0]);

  fileGambar.onload = function (e) {
    imgPreview.src = e.target.result;
  }
}

ClassicEditor
  .create(document.querySelector('#isi'), {
    ckfinder: {
      uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
    },
    image: {
      toolbar: [
        'imageStyle:full',
        'imageStyle:side',
        '|',
        'imageTextAlternative'
      ],

      // The default value.
      styles: [
        'full',
        'side'
      ]
    },
    toolbar: [
      'heading', '|',
      'bold', 'italic', 'underline', 'link', 'numberedList', 'bulletedList', '|',
      'alignment', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'removeFormat', '|',
      'ckfinder', 'imageInsert', 'mediaEmbed', '|',
      'blockQuote', 'undo', 'redo', '|',
    ],
  })
  .catch(error => {
    console.log(error);
  })
