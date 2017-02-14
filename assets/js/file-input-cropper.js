/**
 * Created by berdia on 2/7/17.
 */
$(function () {

  var FileInput = function ($el) {
    this.$input = $el;
    this.$modalSaveButton = $('#om-file-input-cropper-modal .modal-footer > .save')[0];

    console.log("This is constructor");

    this.init();
  };

  FileInput.prototype = {
    init: function () {
      this.$container = $('<div class="attachment-list"></div>');
      this.$container.insertBefore(this.$input);
      this.$addNewButton = $('<div class="attachment-add-button"><span class="glyphicon glyphicon-plus"></span></div>');
      this.$attachmentOptions = $('');
      this.$addNewButton.append(this.$input);
      this.$container.append(this.$addNewButton);

      this.listenOnChange();
    },

    listenOnChange: function () {
      var me = this;
      var selectedImage;

      this.$input.on('change', function ($ev) {
        console.log($ev.target.files);
        var files = $ev.target.files;
        var len = $ev.target.files.length;
        selectedImage = files[len - 1];
        me.readFile(selectedImage);
      });
    },

    readFile: function (file) {
      var me = this;
      var imageFile = file;
      var reader = new FileReader();
      reader.onload = function (e) {
        var cropperModal = $('#om-file-input-cropper-modal');
        cropperModal.modal('show');
        var $img = $('#om-file-input-cropper-modal .modal-body .modal-image');
        $img[0].src = e.target.result;
        $img.addClass('img-responsive');
        $img[0].onload = function () {

          var cropper;
          setTimeout(function () {
            cropper = new Cropper($img[0], {
              aspectRatio: 1,
              guides: false,
              autoCropArea: 1
            });
          }, 100);

          me.$modalSaveButton.onclick = function () {
            var $imagePreview = $('<img class="attachment-image-preview">');

            imageFile = cropper.getCroppedCanvas().toDataURL();

            me.$input.hide();

            me.$addNewButton.attr('style', 'max-width: 192px; padding: 2px;');
            $imagePreview.attr('src', imageFile);
            me.$addNewButton.append($imagePreview);

            cropper.destroy();

            var removeBtn = $('<span class="glyphicon glyphicon-remove attachment-item-remove"></span>');
            me.$addNewButton.append(removeBtn);

            me.$addNewButton.on('mouseover', function () {
              removeBtn.show();
            });
            me.$addNewButton.mouseleave(function () {
              removeBtn.hide();
            });

            removeBtn.on('click', function () {
              me.clearSelected();
              me.init();
            });
          };

          cropperModal.on('hidden.bs.modal', function () {
            cropper.destroy();
          });
        };
      };
      reader.readAsDataURL(file);
    },

    clearSelected: function () {
      this.$addNewButton.remove();
    }
  };

  $.fn.omFileInput = function () {
    new FileInput(this);
  };

});