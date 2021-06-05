<?php
namespace anyna;

function register_menus(){
    \register_nav_menus( array( 'top' => 'Top' ) );
}
add_action( 'init', __NAMESPACE__.'\register_menus' );
?>