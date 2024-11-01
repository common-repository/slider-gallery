<?php

function slider_gallery_shortcode( $atts ) {
	
    $a = shortcode_atts( array(
        'id' => -1,
        
    ), $atts );
	if($a['id']!=-1)
		{
		
		$img_array=get_post_meta($a['id'] , 'custom_attributes_img_array', true);
		$img_array=explode(",",$img_array);
		$class_div=get_post_meta($a['id'] , 'custom_attributes_div_class', true);
		$id_div=get_post_meta($a['id'] , 'custom_attributes_div_id', true);
		$class_link=get_post_meta($a['id'] , 'custom_attributes_a_class', true);
		$class_img=get_post_meta($a['id'] , 'custom_attributes_img_class', true);
		//echo $img_array;
		$html="";
		?>
		
		<div id="<?php echo $id_div; ?>" class="<?php echo $class_div; ?>"  slider-gallery="container"   >
			
<?php
			for($i=0; $i<count($img_array); $i++)
				{
				if($img_array[$i]!="")
					{
					$src=wp_get_attachment_image_src( esc_attr( $img_array[$i] ),'thumbnail' );
					$src2=wp_get_attachment_image_src( esc_attr( $img_array[$i] ),'full' );
					$html.='<a  slider-gallery="photo" class="'.$class_link.'" href="'.$src2[0].'"> <img  slider-gallery="thumbnail" class="'.$class_img.'" src="'.$src[0].'">  </a>';
					}
				}
		echo $html;
?>	
		</div>
		<?php
		}else
			{
			return "";
			}
    
}
add_shortcode( 'slider_gallery', 'slider_gallery_shortcode' );
?>