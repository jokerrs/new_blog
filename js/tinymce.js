        tinymce.init({
            selector: '#content',
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview | forecolor backcolor emoticons",
            image_class_list: [
                { title: 'Responsive image', value: 'img-fluid rounded' }
            ],
            images_upload_url: './tinymce_image_upload_plugin.php',
            automatic_uploads: false,
            style_formats: [{
                    title: 'Image Left',
                    selector: 'img',
                    styles: {
                        'float': 'left',
                        'margin': '0 10px 0 10px'
                    }
                },
                {
                    title: 'Image Right',
                    selector: 'img',
                    styles: {
                        'float': 'right',
                        'margin': '0 0 10px 10px'
                    }
                }
            ],

            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', 'tinymce_image_upload_plugin.php');

                xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.file_path != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.file_path);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            },
        });