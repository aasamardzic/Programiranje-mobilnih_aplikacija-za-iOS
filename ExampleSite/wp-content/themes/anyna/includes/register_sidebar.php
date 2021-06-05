<?php
namespace anyna;

function register_sidebar( $args ){
    $args = wp_parse_args( $args , array(
        'name'          => '',
        'id'            => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    \register_sidebar( $args );
}
function register_sidebars( $sidebars ){
    if( is_array( $sidebars ) )
        foreach( $sidebars as $sidebar ){
            register_sidebar( $sidebar );
        }
}
function sidebar_init(){
    register_sidebars( array(
        array( 'name' => 'Main Left' , 'id' => 'main-left' ),
        array( 'name' => 'Main Right' , 'id' => 'main-right' ),
        array( 'name' => 'Footer 1' , 'id' => 'footer-1' ),
        array( 'name' => 'Footer 2-1' , 'id' => 'footer-2-1' ),
        array( 'name' => 'Footer 2-2' , 'id' => 'footer-2-2' ),
        array( 'name' => 'Footer 2-3' , 'id' => 'footer-2-3' ),
        array( 'name' => 'Footer 2-4' , 'id' => 'footer-2-4' ),
        array( 'name' => 'Footer 3' , 'id' => 'footer-3' )
    ) );
}
\add_action( 'widgets_init', __NAMESPACE__.'\sidebar_init' );
?>