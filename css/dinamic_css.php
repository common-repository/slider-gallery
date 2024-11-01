<?php
header('Content-type: text/css');
require_once( '../../../../wp-load.php' );
//echo get_option('custom_css_gallery');
if ( get_option('custom_css_gallery') == '' ) 
	{

	}else
		{
		echo get_option('custom_css_gallery');
		}

?>