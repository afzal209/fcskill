// Copyright (c) 2015, Fujana Solutions - Moritz Maleck. All rights reserved.
// For licensing, see LICENSE.md

CKEDITOR.plugins.add('imageuploader', {
    init: function(editor) {
        editor.config.filebrowserBrowseUrl = 'http://127.0.0.1:8000/vendor/unisharp/laravel-ckeditor/plugins/imageuploader/imgbrowser.php';
    }
});