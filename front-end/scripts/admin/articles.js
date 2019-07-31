


// disable auto discover
Dropzone.autoDiscover = false;
// init dropzone on id (form or div)
$( document ).ready(() => {

  if ($('#myDropzone').length) {
    var myDropzone = new Dropzone("#myDropzone", {
      url: "/admin/articles/uploadImage",
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



  /**
   * [Setting article for add]
   * @type {Boolean}
   */
  if ($('#article_add_submit').length) {

    $('#categories').attr('multiple','');
    $('#categories').selectpicker({
      liveSearch:true,
      multipleSeparator:','
    });


    $('#tags').attr('multiple','');
    $('#tags').selectpicker({
      liveSearch:true,
      multipleSeparator:','
    });
    // $('#tags').val('');
    // $('#categories').val('');


    $('#categories').selectpicker('refresh');
    $('#tags').selectpicker('refresh');

  }


  /**
   * [Setting article for Edit]
   * @type {Boolean}
   */
  if ($('#article_edit_submit').length) {
    $('#categories').attr('multiple','');
    $('#categories').selectpicker({
      liveSearch:true,
      multipleSeparator:','
    });



    $('#tags').attr('multiple','');
    $('#tags').selectpicker({
      liveSearch:true,
      multipleSeparator:','
    });


    $('#categories').selectpicker('refresh');
    $('#tags').selectpicker('refresh');

  }
}); // End document




Dropzone.options.myDropzone = {
    // The setting up of the dropzone
    init: function() {
        var myDropzone = this;

        // First change the button to actually tell Dropzone to process the queue.
        $("#dropzoneSubmit").on("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();

            if (myDropzone.files.length !== 0) {
                myDropzone.processQueue();
            } else {
              $("#article_add_submit").submit();
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


          $('#image-feture').val(JSON.parse(response)[0]);
          $("#article_add_submit").submit();

        });
    }
};
