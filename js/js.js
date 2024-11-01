jQuery(document).ready(function($){


		$('#upload_gallery_myplugin').click(function() {
	
			
         var uploader_avatar = wp.media({
            title: 'Gallery Photo',
            button: { text:  'Insert' },
			library     : { type : 'image' },
			multiple: true
        }).on('select', function(){
			var selection = uploader_avatar.state().get('selection');
			var attachments =[];
			selection.map( function(attachment) 
			{
				attachment = attachment.toJSON();
				attachments.push(attachment.id);
			})

			$('#custom_attributes_img_array').val( attachments );
			load_more_photo( attachments );
;
		}).open();
    
});


	$('#default_custom_css_gallery').click(function() {
	
	var default_css='.thumbnail-img{width: auto;height:100px;margin:5px;}.thumbnail-link{text-decoration:none;}.thumbnail-link:hover{text-decoration:none;}.thumbnail-link:active{text-decoration:none;}.thumbnail-link:visited{text-decoration:none;}'; 
	
	$('#custom_css_gallery').val( default_css );
	});
	
	$('#clean_gallery_button').click(function() {
	
	$('#gallery_container').html( "" );
	$('#custom_attributes_img_array').val('');
	});
	
	function load_more_photo( gallery_array )
	{
	var htmlresponse="";
	jQuery("#load-footer").show();

    jQuery.ajax({
        url: ajaxurl,

        data: {
            'action':'ajax_photo_load',
            'gallery_array' : gallery_array
        },
        success:function(data) {

			jQuery('#gallery_container').html(data);

        },
        error: function(errorThrown){
            load_more_photo();
        }
    });
	}
	

});