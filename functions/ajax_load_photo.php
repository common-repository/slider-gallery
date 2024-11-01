<?php
add_action( 'wp_ajax_ajax_photo_load', 'ajax_photo_load' );
add_action( 'wp_ajax_nopriv_ajax_photo_load', 'ajax_photo_load' );

function ajax_photo_load() 
{
if ( isset($_REQUEST['gallery_array']) ) 
	{
	$arr = $_REQUEST['gallery_array'];
	for($i=0; $i<count($arr); $i++)
	{
	$src=wp_get_attachment_image_src( esc_attr( $arr[$i] ),'thumbnail' );
	$html.='<img class="gallery_container" src="'.$src[0].'" >';
	}
	echo $html;
	die();
	}else
	{
	die();
	}
}


?>