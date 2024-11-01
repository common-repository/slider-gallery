
var slider_mijloc;
var slider_left;
var slider_right;
var slider_dimension;
var slider_curent_index=1;
var slider_nr_thumbnail=8;
var slider_margin=5;
var slider_previous_index=0;
var $j = jQuery.noConflict();
$j(document).ready(function()
{

  slider_update_var ();
  slider_curent_index=1;
  $j("[slider-gallery='photo']").click(function()
		{
		var html="";
		var src2="";
		slider_nr_thumbnail=$j("[slider-gallery='photo']").length;
		slider_curent_index=$j(this).index()+1;
		
		for (i = 1; i <=slider_nr_thumbnail; i++) 
		{
		src2=$j("[slider-gallery='photo']:eq("+(i-1)+") > img").attr('src');
		html+='<div class="slider-gallery-thumbnail-photo slider-thumbnail-photo-border" style="background-image: url(\''+src2+'\');" ></div>';
		}
		$j("#slider-gallery-thumbnail").html(html);	
		var src=$j("[slider-gallery='photo']:eq("+(slider_curent_index-1)+")").attr('href');
		$j("#slider-gallery-photo").css("opacity", "0");
		$j("#slider-gallery-photo").attr('src', src);
		$j("#slider-gallery-photo").animate({opacity:'1'});
		slider_thumbnail_menu ();
		slider_gallery_photo();
		$j("#slider-gallery").show();
		
		 $j(".slider-gallery-thumbnail-photo").click(function()
		{
		
		slider_curent_index=$j(this).index()+1;
		slider_thumbnail_menu ();
		var src=$j("[slider-gallery='photo']:eq("+(slider_curent_index-1)+")").attr('href');
		$j("#slider-gallery-photo").css("opacity", "0");
		$j("#slider-gallery-photo").attr('src', src);
		$j("#slider-gallery-photo").animate({opacity:'1'});
		slider_gallery_photo();
		});
		
		return false;
		});
		
  $j("#slider-gallery-buttons-exit").click(function()
		{
		$j("#slider-gallery").hide();
		});
  $j("#slider-gallery-buttons-right").click(function()
		{
		slider_curent_index++;
		if(slider_curent_index>slider_nr_thumbnail)
			{
			slider_curent_index=1;
			}
		slider_thumbnail_menu ();
		var src=$j("[slider-gallery='photo']:eq("+(slider_curent_index-1)+")").attr('href');
		$j("#slider-gallery-photo").css("opacity", "0");
		$j("#slider-gallery-photo").attr('src', src);
		$j("#slider-gallery-photo").animate({opacity:'1'});
		slider_gallery_photo();
		});
  $j("#slider-gallery-buttons-left").click(function()
		{
		slider_curent_index--;
		if(slider_curent_index<1)
			{
			slider_curent_index=slider_nr_thumbnail;
			}
		slider_thumbnail_menu ();
		var src=$j("[slider-gallery='photo']:eq("+(slider_curent_index-1)+")").attr('href');
		$j("#slider-gallery-photo").css("opacity", "0");
		$j("#slider-gallery-photo").attr('src', src);
		$j("#slider-gallery-photo").animate({opacity:'1'});
		slider_gallery_photo();
		});
	$j("#slider-gallery-buttons-right2").click(function()
		{
		slider_curent_index++;
		if(slider_curent_index>slider_nr_thumbnail)
			{
			slider_curent_index=1;
			}
		slider_thumbnail_menu ();
		var src=$j("[slider-gallery='photo']:eq("+(slider_curent_index-1)+")").attr('href');
		$j("#slider-gallery-photo").css("opacity", "0");
		$j("#slider-gallery-photo").attr('src', src);
		$j("#slider-gallery-photo").animate({opacity:'1'});
		slider_gallery_photo();
		});
  $j("#slider-gallery-buttons-left2").click(function()
		{
		slider_curent_index--;
		if(slider_curent_index<1)
			{
			slider_curent_index=slider_nr_thumbnail;
			}
		slider_thumbnail_menu ();
		var src=$j("[slider-gallery='photo']:eq("+(slider_curent_index-1)+")").attr('href');
		$j("#slider-gallery-photo").css("opacity", "0");
		$j("#slider-gallery-photo").attr('src', src);
		$j("#slider-gallery-photo").animate({opacity:'1'});
		slider_gallery_photo();
		});
});

