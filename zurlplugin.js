( function() {
    tinymce.PluginManager.add( 'at_zurlpreview', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'at_zurlpreview_button_key', {

            title: 'Insert URL',
            image: url + '/button.png',
            onclick: function() {
                // Open window
                editor.windowManager.open( {
                    title: 'Z-URL Preview Plugin',
                    body: [{
                        type: 'textbox',
                        name: 'title',
                        label: 'Enter URL'
                    }],
                    onsubmit: function( e ) {
                        // Insert content when the window form is submitted
                        //editor.insertContent( 'Title: ' + e.data.title );

                        jQuery.ajax({
                            url: url + '/class.zlinkpreview.php',
                            data: 'url=' + e.data.title + '&image_no=' + 1 + '&css=' + true,
                            type: 'get',
                            success: function(html) {
                                //loader.stop();
                                editor.insertContent(html);
                            }
                        })
                    }
                } );
            }
        } );
    } );
} )();