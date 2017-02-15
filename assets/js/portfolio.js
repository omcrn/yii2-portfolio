'use strict';

/**
 * Created by berdia on 2/7/17.
 */
$(function () {

  var FileInput = function FileInput($el) {
    this.$input = $el;
    this.$modalSaveButton = $('#om-file-input-cropper-modal .modal-footer > .save')[0];

    if (this.$input.prop('multiple')) {
      this.multiple = true;
      this.$input.removeProp('multiple');
    }

    this.init();
  };

  FileInput.prototype = {

    _template: '\n      <div class="om-file-input-cropper">\n        <div class="om-image-list-wrapper"></div>\n        {input}\n      </div>\n      ',

    _newButtonTemplate: '\n        <div class="om-input-wrapper" style="width: {previewWidth}; height: {previewHeight}">\n          <div class="om-plus-button-wrapper"><span class="glyphicon glyphicon-plus"></span></div>\n          {input}\n        </div>\n      ',

    _fileTemplate: '\n        <div class="om-file-preview-wrapper" style="width: {previewWidth}; height: {previewHeight}" data-index="{index}">\n            <img src="{imgSource}" />\n            <div class="om-file-preview-toolbar">\n                <button type="button" class="btn btn-sm" data-func="remove"><span class="glyphicon glyphicon-remove"></span></button>\n            </div>\n        </div>\n          ',

    multiple: false,
    thumbnailWidth: 180,
    aspectRatio: 1,
    files: [],
    fileSources: [],

    init: function init() {

      this.$container = $(this._compileTemplate(this._template, { files: '', input: '' }));
      if (this.multiple) {
        this.$container.addClass('om-multiple');
      }
      this.$imageListWrapper = this.$container.find('.om-image-list-wrapper');
      this.$container.insertBefore(this.$input);
      this.$addNewButton = $(this._compileTemplate(this._newButtonTemplate, {
        input: '',
        previewWidth: this.thumbnailWidth + "px",
        previewHeight: this.thumbnailWidth * this.aspectRatio + "px"
      }));
      this.$addNewButton.append(this.$input);
      this.$container.append(this.$addNewButton);

      // this.$container = $('<div class="om-file-input-cropper"></div>');
      // this.$listWrapper = $('<div class="om-attachment-list"></div>');
      // this.$inputWrapper = $('<div class="om-input-wrapper"></div>');
      // this.$container.insertBefore(this.$input);
      // this.$addNewButton = $('<div class="attachment-add-button"><span class="glyphicon glyphicon-plus"></span></div>');
      // this.$attachmentOptions = $('');
      // this.$addNewButton.append(this.$input);
      // this.$container.append(this.$addNewButton);

      this.listenOnChange();
    },

    renderFiles: function renderFiles() {
      var me = this;
      var images = "";
      for (var i = 0; i < this.fileSources.length; i++) {
        images += this._compileTemplate(this._fileTemplate, {
          index: i,
          imgSource: this.fileSources[i],
          previewWidth: this.thumbnailWidth + "px",
          previewHeight: this.thumbnailWidth * this.aspectRatio + "px"
        });
      }
      this.$imageListWrapper.html(images);

      console.log(this.files);
      this.$imageListWrapper.find('[data-func="remove"]').on('click', function () {
        var $this = $(this);
        var index = $this.index();
        me.files.splice(index, 1);
        me.fileSources.splice(index, 1);
        $this.closest('.om-file-preview-wrapper').remove();
      });
    },

    listenOnChange: function listenOnChange() {
      var me = this;

      this.$input.on('change', function ($ev) {
        var files = $ev.target.files;
        if (files.length) {
          me.readFile(files[0]);
        }
      });
    },

    readFile: function readFile(file) {
      var me = this;
      var reader = new FileReader();
      reader.onload = function (e) {
        var cropperModal = $('#om-file-input-cropper-modal');
        cropperModal.modal('show');
        var $img = cropperModal.find('.modal-body .modal-image');
        $img[0].src = e.target.result;
        $img.addClass('img-responsive');
        $img[0].onload = function () {

          var cropper = void 0;
          setTimeout(function () {
            cropper = new Cropper($img[0], {
              aspectRatio: 1,
              guides: false,
              autoCropArea: 1
            });
          }, 100);

          me.$modalSaveButton.onclick = function () {
            var imgSrc = cropper.getCroppedCanvas().toDataURL();
            // let $img = me._compileTemplate(me._fileTemplate, {'imgSource': imgSrc});
            me.$container.addClass('om-has-file');

            me.appendFile(file, imgSrc);

            // return;
            //
            // me.$input.hide();
            //
            // me.$addNewButton.attr('style', 'max-width: 192px; padding: 2px;');
            // $imagePreview.attr('src', imageFile);
            // me.$addNewButton.append($imagePreview);
            //
            // cropper.destroy();
            //
            // var removeBtn = $('<span class="glyphicon glyphicon-remove attachment-item-remove"></span>');
            // me.$addNewButton.append(removeBtn);
            //
            // me.$addNewButton.on('mouseover', function () {
            //   removeBtn.show();
            // });
            // me.$addNewButton.mouseleave(function () {
            //   removeBtn.hide();
            // });
            //
            // removeBtn.on('click', function () {
            //   me.clearSelected();
            //   me.init();
            // });
          };

          cropperModal.on('hidden.bs.modal', function () {
            cropper.destroy();
          });
        };
      };
      reader.readAsDataURL(file);
    },

    appendFile: function appendFile(blobFile, src) {
      this.files.push(blobFile);
      this.fileSources.push(src);
      this.renderFiles();
    },

    createPreview: function createPreview() {},

    _compileTemplate: function _compileTemplate(tpl, data) {
      for (var key in data) {
        tpl = tpl.replace(new RegExp('{' + key + '}', 'g'), data[key]);
      }
      return tpl;
    },

    clearSelected: function clearSelected() {
      this.$addNewButton.remove();
    }
  };

  $.fn.omFileInput = function () {
    new FileInput(this);
  };
});