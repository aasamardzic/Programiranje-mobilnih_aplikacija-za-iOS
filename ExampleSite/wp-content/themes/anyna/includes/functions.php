<?php
namespace anyna;

function after_setup_theme(){
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => get_template_directory_uri() . '/assets/images/background.jpg',
    ) );
    add_theme_support( "post-thumbnails" );
    add_theme_support( 'automatic-feed-links' ); 
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\after_setup_theme' );

function add_theme_scripts(){
    wp_enqueue_style( name.'-style', get_stylesheet_uri() , false , version );
    wp_style_add_data( name.'-style', 'rtl', 'replace' );
    wp_enqueue_style( name.'-layout-style', get_template_directory_uri() . '/assets/css/layout-style.css' , false , version );
    
    wp_enqueue_script( name.'-script', get_template_directory_uri() . '/assets/js/frontend.js', null , version , true );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__.'\add_theme_scripts' );

function customize_preview_init(){
    wp_enqueue_script( name.'-preview_script', get_template_directory_uri() . '/assets/js/preview.js', null , version , true);
}
add_action( 'customize_preview_init', __NAMESPACE__.'\customize_preview_init' );

function sidebar_HTML( $id , $before = '' , $after = '' ){
    if( !is_string( $id ) ) return;
    if( !is_active_sidebar( $id ) ) return;
    printf( $before , $id );
    printf( '<div sidebar="%1$s" class="sidebar-%1$s"><div class="inner">' , $id );
    dynamic_sidebar( $id );
    printf( '</div></div>' );
    printf( $after , $id );
}

function is_active_sidebars( $ids = array() ){
    $n = 0;
    if( is_string( $ids ) )
        $ids = array( $ids );
    foreach( $ids as $id ){
        if( is_string( $id ) )
            if( is_active_sidebar( $id ) )
                $n++;
    }
    return $n;
}

function center_class(){
    $class = "";
    if( is_active_sidebar( 'main-left' ) )
        $class .= 'has-left-sidebar ';
    if( is_active_sidebar( 'main-right' ) )
        $class .= 'has-right-sidebar';
    echo $class;
}

function skip_link(){
    $id = is_page() ? "main" : "content";
    echo "<a class=\"skip-link\" href=\"#" . $id . "\"><span>" . __( "Skip to content" , "anyna" ) . "</span></a>";
}

?>