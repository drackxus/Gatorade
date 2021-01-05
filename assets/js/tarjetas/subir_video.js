jQuery(function($) {
    $('body').on('click', '.aw_upload_image_button', function(e) {
        e.preventDefault();

        var button = $(this),
            aw_uploader = wp.media({
                title: 'Video',
                library: {
                    uploadedTo: wp.media.view.settings.post.id,
                    type: 'video'
                },
                button: {
                    text: 'Usar este video'
                },
                multiple: false
            }).on('select', function() {
                var attachment = aw_uploader.state().get('selection').first().toJSON();
                $('#video_loop').val(attachment.url);
            })
            .open();
    });
});