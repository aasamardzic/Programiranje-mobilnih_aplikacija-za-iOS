<?php
namespace anyna\customize;

function register( $wp_customize ){
    $wp_customize->add_panel( '_site', array(
        'title' => __( 'Site' , 'anyna' ),
        'description' => '',
        'priority' => 10,
      ) );
$wp_customize->add_section( '_colors', array(
	  'title' => __( 'Colors' , 'anyna' ),
	  'description' => __( '' , 'anyna' ),
	  'panel' => '_site',
	  'priority' => 160,
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '',
	) );
	$wp_customize->add_section( '_margins', array(
		'title' => __( 'Margins' , 'anyna' ),
		'description' => __( '' , 'anyna' ),
		'panel' => '_site',
		'priority' => 160,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
	  ) );
	  $wp_customize->add_section( '_sidebars', array(
		'title' => __( 'Sidebars' , 'anyna' ),
		'description' => __( '' , 'anyna' ),
		'panel' => '_site',
		'priority' => 160,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
	  ) );
$wp_customize->add_setting( 'color_1' , array(
		'default'   => '#006ea5',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_setting( 'margin_1' , array(
		'default'   => '20',
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_setting( 'margin_2' , array(
		'default'   => '20',
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_setting( 'sidebar-left_width' , array(
		'default'   => '250',
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_setting( 'sidebar-right_width' , array(
		'default'   => '250',
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'margin_1', array(
		'type' => 'range',
		'priority' => 10,
		'section' => '_margins',
		'label' => __( 'Margin Top , Margin Bottom' , 'anyna' ),
		'description' => '',
		'input_attrs' => array(
		  'class' => '',
		  'style' => '',
		  'min' => '0',
		  'max' => '100',
		  'step' => '1'
		),
		'active_callback' => '',
	  ) );
	  $wp_customize->add_control( 'margin_2', array(
		'type' => 'range',
		'priority' => 10,
		'section' => '_margins',
		'label' => __( 'Margin Left , Margin Right' , 'anyna' ),
		'description' => '',
		'input_attrs' => array(
		  'class' => '',
		  'style' => '',
		  'min' => '0',
		  'max' => '100',
		  'step' => '1'
		),
		'active_callback' => '',
	  ) );
	  $wp_customize->add_control( 'sidebar-left_width', array(
		'type' => 'range',
		'priority' => 10,
		'section' => '_sidebars',
		'label' => __( 'Sidebar-left Width' , 'anyna' ),
		'description' => '',
		'input_attrs' => array(
		  'class' => '',
		  'style' => '',
		  'min' => '0',
		  'max' => '400',
		  'step' => '1'
		),
		'active_callback' => '',
	  ) );
	  $wp_customize->add_control( 'sidebar-right_width', array(
		'type' => 'range',
		'priority' => 10,
		'section' => '_sidebars',
		'label' => __( 'Sidebar-right Width' , 'anyna' ),
		'description' => '',
		'input_attrs' => array(
		  'class' => '',
		  'style' => '',
		  'min' => '0',
		  'max' => '400',
		  'step' => '1'
		),
		'active_callback' => '',
	  ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'color_1', array(
		'label' => __( 'Main Color', 'anyna' ),
		'section' => '_colors',
	  ) ) );
}
add_action( 'customize_register', __NAMESPACE__.'\register' );

?>
