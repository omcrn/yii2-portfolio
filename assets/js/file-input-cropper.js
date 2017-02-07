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
            this.$addNewButton.append(this.$input);
            this.$el.append(this.$addNewButton);

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
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#om-file-input-cropper-modal').modal('show');
                var $img = $('#om-file-input-cropper-modal').find('img');
                $img[0].src = e.target.result;
                $img[0].onload = function () {

                    var cropper = new Cropper($img[0], {
                        aspectRatio: false,
                        guides: false,
                        autoCropArea: 0.5,
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