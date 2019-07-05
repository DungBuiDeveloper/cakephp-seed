// disable auto discover
Dropzone.autoDiscover = false;
// init dropzone on id (form or div)
$( document ).ready(() => {
  $('.slider-lastest').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3
  });


  //Call Dropzone
  if ($('#myDropzone').length) {
    var myDropzone = new Dropzone("#myDropzone", {
      url: "/articles/uploadImage",
      paramName: "file",
      autoProcessQueue: false,
      uploadMultiple: true, // uplaod files in a single request
      parallelUploads: 100, // use it with uploadMultiple
      maxFilesize: 15, // MB
      maxFiles: 1,
      acceptedFiles: ".jpg, .jpeg, .png",
      addRemoveLinks: true,
      resizeQuality:0.8,
      resizeWidth: 1024,
      // Language Strings
      dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
      dictInvalidFileType: "Invalid File Type",
      dictCancelUpload: "Cancel",
      dictRemoveFile: "Remove",
      dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
      dictDefaultMessage: "Drop files here to upload",
    });
  }


}); // End document






//Dropzone Config

Dropzone.options.myDropzone = {
    // The setting up of the dropzone
    init: function() {
        var myDropzone = this;

        // First change the button to actually tell Dropzone to process the queue.
        $("#dropzoneSubmit").on("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();

            if (myDropzone.files != "") {
                myDropzone.processQueue();
            } else {
              $("#myDropzone").submit();
            }

            $('#loader-ajax-devant').addClass('active');

        });

        // on error
        this.on("error", function(file, response) {
          alert(response);
          myDropzone.removeFile(file);
        });

        // on success
        this.on("successmultiple", function(file,response) {
          console.log();
          console.log("");

          $('#image-feture').val(JSON.parse(response)[0]);
          $("#article_submit").submit();

        });
    }
};
