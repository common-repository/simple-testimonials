<?php
/*
	Plugin Name: Simple Testimonials
	Plugin URI: http://www.pixelovely.com/resources/simple-testimonials-wordpress-plugin/
	Description: Easily manage testimonials and display them anywhere on your blog in seconds, via widgets and shortcodes. Instructions are baked right in -- couldn't be simpler!
	Author: PIXELovely
	Version: 1.0.7
	Author URI: http://www.PIXELovely.com/
	Text Domain: pixelovely-simple-testimonials
 */

/*  Copyright 2013  Kimberly Genly (email : kim@pixelovely.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

	You may find a copy of the GNU General Public License at http://www.gnu.org/licenses/gpl.html
*/


add_action( 'wp_enqueue_scripts', 'simple_testimonials_stylesheet' );

function simple_testimonials_stylesheet() {
    wp_register_style( 'testimonial-style', plugins_url('css/style.css', __FILE__) );
    wp_enqueue_style( 'testimonial-style' );
}

function simple_testimonials_create_post_type() {
  $post_type = simple_testimonials_get_post_type_name();
	register_post_type( $post_type,
		array(
			'labels' => array(
				'name' => __( 'Testimonials', 'pixelovely-simple-testimonials' ),
				'singular_name' => __( 'Testimonial', 'pixelovely-simple-testimonials' ),
				'all_items' => __( 'All Testimonials', 'pixelovely-simple-testimonials' )
			),
		'public' => false,
		'show_ui' => true,
		'show_in_menu'=>true,
		'has_archive' => false,
		'supports' => array(''),
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-testimonial'
		)
	);


	$catlabels = array(
			'name'              => _x( 'Testimonial Categories', 'taxonomy general name', 'pixelovely-simple-testimonials' ),
			'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'pixelovely-simple-testimonials' ),
			'search_items'      => __( 'Search Testimonial Categories', 'pixelovely-simple-testimonials' ),
			'all_items'         => __( 'All Testimonial Categories', 'pixelovely-simple-testimonials' ),
			'parent_item'       => __( 'Parent Category', 'pixelovely-simple-testimonials' ),
			'parent_item_colon' => __( 'Parent Category:', 'pixelovely-simple-testimonials' ),
			'edit_item'         => __( 'Edit Category', 'pixelovely-simple-testimonials' ),
			'update_item'       => __( 'Update Category', 'pixelovely-simple-testimonials' ),
			'add_new_item'      => __( 'Add New Category', 'pixelovely-simple-testimonials' ),
			'new_item_name'     => __( 'New Category Name', 'pixelovely-simple-testimonials' ),
			'menu_name'         => __( 'Testimonial Categories', 'pixelovely-simple-testimonials' ),
	);

	$catargs = array(
			'hierarchical'      => true,
			'labels'            => $catlabels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'testimonial-categories' ),
	);

	register_taxonomy( 'testimonialcategory', array( $post_type ), $catargs );
}
add_action( 'init', 'simple_testimonials_create_post_type' );



/* Special inputs for post type */
add_action('edit_form_after_title', 'simple_testimonials_add_special_simple_testimonials_page_editor');

$PIXELovely_simpletestimonials_inputs = array(
	array(
		"type"=>"textarea",
		"name"=>__( 'Testimonial', 'pixelovely-simple-testimonials' ),
		"optionname"=>"_quote"
	),
	array(
		"type"=>"text",
		"name"=>__( 'Attribution', 'pixelovely-simple-testimonials' ),
		"optionname"=>"post_title"
	)
);

