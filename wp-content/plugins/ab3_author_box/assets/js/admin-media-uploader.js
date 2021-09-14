/**
 * Media upload script for WP admin
 * Taken from: https://gist.github.com/LHC-Developer/ee223307abffb7139d2c4d17de5260b0#file-wordpress-media-uploader-javascript-js
 * Modified so that it will work for multiple textboxes by using the custom attribute: data-target-textbox
 */

jQuery(document).ready(function($){
  var mediaUploader;
  $('#upload_image_button').click(function(e) {
    e.preventDefault();      

    // get the attribute from the button and append a hash for the id of the textbox
    var targetBox = '#' + $(this).attr('data-target-textbox');

    // open the media picker ui
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    //copy other codes
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    }, multiple: false });

    // when an image is selected, fire it back to the textbox field
    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
      
      $(targetBox).val(attachment.url);
    });

    mediaUploader.open();
  });
});