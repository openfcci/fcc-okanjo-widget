<?php
/*
Plugin Name: FCC Okanjo Widget
Plugin URI: https://github.com/openfcci/fcc-okanjo-widget
Description: Okanjo ad widget.
Author: Forum Communications Company
Version: 0.16.03.31
Author URI: http://forumcomm.com/
*/

class Okanjo_Widget extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'fcc_okanjo_widget',
			__( 'Okanjo', 'okanjo' ),
			array(
				'description' => __( 'Okanjo ad widget.', 'okanjo' ),
				'classname'   => 'widget_okanjo',
			)
		);

	}

	public function widget( $args, $instance ) {

		//$title = apply_filters( 'widget_title', empty( $instance['generatewp_title'] ) ? '' : $instance['generatewp_title'], $instance, $this->id_base );
		$datatake  = apply_filters( 'widget_okanjo',  empty( $instance['okanjo_datatake']  ) ? '' : $instance['okanjo_datatake'],  $instance );
		$ctacolor = apply_filters( 'widget_okanjo',  empty( $instance['okanjo_ctacolor']  ) ? '' : $instance['okanjo_ctacolor'],  $instance );
		$dataselectors = apply_filters( 'widget_okanjo',  empty( $instance['okanjo_dataselectors']  ) ? '' : $instance['okanjo_dataselectors'],  $instance );
		$datapools = apply_filters( 'widget_okanjo',  empty( $instance['okanjo_datapools']  ) ? '' : $instance['okanjo_datapools'],  $instance );
		$key = apply_filters( 'widget_okanjo',  empty( $instance['okanjo_key']  ) ? '' : $instance['okanjo_key'],  $instance );

		// Before widget tag
		echo $args['before_widget'];

		// Title
		/*if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}*/

		// Okanjo Code
		echo '<div class="product-widget-dropzone" data-mode="sense" data-take="' . $datatake . '" data-template-product-main="product.block2" data-template-cta-style="button" data-template-cta-color="' . $ctacolor . '" data-url="' . get_permalink( $post->ID ) . '"data-selectors="' . $dataselectors . '" data-pools="' . $datapools . '"></div>';
		echo '<script src="https://cdn.okanjo.com/js/latest/okanjo-bundle.min.js" crossorigin="anonymous"></script>';
		echo "<script>okanjo.key='" . $key . "'; var targets=okanjo.qwery('.product-widget-dropzone'), i=0, p=[]; for (; i < targets.length; i++){p.push(new okanjo.Product(targets[i]));}</script>";

		// After widget tag
		echo $args['after_widget'];

	}

	public function form( $instance ) {

		// Set default values
		$instance = wp_parse_args( (array) $instance, array(
			'okanjo_datatake' => '3',
			'okanjo_ctacolor' => '#0099ff',
			'okanjo_dataselectors' => 'h1.entry-title, div.entry-content p',
			'okanjo_datapools' => '',
			'okanjo_key' => '',
		) );

		// Retrieve an existing value from the database
		$okanjo_datatake = !empty( $instance['okanjo_datatake'] ) ? $instance['okanjo_datatake'] : '';
		$okanjo_ctacolor = !empty( $instance['okanjo_ctacolor'] ) ? $instance['okanjo_ctacolor'] : '';
		$okanjo_dataselectors = !empty( $instance['okanjo_dataselectors'] ) ? $instance['okanjo_dataselectors'] : '';
		$okanjo_datapools = !empty( $instance['okanjo_datapools'] ) ? $instance['okanjo_datapools'] : '';
		$okanjo_key = !empty( $instance['okanjo_key'] ) ? $instance['okanjo_key'] : '';

		// Form fields
		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'okanjo_datatake' ) . '" class="okanjo_datatake_label">' . __( 'Data Take', 'okanjo' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'okanjo_datatake' ) . '" name="' . $this->get_field_name( 'okanjo_datatake' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'okanjo' ) . '" value="' . esc_attr( $okanjo_datatake ) . '">';
		echo '	<span class="description">' . __( 'The number of products to render.', 'okanjo' ) . '</span>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'okanjo_ctacolor' ) . '" class="okanjo_ctacolor_label">' . __( 'CTA Color', 'okanjo' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'okanjo_ctacolor' ) . '" name="' . $this->get_field_name( 'okanjo_ctacolor' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'okanjo' ) . '" value="' . esc_attr( $okanjo_ctacolor ) . '">';
		echo '	<span class="description">' . __( 'The color of text and border/background of the CTA button or link.', 'okanjo' ) . '</span>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'okanjo_dataselectors' ) . '" class="okanjo_dataselectors_label">' . __( 'Data Selectors', 'okanjo' ) . '</label>';
		echo '	<textarea id="' . $this->get_field_id( 'okanjo_dataselectors' ) . '" name="' . $this->get_field_name( 'okanjo_dataselectors' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'okanjo' ) . '">' . $okanjo_dataselectors . '</textarea>';
		echo '	<span class="description">' . __( 'CSS element content selectors. Include the article title, article copy, keywords, tags, and any other relevant data.', 'okanjo' ) . '</span>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'okanjo_datapools' ) . '" class="okanjo_datapools_label">' . __( 'Data Pools', 'okanjo' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'okanjo_datapools' ) . '" name="' . $this->get_field_name( 'okanjo_datapools' ) . '" class="widefat" placeholder="' . esc_attr__( 'global', 'okanjo' ) . '" value="' . esc_attr( $okanjo_datapools ) . '">';
		echo '	<span class="description">' . __( 'Limit products to the given array of product pool names. (Accepts an array or CSV string.)', 'okanjo' ) . '</span>';
		echo '</p>';

		echo '<p>';
		echo '	<label for="' . $this->get_field_id( 'okanjo_key' ) . '" class="okanjo_key_label">' . __( 'Widget Key', 'okanjo' ) . '</label>';
		echo '	<input type="text" id="' . $this->get_field_id( 'okanjo_key' ) . '" name="' . $this->get_field_name( 'okanjo_key' ) . '" class="widefat" placeholder="' . esc_attr__( 'AK18PpKGrMUO8Mp3wj5eYWQwTL6pyBbfj', 'okanjo' ) . '" value="' . esc_attr( $okanjo_key ) . '">';
		echo '	<span class="description">' . __( 'Okanjo API widget key.', 'okanjo' ) . '</span>';
		echo '</p>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['okanjo_datatake'] = !empty( $new_instance['okanjo_datatake'] ) ? strip_tags( $new_instance['okanjo_datatake'] ) : '';
		$instance['okanjo_ctacolor'] = !empty( $new_instance['okanjo_ctacolor'] ) ? strip_tags( $new_instance['okanjo_ctacolor'] ) : '';
		$instance['okanjo_dataselectors'] = !empty( $new_instance['okanjo_dataselectors'] ) ? strip_tags( $new_instance['okanjo_dataselectors'] ) : '';
		$instance['okanjo_datapools'] = !empty( $new_instance['okanjo_datapools'] ) ? strip_tags( $new_instance['okanjo_datapools'] ) : '';
		$instance['okanjo_key'] = !empty( $new_instance['okanjo_key'] ) ? strip_tags( $new_instance['okanjo_key'] ) : '';

		return $instance;

	}

}

function okanjo_register_widgets() {
	register_widget( 'Okanjo_Widget' );
}
add_action( 'widgets_init', 'okanjo_register_widgets' );
