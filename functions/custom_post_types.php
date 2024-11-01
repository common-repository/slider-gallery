<?php
$prefix = 'custom_attributes_';
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'slider_gallery',
		array(
			'labels' => array(
				'name' => __( 'Gallerys' ),
				'singular_name' => __( 'Gallery' ),
				'add_new_item' => __( 'Add new gallery' ),
			),
		'public' => true,
		'show_in_nav_menus' => false,
		'has_archive' => false,
		'supports' => array('title'),
		)
	);
}


function add_upload_gallery_box() {
    add_meta_box(
        'upload_gallery_box', // $id
        'Upload gallery box', // $title
        'show_upload_gallery_box', // $callback
        'slider_gallery', // $page
        'normal', // $context
        'high'); // $priority
}
add_action('add_meta_boxes', 'add_upload_gallery_box');

function show_upload_gallery_box() 
{
global  $post;
echo '<table class="form-table">';
echo'
<tr>
<td>
	<input class="button-primary" id="upload_gallery_myplugin" type="button" name="save" value="Upload gallery"/>
	<input class="button-primary" id="clean_gallery_button"  type="button" name="save" value="Clean"/>
	<p>Hold Ctrl for selecting multiple files</p>
</td>
</tr>';
echo'
<tr>
<td id="gallery_container">
';
$img_array=get_post_meta($post->ID , 'custom_attributes_img_array', true);
$img_array=explode(",",$img_array);
$html="";
for($i=0; $i<count($img_array); $i++)
	{
	if($img_array[$i]!="")
		{
	$src=wp_get_attachment_image_src( esc_attr( $img_array[$i] ),'thumbnail' );
	$html.='<img class="gallery_container" src="'.$src[0].'" >';
		}
	}
	echo $html;
	
echo'
</td>
</tr>';
echo '</table>';
}




function add_shortcode_box() {
    add_meta_box(
        'shortcode_box', // $id
        'Shortcode Box', // $title
        'show_shortcode_box', // $callback
        'slider_gallery', // $page
        'side', // $context
        'default'); // $priority
}
add_action('add_meta_boxes', 'add_shortcode_box');

function show_shortcode_box() 
{
global  $post;
echo '[slider_gallery id="'.$post->ID.'"]';
}

// Add the Meta Box
function add_custom_attributes_box() {
    add_meta_box(
        'custom_attributes_box', // $id
        'Custom Attributes Box', // $title
        'show_custom_attributes_box', // $callback
        'slider_gallery', // $page
        'normal', // $context
        'default'); // $priority
}
add_action('add_meta_boxes', 'add_custom_attributes_box');


// Field Array

$custom_meta_fields = array(
    array(
        'label'=> 'Div container class',
        'desc'  => 'Class attribute for div gallery container.',
        'id'    => $prefix.'div_class',
		'default'  => '',
        'type'  => 'text'
    ),
	array(
        'label'=> 'Div container id',
        'desc'  => 'Id attribute for div gallery container',
        'id'    => $prefix.'div_id',
		'default'  => '',
        'type'  => 'text'
    ),
	array(
        'label'=> 'Link class',
        'desc'  => 'Class attribute for link gallery.',
        'id'    => $prefix.'a_class',
		'default'  => 'thumbnail-link',
        'type'  => 'text'
    ),
	array(
        'label'=> 'Img class',
        'desc'  => 'Class attribute for thumbnail photo.',
        'id'    => $prefix.'img_class',
		'default'  => 'thumbnail-img',
        'type'  => 'text'
    ),
	array(
        'label'=> '',
        'desc'  => '',
        'id'    => $prefix.'img_array',
		'default'  => '',
        'type'  => 'hidden'
    )
);

// The Callback
function show_custom_attributes_box() {
global $custom_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
     
    // Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($custom_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
		if($meta=="")
			{
			$meta=$field['default'];
			
			}
        // begin a table row with
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
                switch($field['type']) {
                    // case items will go here
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<br /><span class="description">'.$field['desc'].'</span>';
						break;
					case 'hidden':
						echo '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'"  />';
						break;
                } //end switch
        echo '</td></tr>';
    } // end foreach
    echo '</table>'; // end table
}

// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields;
     
    // verify nonce
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    }
     
    // loop through fields and save the data
    foreach ($custom_meta_fields as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}
add_action('save_post', 'save_custom_meta');



?>