function simple_testimonials_add_special_simple_testimonials_page_editor() {
	global $post;

	//Get the appropriate set of inputs for the post type
	if ( get_post_type($post->ID) == simple_testimonials_get_post_type_name()) {
		global $PIXELovely_simpletestimonials_inputs;
		$loopthrough = $PIXELovely_simpletestimonials_inputs;
	}

	if (isset($loopthrough) && is_array($loopthrough)) {

	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="pix_simple_testimonial_pagemeta_noncename" id="pix_simple_testimonial_pagemeta_noncename" value="' .
			wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	// Get the meta data if its already been entered

	$i = 0;

	?>

	<?php
	echo "<table style='width: 100%;'>";
	foreach ($loopthrough as $option) {
		$currentValue = get_post_meta ($post->ID, $option['optionname'], true);
		echo "<tr>";

			echo "<td style='width: 10%; vertical-align: top; font-weight: bold; text-align: right; padding-right: 10px;'>";
			echo "<label for='".esc_attr($option['optionname'])."'>".esc_html($option['name'])."</label>";
			echo "</td><td style='width: 90%'>";


		switch ($option['type']) {
			case "instructions":
				echo "<p>".esc_html($option['name'])."</p>";
				break;
			case "text":
				echo "<input type='text' name='".esc_attr($option['optionname'])."' id='".esc_attr($option['optionname'])."' value='".esc_textarea($currentValue, ENT_QUOTES)."'>";
				break;
			case "textarea":
				echo "<textarea name='".esc_attr($option['optionname'])."' id='".esc_attr($option['optionname'])."' style='width: 95%; height: 150px;'>".esc_textarea($currentValue)."</textarea>";
				break;
			case "checkbox":
				 	echo "<input type='checkbox' name='".esc_attr($option['optionname'])."' id='".esc_attr($option['optionname'])."' value='1'";
				 	if ($currentValue == 1) {
				 		echo " checked";
				 	}
				 	echo "></p>";
				break;
		}
		if (isset($option['description']) && $option['description'] != "") {
						echo "<p style='clear: both; font-size: .9em; font-style: italic; margin: 0px;'>".esc_html($option['description'])."</p>";
					}
		echo "<br />";
		echo "</td></tr>";
		$i++;
	}
	echo "</table>";
	?>

	<div style='clear: left'></div>


<?php
	}
}

function simple_testimonials_get_post_type_name() {
  $post_type ='testimonials';

  return $post_type;
}

function simple_testimonials_save_testimonial_info($post_id, $post) {

	//Get the appropriate set of inputs for the post type
	if ( get_post_type($post->ID) == simple_testimonials_get_post_type_name()) {
		global $PIXELovely_simpletestimonials_inputs;
		$loopthrough = $PIXELovely_simpletestimonials_inputs;
	}

	if (isset($loopthrough) && is_array($loopthrough)) {

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['pix_simple_testimonial_pagemeta_noncename'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
	return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.


	foreach ($loopthrough as $option) {
		$currentValue = trim(stripslashes( $_POST[$option['optionname']]));
		switch ($option['type']) {
			case "text":
				$portfolio_meta[$option['optionname']] = sanitize_text_field($currentValue);
				break;
			case "textarea":
				$portfolio_meta[$option['optionname']] = sanitize_textarea_field($currentValue);
				break;
			case "checkbox":
				if ($currentValue != 1) {
					$currentValue =0;
				}
				$portfolio_meta[$option['optionname']] = $currentValue;
				break;
		}
	}

	// Add values of $events_meta as custom fields

	foreach ($portfolio_meta as $key => $value) { // Cycle through the $portfolio_meta array!
	if( $post->post_type == 'revision' ) return; // Don't store custom data twice
	$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
	if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
	update_post_meta($post->ID, $key, $value);
	} else { // If the custom field doesn't have a value
	add_post_meta($post->ID, $key, $value);
	}
	if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}
	}
}

add_action('save_post', 'simple_testimonials_save_testimonial_info', 1, 2); // save the custom fields



