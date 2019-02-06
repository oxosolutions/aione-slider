<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://oxosolutions.com
 * @since      1.0.0
 *
 * @package    Aione_Slider
 * @subpackage Aione_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Aione_Slider
 * @subpackage Aione_Slider/public
 * @author     OXO Solution® <contact@oxosolutions.com>
 */
class Aione_Slider_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aione_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aione_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/aione-slider-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aione_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aione_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/aione-slider-public.js', array( 'jquery' ), $this->version, false );

	}

	public function aione_slider_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'id' => '',
			'class' => '',
		), $atts, 'aione-slider' );

		$output = '';
		$slider_id = $atts['id'];

		if ( get_post_status ( $slider_id ) == 'publish' ) {
			if ( get_post_type( $slider_id ) == 'aione-slider' ) {
				$slider_type = get_field('aione_slider_type', $slider_id);
				$items = get_field('items', $slider_id);
				$theme = get_field('theme', $slider_id);
				$margin = get_field('margin', $slider_id);
				$loop = get_field('loop', $slider_id);
				$image_caption = get_field('image_caption', $slider_id);
				$image_caption_title = get_field('image_caption_title', $slider_id);
				$image_caption_description = get_field('image_caption_description', $slider_id);
				$image_caption_link = get_field('image_caption_link', $slider_id);
				$autohight = get_field('autohight', $slider_id);
				$urlhashlistener = get_field('urlhashlistener', $slider_id);
				$nav = get_field('nav', $slider_id);
				$slideby = get_field('slideby', $slider_id);
				$slidetransition = get_field('slidetransition', $slider_id);
				$dots = get_field('dots', $slider_id);
				$lazyload = get_field('lazyload', $slider_id);
				$autoplay = get_field('autoplay', $slider_id);
				$autoplaytimeout = get_field('autoplaytimeout', $slider_id);
				$autoplayhoverpause = get_field('autoplayhoverpause', $slider_id);
				$smartspeed = get_field('smartspeed', $slider_id);
				$autoplayspeed = get_field('autoplayspeed', $slider_id);
				$navspeed = get_field('navspeed', $slider_id);
				$dotsspeed = get_field('dotsspeed', $slider_id);
				$animation = get_field('animation', $slider_id);

				/*

				items
				margin
				loop
				center
				mouseDrag
				touchDrag
				pullDrag
				freeDrag
				stagePadding
				merge
				mergeFit
				autoWidth
				startPosition
				URLhashListener
				nav
				rewind
				navText
				navElement
				slideBy
				slideTransition
				dots
				dotsEach
				dotsData
				lazyLoad
				lazyLoadEager
				autoplay
				autoplayTimeout
				autoplayHoverPause
				smartSpeed
				fluidSpeed
				autoplaySpeed
				navSpeed
				dotsSpeed
				dragEndSpeed
				callbacks
				responsive
				responsiveRefreshRate
				responsiveBaseElement
				video
				videoHeight
				videoWidth
				animateOut
				animateIn
				fallbackEasing
				info
				nestedItemSelector
				itemElement
				stageElement
				navContainer
				dotsContainer
				checkVisible



				data-items
				data-margin
				data-loop
				data-center
				data-mouse-drag
				data-pull-drag
				data-free-drag
				data-stage-padding
				data-merge
				data-merge-fit
				data-auto-width
				data-auto-hight
				data-start-position
				data-nav
				data-rewind
				data-nav-text
				data-nav-element
				data-slide-by
				data-slide-transition
				data-dots
				data-dots-each
				data-dots-
				data
				data-lazy-load
				data-lazy-load-eager
				data-autoplay
				data-autoplay-timeout
				data-autoplay-hover-pause
				data-smart-speed
				data-autoplay-speed
				data-nav-speed
				data-dots-speed
				data-drag-end-speed
				data-callbacks
				data-video
				data-video-height
				data-video-width
				data-animate-out
				data-animate-in
				data-fallback-easing
				data-item-element
				data-stage-element
				data-nav-container
				data-dots-container
				data-check-visible
				*/

				$settings = array();
				$settings['items'] = $items;
				$settings['theme'] = $theme;
				$settings['margin'] = $margin;
				$settings['loop'] = $loop;
				$settings['image_caption'] = $image_caption;
				$settings['image_caption_title'] = $image_caption_title;
				$settings['image_caption_description'] = $image_caption_description;
				$settings['image_caption_link'] = $image_caption_link;
				$settings['autohight'] = $autohight;
				$settings['urlhashlistener'] = $urlhashlistener;
				$settings['nav'] = $nav;
				$settings['slideby'] = $slideby;
				$settings['slidetransition'] = $slidetransition;
				$settings['dots'] = $dots;
				$settings['lazy-load'] = $lazyload;
				$settings['autoplay'] = $autoplay;
				$settings['autoplaytimeout'] = $autoplaytimeout;
				$settings['autoplayhoverpause'] = $autoplayhoverpause;
				$settings['smart-speed'] = $smartspeed;
				$settings['autoplay-speed'] = $autoplayspeed;
				$settings['nav-speed'] = $navspeed;
				$settings['dots-speed'] = $dotsspeed;
				$settings['animation'] = $animation;
				$settings['navText'] = "[]";
				$skip_settings   = array(
					'theme',
					'caption',
					'caption_title',
					'caption_description',
					'caption_link',
					'URLhashListener',
				);
				$slider_classes = array('slider','owl-carousel');
				$slider_data = array();

				if(is_array($settings)){
					foreach($settings as $setting_key => $setting_value){
						if(in_array($setting_key, $skip_settings)){
							continue;
						}						
						$setting_key = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $setting_key));
						$slider_data[] = 'data-'.$setting_key.'="'.$setting_value.'" ';
					}
				}

				$slider_classes[] = $settings['theme'];
				$slider_classes = implode(" ",$slider_classes);
				$slider_data = implode(" ",$slider_data);


				if($slider_type == "image"){
					$slides = get_field('aione_slider_images', $slider_id);
					if(!empty($slides)):
						$output .=  '<div id="aione_slider_'.$atts['id'].'" class="'.$slider_classes.'" '.$slider_data.'>';
						foreach ($slides as $key => $slide) { //echo "<pre>";print_r($slide);echo "</pre>";
							$output .= '<div class="slider-item">';
							$output .= '<div class="slider-image">';
							$output .= '<img src="'.$slide['url'].'" alt="'.$slide['alt'].'" />';
							$output .= '</div>';
							if($settings['image_caption']){
								$output .= '<div class="slider-caption">';
								if($settings['image_caption_title']){
									$output .= '<h3 class="caption-title">'.$slide['caption'].'</h3>';
								}
								if($settings['image_caption_description']){
									$output .= '<p class="caption-description">'.$slide['description'].'</p>';
								}
								$output .= '</div>';
							}
							$output .= '</div>';
						}
						$output .= '</div>';
					endif;
				}
				if($slider_type == "post"){
					$slider_post_type = get_field('aione_slider_post_type', $slider_id);
					if($slider_post_type == ""){
						$slider_post_type = "post";
					}					
					$slider_post_category = get_field('aione_slider_post_category', $slider_id);
					//echo "<pre>";print_r($slider_post_category);echo "</pre>";	
					$number_of_posts = get_field('aione_number_of_posts', $slider_id);	
					$args = array(
				      		'showposts' => $number_of_posts, //add -1 if you want to show all posts
				      		'post_type' => $slider_post_type,
				      		'tax_query' => array(
				                array(
				                    'taxonomy' => 'category',
				                    'field' => 'id',
				                    'terms' => $slider_post_category //pass your term name here
				                )
				            )
				      	);				
					$slides = get_posts( $args );
					//echo "<pre>";print_r($slides);echo "</pre>";
					if($slides){
						$output .=  '<div id="aione_slider_'.$atts['id'].'" class="'.$slider_classes.'" '.$slider_data.'>';
						foreach ($slides as $key => $slide) {
							$output .= '<div class="slider-item">';
							$output .= '<div class="slider-image">';
							$output .= '<h3 class="title">'.$slide->post_title.'</h3>';
							$output .= '<p class="description">'.$slide->post_content.'</p>';
							$output .= '</div>';
							$output .= '</div>';
						}
						$output .= '</div>';
					}
				}
				if($slider_type == "text"){ 
					$slides = get_field('aione_slider_slides', $slider_id);					
					if(!empty($slides)):
						$output .=  '<div id="aione_slider_'.$atts['id'].'" class="'.$slider_classes.'" '.$slider_data.'>';
						foreach ($slides as $key => $slide) {
							$output .= '<div class="slider-item">';
							$output .= '<div class="slider-image">';
							$output .= '<h3 class="title">'.$slide['slide_title'].'</h3>';
							$output .= '<p class="description">'.$slide['slide_content'].'</p>';
							$output .= '</div>';
							$output .= '</div>';
						}
						$output .= '</div>';
					endif;
				}	
				
				$output .='<div class="aione-clear"></div>';		
			} else {
				$output .= '<div class="aione-message warning">Invalid Slider</div>';
			}
		} else {
			$output .= '<div class="aione-message warning">Invalid Slider</div>';
		}
		return $output;
	}

}
