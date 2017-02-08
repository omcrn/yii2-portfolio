/**
 * Created by berdia on 2/7/17.
 */
$(function () {

    var FileInput = function ($el) {
        this.$el = $el;
        console.log("This is constructor");

        this.init();
    };

    FileInput.prototype = {
        init: function () {
            console.log("Init. Current element: ", this.$el);


            this.$input = $('<input type="file">');
            this.$addNewButton = $('<div class="attachment-add-button"><span class="glyphicon glyphicon-plus"></span></div>');
            this.$removeButton = $('<div class="attachment-item-options"><a class="btn btn-danger">Remove</a></div>');
            this.$addNewButton.append(this.$input);
            this.$el.append(this.$addNewButton);
            this.$el.append(this.$removeButton);

            this.listenOnChange();
        },

        listenOnChange: function () {
            var me = this;

            this.$input.on('change', function ($ev) {
                console.log($ev.target.files);
                me.readFile($ev.target.files[0]);
            });
        },

        readFile: function (file) {
            var me = this;
            var $saveButton = $('.modal-footer > a')[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#om-file-input-cropper-modal').modal('show');
                var $img = $('#om-file-input-cropper-modal').find('img');
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

                    $saveButton.onclick = function () {
                        var $attachmentItem = $('.attachment-add-button');
                        var $imagePreview = $('<img>');

                        $attachmentItem.empty();
                        $imagePreview.addClass('attachment-image-preview');
                        $imagePreview.attr('src', cropper.getCroppedCanvas().toDataURL());
                        $imagePreview.attr('style', "width : 120px;");
                        $attachmentItem.attr('style', "padding : 20px;");
                        $attachmentItem.append($imagePreview);
                    };
                };
            };
            reader.readAsDataURL(file);
        },

        _privateMethod: function () {

        },

        initCropper: function () {

        },


    };

    $.fn.omFileInput = function () {
        new FileInput(this);
    }

});