function simple_testimonials_create_html($numberOfQuotes = 1, $limit = "0", $category = null) {
	if ($numberOfQuotes == 0) {
		$numberOfQuotes = -1;
	}

	$args = array( 'numberposts' => $numberOfQuotes, 'orderby' => 'rand', 'post_type' =>simple_testimonials_get_post_type_name());

	if (is_array($category)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonialcategory',
				'field' => 'name',
				'terms' => $category
			)
		);
	}

	$rand_posts = get_posts( $args );

	$testimonials = "";
	foreach ($rand_posts as $post ) {
		setup_postdata($post);

		if ($limit == 0) {
			$quote = nl2br(get_post_meta($post->ID, '_quote', true));
		} else {
			$quote = nl2br(substr(get_post_meta($post->ID, '_quote', true), 0, $limit));
		}

		if (strlen($quote) < strlen(nl2br(get_post_meta($post->ID, '_quote', true)))) {
			$quote .= "...";
		}

		$testimonials .= "<div class='pixelovely_testimonial'><p>$quote</p>";
		$attribution = trim(get_post_meta($post->ID, 'post_title', true));
		if (!empty($attribution)) {
			$testimonials .= "<span class='pixelovely_testimonial_attribution'>- $attribution</span>";
		}

		$testimonials .= "</div>";
	}
	return $testimonials;
}

function simple_testimonials_display_random_testimonial($numberOfQuotes = 1, $limit = "0", $category = null) {
	echo simple_testimonials_create_html($numberOfQuotes, $limit, $category);
}


class PIXELovely_Testimonials_Widget extends WP_Widget {

	public function __construct() {
		// widget actual processes
		parent::__construct(
				'pix_testimonials_widget', // Base ID
				'Testimonial', // Name
				array( 'description' => __( 'Display one or more random testimonials', 'pixelovely-simple-testimonials' ), ) // Args
		);
	}

	public function form( $instance ) {
		// outputs the options form on admin
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( '', 'pixelovely-simple-testimonials' );
		}
		if ( isset( $instance[ 'num_display' ] ) ) {
			$num_display = $instance[ 'num_display' ];
		}
		else {
			$num_display = __( '', 'pixelovely-simple-testimonials' );
		}

		if (isset($instance['length'])) {
			$length = $instance['length'];
		} else {
			$length = 0;
		}

		if (isset($instance['readmore'])) {
			$readmore = $instance['readmore'];
		} else {
			$readmore = "";
		}

		if (isset($instance['category'])) {
			$category = $instance['category'];
		} else {
			$category = "";
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'num_display' ); ?>"><?php _e( 'Number to display:' ); ?></label>
			<select id="<?php echo $this->get_field_id('num_display'); ?>" name="<?php echo $this->get_field_name('num_display'); ?>" class="widefat" style="width:100%;">
    		<?php
    			$i = 0;
    			while ($i < 10) { ?>
       	 		<option <?php selected( $i, $num_display ); if (!simple_testimonials_check_valid_number($num_display) && $i ==1) {echo "selected";} ?> value="<?php echo $i; ?>"><?php if ($i == 0) {echo "All";} else {echo $i;}; ?></option>

    		<?php
    			$i++;
    			} ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'length' ); ?>"><?php _e( 'Limit to this many characters:', 'pixelovely-simple-testimonials' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'length' ); ?>" name="<?php echo $this->get_field_name( 'length' ); ?>" type="text" value="<?php echo esc_attr( $length ); ?>" />
			Leave blank or use zero for no limit.
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Choose testimonials from this category:', 'pixelovely-simple-testimonials' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
				<option value="">Any</option>
				<?php
				$args = array(
						'type'                     => simple_testimonials_get_post_type_name(),
						'taxonomy'                 => 'testimonialcategory'
				);

				foreach (get_categories($args) as $cat) :
				echo "<option value='".$cat->name."'";
				if ($category == $cat->name) {
					echo " selected";
				}
				echo ">".$cat->name."</option>";
				endforeach;
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'Optionally, add a "read more" link:', 'pixelovely-simple-testimonials' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" type="text" value="<?php echo esc_attr( $readmore ); ?>" />
			<?php _e( 'Entering a URL in this field will create a "read more" link. Typically, it will go to your page of all your testimonials.', 'pixelovely-simple-testimonials' ); ?>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_display'] = strip_tags( $new_instance['num_display'] );
		$instance['length'] = strip_tags( $new_instance['length'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		if (is_numeric($instance['length'])) {
			$instance['length'] = intval($instance['length']);
		} else {
			$instance['length'] = 0;
		}
		$instance['readmore'] = strip_tags( $new_instance['readmore'] );

		return $instance;
	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$num_display = apply_filters( 'widget_title', $instance['num_display'] );

		if (isset($instance['length'])) {
			$length = $instance['length'];
		} else {
			$length = 0;
		}

		if (isset($instance['readmore'])) {
			$readmore = $instance['readmore'];
		} else {
			$readmore = "";
		}

			if (isset($instance['category']) && strlen($instance['category']) > 0) {
			$category = explode(",",$instance['category']);
		} else {
			$category = "";
		}

		if (!simple_testimonials_check_valid_number($num_display)) {
			$num_display = 1;
		}
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

			//Output all special widget stuff here
			simple_testimonials_display_random_testimonial($num_display, $length, $category);

			if (strlen($readmore) > 2) {
				echo "<span class='readmore'><a href='$readmore'>".__( 'Read more', 'pixelovely-simple-testimonials' )."</a></span>";
			}

			echo $after_widget;

		}
}