$j( window ).resize(function() {
	
	var hc=$j("#slider-gallery-container").height();
	var wc=$j("#slider-gallery-container").width();
	var hp=$j("#slider-gallery-photo").height();
	var wp=$j("#slider-gallery-photo").width();
	if(hc<hp) 
	{
	slider_gallery_photo();
	} else
		{
			if(wc<wp) 
			{
			slider_gallery_photo();
			}
		} 
	slider_update_var ();
	slider_thumbnail_menu ();

});

function slider_gallery_photo () 
{
	var img = new Image();
	img.onload = function() 
	{
	  hp=this.height;
	  wp=this.width;
	  hc=$j("#slider-gallery-container").height();
	  wc=$j("#slider-gallery-container").width();
	  x=(wc*hp)/wp;
	  if(x>=hc) 
	  {
	  	$j("#slider-gallery-photo").height("100%");
	  	$j("#slider-gallery-photo").width("auto");
	  }
	  if(x<hc) 
	  {
	  	$j("#slider-gallery-photo").width("99%");
	  	$j("#slider-gallery-photo").height("auto");
	  }
	}
	img.src = $j("#slider-gallery-photo").attr('src');
}
function slider_update_var () 
{
var w=$j(window).width();
var wc=$j("#slider-gallery").width();
	if (w>1200)
	{
		slider_dimension=170;
	}
	if ((w<=1200)&&(w>992))
	{
		slider_dimension=130;
	}
	if ((w<=992)&&(w>768))
	{
		slider_dimension=110;
	}
	if ((w<=768)&&(w>480))
	{
		slider_dimension=100;
	}
	if (w<=480)
	{
		slider_dimension=100;
	}
	
	slider_mijloc=(wc/2)-(slider_dimension/2);
	slider_left =0-slider_dimension;
	slider_right =wc;
	slider_curent_index;
	slider_nr_thumbnail;
}
function slider_thumbnail_menu () 
{
	var contor=0;
	var contor2=0;
	for (i = 1; i <=slider_nr_thumbnail; i++) 
	{
	if(i==slider_curent_index)
		{
		$j(".slider-gallery-thumbnail-photo:eq("+(slider_previous_index-1)+")").removeClass( "slider-curent-index");
		$j(".slider-gallery-thumbnail-photo:eq("+(slider_previous_index-1)+")").addClass( "slider-thumbnail-photo-border");
		$j(".slider-gallery-thumbnail-photo:eq("+(i-1)+")").removeClass( "slider-thumbnail-photo-border");
		$j(".slider-gallery-thumbnail-photo:eq("+(i-1)+")").addClass( "slider-curent-index");
		slider_previous_index=i;
		}
    if(i<=slider_curent_index)
		{
		posicion=(slider_mijloc-((slider_dimension+slider_margin)*(slider_curent_index-i)));
		
		if(posicion>=slider_left)
			{
			$j(".slider-gallery-thumbnail-photo:eq("+(i-1)+")").css("left", posicion+"px");
			}else
				{
				posicion=(slider_mijloc+((slider_dimension+slider_margin)*(slider_nr_thumbnail-slider_curent_index+1)));
				if(posicion<=slider_right)
					{
					$j(".slider-gallery-thumbnail-photo:eq("+(i-1)+")").css("left", (posicion+((slider_dimension+slider_margin)*(i-1)))+"px");
					}else
						{
						$j(".slider-gallery-thumbnail-photo:eq("+(i-1)+")").css("left", (slider_left-1)+"px");
						}
				}
		}
	if(i>slider_curent_index)
		{
		posicion=(slider_mijloc+((slider_dimension+slider_margin)*(i-slider_curent_index)));
		if(posicion<=slider_right)
			{
			$j(".slider-gallery-thumbnail-photo:eq("+(i-1)+")").css("left", posicion+"px");
			}else
				{
				posicion=(slider_mijloc-((slider_dimension+slider_margin)*(slider_curent_index-0)));
				if(posicion>=slider_left)
					{
					$j(".slider-gallery-thumbnail-photo:eq("+(i-1)+")").css("left", (posicion-((slider_dimension+slider_margin)*(contor)))+"px");
					contor++;
					}else
						{
						$j(".slider-gallery-thumbnail-photo:eq("+(i-1)+")").css("left", (slider_right+1)+"px");
						}
				}
		}
	}
}