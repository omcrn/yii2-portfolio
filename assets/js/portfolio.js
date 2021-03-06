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
    _cropper: null,

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
        me.removeFile($this.closest('.om-file-preview-wrapper'));
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

          me.initCropper($img);
          me.$modalSaveButton.onclick = function () {
            var imgSrc = $img.cropper('getCroppedCanvas').toDataURL();
            // let $img = me._compileTemplate(me._fileTemplate, {'imgSource': imgSrc});
            me.$container.addClass('om-has-file');

            me.appendFile(file, imgSrc);
          };

          cropperModal.on('hidden.bs.modal', function () {
            $img.cropper('destroy');
          });
        };
      };
      reader.readAsDataURL(file);
    },

    initCropper: function initCropper($img) {
      var me = this;
      setTimeout(function () {
        me._cropper = $img.cropper({
          aspectRatio: 1,
          guides: false,
          autoCropArea: 1
        });
      }, 100);
    },

    removeFile: function removeFile($wrapper) {
      var me = this;
      var index = $wrapper.index();
      console.log(index);
      me.files.splice(index, 1);
      me.fileSources.splice(index, 1);
      $wrapper.remove();
      if (!me.files.length) {
        me.$container.removeClass('om-has-file');
      }
    },

    appendFile: function appendFile(blobFile, src) {
      this.files.push(blobFile);
      this.fileSources.push(src);
      this.renderFiles();
    },

    _compileTemplate: function _compileTemplate(tpl, data) {
      for (var key in data) {
        tpl = tpl.replace(new RegExp('{' + key + '}', 'g'), data[key]);
      }
      return tpl;
    }
  };

  $.fn.omFileInput = function () {
    new FileInput(this);
  };
});