function simple_testimonials_custom_testi_register() {
	register_widget( 'PIXELovely_Testimonials_Widget' );

}

function simple_testimonials_create_pixelovely_testimonial_shortcode($atts){
	extract( shortcode_atts( array(
		'number' => '1',
		'category' => null
	), $atts ) );

	if (!simple_testimonials_check_valid_number($number)) {
		$number = 1;
	}

	if (!isset($category)) {
		$category = null;
	} else {
		$category = explode(",", $category);
	}

	return simple_testimonials_create_html($number, 0, $category);
}

function simple_testimonials_check_valid_number($number) {

	if (trim($number) === "" || !is_numeric($number) || $number < 0) {
		return false;
	}
	return true;
}


add_action( 'widgets_init', 'simple_testimonials_custom_testi_register' );
add_shortcode('testimonial','simple_testimonials_create_pixelovely_testimonial_shortcode');


function simple_testimonials_pixelovely_simple_testimonials_init() {
	$plugin_dir = basename(dirname(__FILE__)). '/languages/';
	load_plugin_textdomain( 'pixelovely-simple-testimonials', false, $plugin_dir );
}
add_action('plugins_loaded', 'simple_testimonials_pixelovely_simple_testimonials_init');




function simple_testimonials_loadblocks() {
  wp_enqueue_script(
    'simple-testimonials',
    plugin_dir_url(__FILE__) . 'js/simpletestimonialblock.js',
    array('wp-blocks','wp-editor'),
    true
  );
}
add_action('enqueue_block_editor_assets', 'simple_testimonials_loadblocks');

function simple_testimonials_registerblocks() {
    register_block_type( 'simpletestimonials/testimonials', [
      'render_callback' => 'simple_testimonials_providers_block_dynamic_render_callback'
    ]
  );
}
add_action('init', 'simple_testimonials_registerblocks');

function simple_testimonials_providers_block_dynamic_render_callback($block_attributes, $content) {
  $numberOfQuotes = 1;

  if (isset($block_attributes['num_of_testimonials'])) {
    $numberOfQuotes = $block_attributes['num_of_testimonials'];
  }

  if (isset($block_attributes['show_all_testimonials']) && $block_attributes['show_all_testimonials']) {
    $numberOfQuotes = 0;
  }

  $category = null;
  if (isset($block_attributes['testimonial_categories'])) {
    $category = explode(',', $block_attributes['testimonial_categories'] );
  }

  return simple_testimonials_create_html($numberOfQuotes, 0, $category);
}
?>
