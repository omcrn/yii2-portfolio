/**
 * Created by berdia on 2/7/17.
 */
$(function () {

    var FileInput = function ($el) {
        this.$el = $el;
        this.$modalCloseButton = $('#om-file-input-cropper-modal .modal-header > .close')[0];
        this.$modalSaveButton = $('#om-file-input-cropper-modal .modal-footer > .save')[0];
        console.log("This is constructor");

        this.init();
    };

    FileInput.prototype = {
        init: function () {
            console.log("Init. Current element: ", this.$el);


            this.$input = $('<input type="file">');
            this.$addNewButton = $('<div class="attachment-add-button"><span class="glyphicon glyphicon-plus"></span></div>');
            this.$removeButton = $('<div class="attachment-item-options"><a class="btn btn-danger attachment-item-remove">Remove</a></div>');
            this.$addNewButton.append(this.$input);
            this.$el.append(this.$addNewButton);
            this.$el.append(this.$removeButton);

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
                $('#om-file-input-cropper-modal').modal('show');
                var $img = $('#om-file-input-cropper-modal .modal-body > .modal-image');
                $img[0].src = e.target.result;
                $img[0].onload = function () {

                    var cropper = new Cropper($img[0], {
                        aspectRatio: 16 / 9,
                        guides: false,
                        autoCropArea: 1,
                        //viewMode: '1',
                        crop: function (data) {
                            console.log(data.x);
                            console.log(data.y);
                            console.log(data.width);
                            console.log(data.height);
                            console.log(data.rotate);
                            console.log(data.scaleX);
                            console.log(data.scaleY);
                        }
                    });

                    me.$modalSaveButton.onclick = function () {
                        var $attachmentItem = $('.attachment-add-button');
                        var $imagePreview = $('<img class="attachment-image-preview">');

                        imageFile = cropper.getCroppedCanvas().toDataURL();

                        $attachmentItem.empty();

                        $attachmentItem.attr('style', 'max-width: 200px; padding: 10px;');
                        $imagePreview.attr('src', imageFile);
                        $attachmentItem.append($imagePreview);
                    };

                    me.$modalCloseButton.onclick = function () {
                        cropper.destroy();
                    };
                };
            };
            reader.readAsDataURL(file);
        }
    };

    $.fn.omFileInput = function () {
        new FileInput(this);
    };

});