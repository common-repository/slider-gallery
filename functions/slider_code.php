<?php

function slider_function() {
?>
    
	<div id="slider-gallery" >
		
			<div id="slider-gallery-buttons-left2" class="slider-gallery-block" >
				<i class="fa fa-chevron-left fa-4x slider-gallery-centered"></i>
			</div>
			
			<div id="slider-gallery-container" class="slider-gallery-block" >
				<img  class="slider-gallery-centered"  id="slider-gallery-photo" src="4.jpg">
			</div>
			
			<div id="slider-gallery-buttons-right2"  class="slider-gallery-block" >
				<i class="fa fa-chevron-right fa-4x slider-gallery-centered"></i>
				<div id="slider-gallery-buttons-exit" class="" >
				<i class="fa fa-times fa-4x"></i>
				</div>
			</div>
			
			<div id="slider-gallery-menu" >
				<div id="slider-gallery-buttons-left" class="slider-gallery-block" >
					<i class="fa fa-chevron-left fa-3x slider-gallery-centered"></i>
				</div>
				<div id="slider-gallery-thumbnail">

				</div>
				<div id="slider-gallery-buttons-right" class="slider-gallery-block" >
					<i class="fa fa-chevron-right fa-3x slider-gallery-centered"></i>
				</div>
			</div>
		</div>
	
<?php
}
add_action('wp_footer', 'slider_function');

?>