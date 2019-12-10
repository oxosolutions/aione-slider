<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://oxosolutions.com
 * @since      1.0.0
 *
 * @package    Aione_Slider
 * @subpackage Aione_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aione_Slider
 * @subpackage Aione_Slider/admin
 * @author     OXO Solution® <contact@oxosolutions.com>
 */
class Aione_Slider_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'init', array( $this, 'register_aione_slider' ));
		add_action( 'init',array( $this, 'register_aione_slider_settings' ), 10 );

		if(!class_exists('acf')){ 
			add_action( 'admin_notices', array( $this, 'aione_acf_admin_notice' ));
		} 
		if(!class_exists('acf_plugin_gallery')){
			add_action( 'admin_notices', array( $this,'aione_gallery_admin_notice' ));
		}

	}

	/**
	 * Register the stylesheets for the admin area.
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

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/aione-slider-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/aione-slider-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function aione_acf_admin_notice() {
		?>
		<div class="notice error my-acf-notice is-dismissible" >
			<p><?php _e( 'ACF Plugin is necessary for slider to work properly, install it now! <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">Click Here!</a>', 'aione' ); ?></p>
		</div>
		<?php
	}

	public function aione_gallery_admin_notice() {
		?>
		<div class="notice error my-acf-notice is-dismissible" >
			<p><?php _e( 'ACF Gallery AddOn is necessary for slider to work properly, install it now! <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">Click Here!</a>', 'aione' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Register Aione slider.
	 *
	 * @since    1.0.0
	 */
	public function register_aione_slider(){ 	
		register_post_type( 'aione-slider',
			array(
			   	'labels'             => array(
					'name'               => 'Sliders',
					'singular_name'      => 'Slider',
					'add_new'            => 'Add New',
					'add_new_item'       => 'Add New Slider',
					'edit'               => 'Edit',
					'edit_item'          => 'Edit Slider',
					'new_item'           => 'New Slider',
					'view'               => 'View',
					'view_item'          => 'View Slider',
					'search_items'       => 'Search Slider',
					'not_found'          => 'No Slider found',
					'not_found_in_trash' => 'No Slider found in Trash',
					'parent'             => ''
				),
				'public'              => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_menu'       => true,
				'rewrite'            => array( 'slug' => 'aione-slider' ),
				'menu_position'       => 15,
				'menu_icon'           => 'dashicons-laptop',				
				'capability_type'     => 'slider',
				'capabilities'        => array(
					'publish_posts'       => 'publish_slider',
					'edit_posts'          => 'edit_slider',
					'edit_others_posts'   => 'edit_others_slider',
					'delete_posts'        => 'delete_slider',
					'delete_others_posts' => 'delete_others_slider',
					'read_private_posts'  => 'read_private_slider',
					'edit_post'           => 'edit_slider',
					'delete_post'         => 'delete_slider',
					'read_post'           => 'read_slider',

					'delete_private_posts' => 'delete_private_slider',
			        'delete_published_posts' => 'delete_published_slider',
			        'edit_private_posts' => 'edit_private_slider',
			        'edit_published_posts' => 'edit_published_slider',
				),
			    'supports'             => array( 'title'), 
				'taxonomies'           => array( '' ),
				'has_archive'          => true,
				'hierarchical'       => false,
				'register_meta_box_cb' => array( $this, 'aione_slider_metaboxes' ),
			)
		);
		$role = get_role('administrator');  
	    if($role){             
	        $role->add_cap( 'publish_slider' );
	        $role->add_cap( 'edit_slider' );
	        $role->add_cap( 'edit_others_slider' );
	        $role->add_cap( 'delete_slider' );
	        $role->add_cap( 'delete_others_slider' );
	        $role->add_cap( 'read_private_slider' );
	        $role->add_cap( 'edit_slider' );
	        $role->add_cap( 'delete_slider' );
	        $role->add_cap( 'read_slider' );

	        $role->add_cap( 'delete_private_slider' );
	        $role->add_cap( 'delete_published_slider' );
	        $role->add_cap( 'edit_private_slider' );
	        $role->add_cap( 'edit_published_slider' );
	    }			
	}

	/**
	* Add Meta Boxes to Aione Slider
	* 
	*/
	public function aione_slider_metaboxes(){
		add_meta_box(
			'aione_slider_docs',
			'Slider Shortcode',
			 array( $this, 'aione_slider_docs_callback' ),
			'aione-slider',
			'side',
			'default'
		);
	}

	public function aione_slider_docs_callback(){
		$id = get_the_ID();
		echo '[aione-slider id="'.esc_html($id).'"]';
	}

	/**
	 * Register Aione slider Settings.
	 *
	 * @since    1.0.0
	 */
	public function register_aione_slider_settings(){
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5bdd666b5d0fd',
				'title' => 'New Slider Settings',
				'fields' => array(
					array(
						'key' => 'field_5bdd688ade107',
						'label' => 'Slider Type',
						'name' => 'aione_slider_type',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'image' => 'Image Slider',
							'post' => 'Post Slider',
							'text' => 'Text Slider',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5bdd68d5de108',
						'label' => 'Slider Images',
						'name' => 'aione_slider_images',
						'type' => 'gallery',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_5bdd688ade107',
									'operator' => '==',
									'value' => 'image',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'min' => -1,
						'max' => '',
						'insert' => 'append',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_5bdd6919de109',
						'label' => 'Post Type',
						'name' => 'aione_slider_post_type',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_5bdd688ade107',
									'operator' => '==',
									'value' => 'post',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5bdd698ade10a',
						'label' => 'Post Category',
						'name' => 'aione_slider_post_category',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_5bdd688ade107',
									'operator' => '==',
									'value' => 'post',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'category',
						'field_type' => 'checkbox',
						'add_term' => 1,
						'save_terms' => 0,
						'load_terms' => 0,
						'return_format' => 'id',
						'multiple' => 0,
						'allow_null' => 0,
					),
					array(
						'key' => 'field_5bdd69bbde10b',
						'label' => 'Number of Posts',
						'name' => 'aione_number_of_posts',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_5bdd688ade107',
									'operator' => '==',
									'value' => 'post',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5bdd69d8de10c',
						'label' => 'Test Slides',
						'name' => 'aione_slider_slides',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_5bdd688ade107',
									'operator' => '==',
									'value' => 'text',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => '',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'button_label' => '',
						'sub_fields' => array(
							array(
								'key' => 'field_5bdd6a0862e1f',
								'label' => 'Slide Title',
								'name' => 'slide_title',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'field_5bdd6a1662e20',
								'label' => 'Slide Content',
								'name' => 'slide_content',
								'type' => 'textarea',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'rows' => '',
								'new_lines' => '',
							),
						),
					),
					array(
						'key' => 'field_5bdd751acd282',
						'label' => 'Items',
						'name' => 'items',
						'type' => 'number',
						'instructions' => 'The number of items you want to see on the screen.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 3,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5bdd75aacd283',
						'label' => 'Theme',
						'name' => 'theme',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'aione' => 'Aione',
							'darlic' => 'Darlic',
							'oxo' => 'OXO',
						),
						'default_value' => array(
							0 => 'darlic',
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5bdd7614cd284',
						'label' => 'Margin',
						'name' => 'margin',
						'type' => 'text',
						'instructions' => 'margin-right(px) on item.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5bdd7670cd286',
						'label' => 'Loop',
						'name' => 'loop',
						'type' => 'select',
						'instructions' => 'Infinity loop. Duplicate last and first items to get loop illusion.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'false' => 'False',
							'true' => 'True',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5bdd773d7452c',
						'label' => 'Image Caption',
						'name' => 'image_caption',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'on' => 'ON',
							'off' => 'OFF',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5bdd77f57452d',
						'label' => 'Image Caption Title',
						'name' => 'image_caption_title',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'on' => 'ON',
							'off' => 'OFF',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5bdd782f7452e',
						'label' => 'Image Caption Description',
						'name' => 'image_caption_description',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'on' => 'ON',
							'off' => 'OFF',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5bdd7992af4ca',
						'label' => 'Image Caption Link',
						'name' => 'image_caption_link',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'on' => 'ON',
							'off' => 'OFF',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5bdd7df79241f',
						'label' => 'autoHight',
						'name' => 'autohight',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'on' => 'ON',
							'off' => 'OFF',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5bdd7e8c92421',
						'label' => 'URLhashListener',
						'name' => 'urlhashlistener',
						'type' => 'select',
						'instructions' => 'Listen to url hash changes. data-hash on items is required.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'false' => 'False',
							'true' => 'True',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5bdd7f15ddbcc',
						'label' => 'Nav',
						'name' => 'nav',
						'type' => 'select',
						'instructions' => 'Show next/prev buttons.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5bdd800a60a61',
						'label' => 'slideBy',
						'name' => 'slideby',
						'type' => 'text',
						'instructions' => 'Navigation slide by x. "page" string can be set to slide by page.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 1,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5bdd8047e68a6',
						'label' => 'slideTransition',
						'name' => 'slidetransition',
						'type' => 'text',
						'instructions' => 'You can define the transition for the stage you want to use eg. linear.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5bdd8074e68a7',
						'label' => 'Dots',
						'name' => 'dots',
						'type' => 'select',
						'instructions' => 'Show dots navigation.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5bdd819c8f37c',
						'label' => 'lazyLoad',
						'name' => 'lazyload',
						'type' => 'select',
						'instructions' => 'Lazy load images. data-src and data-src-retina for highres. Also load images into background inline style if element is not',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5bdd820b8f37e',
						'label' => 'autoplay',
						'name' => 'autoplay',
						'type' => 'select',
						'instructions' => 'Autoplay',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5bdd82408f37f',
						'label' => 'autoplayTimeout',
						'name' => 'autoplaytimeout',
						'type' => 'number',
						'instructions' => 'Autoplay interval timeout.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 5000,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5bdd82748f380',
						'label' => 'autoplayHoverPause',
						'name' => 'autoplayhoverpause',
						'type' => 'select',
						'instructions' => 'Pause on mouse hover.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'true' => 'True',
							'false' => 'False',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_5bdd82c18f381',
						'label' => 'smartSpeed',
						'name' => 'smartspeed',
						'type' => 'number',
						'instructions' => 'Speed Calculate. More info to come..',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 250,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5bdd82eb8f382',
						'label' => 'autoplaySpeed',
						'name' => 'autoplayspeed',
						'type' => 'text',
						'instructions' => 'autoplay speed.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'false',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5bdd831d8f383',
						'label' => 'navSpeed',
						'name' => 'navspeed',
						'type' => 'text',
						'instructions' => 'Navigation speed.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'false',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5bdd83468f384',
						'label' => 'dotsSpeed',
						'name' => 'dotsspeed',
						'type' => 'text',
						'instructions' => 'Pagination speed.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'false',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5bdd847b8f38b',
						'label' => 'Animation',
						'name' => 'animate-out',
						'type' => 'text',
						'instructions' => 'Class for CSS3 animation out.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 'false',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_7fg2pom2bhasp',
						'label' => 'responsiveClass',
						'name' => 'responsive-class',
						'type' => 'select',
						'instructions' => 'Responsive slider',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'false' => 'False',
							'true' => 'True',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_9s72lleugm2r4',
						'label' => 'Responsive Mobile',
						'name' => 'responsive-mobile',
						'type' => 'number',
						'instructions' => 'Number of items in mobile',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_7fg2pom2bhasp',
									'operator' => '==',
									'value' => 'true',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 1,
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_f47shqzbeu8gx',
						'label' => 'Responsive Tablet',
						'name' => 'responsive-tablet',
						'type' => 'number',
						'instructions' => 'Number of items in tablet',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_7fg2pom2bhasp',
									'operator' => '==',
									'value' => 'true',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 2,
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_p86tiah7ylx70',
						'label' => 'Responsive Desktop',
						'name' => 'responsive-desktop',
						'type' => 'number',
						'instructions' => 'Number of items in desktop',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_7fg2pom2bhasp',
									'operator' => '==',
									'value' => 'true',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 4,
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'aione-slider',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

		endif;
	}

}
