<?php
namespace anyna;
function _require( $paths ){
    if( is_array( $paths ) ){
        foreach( $paths as $path )
            if( is_string( $path ) )
                require get_template_directory() . '/' . 'includes/' . $path;
    }
    elseif( is_string() ){
        require get_template_directory() . '/' . 'includes/' . $path;
    }
}
_require( array(
    "backward_compatible.php",
    "functions.php",
    "register_sidebar.php",
    "register_menu.php",
    "customize/register.php",
    "customize/style.php"
) );
const path = __DIR__;
const name = 'anyna';
const version = '1.2.1';

if ( ! isset( $content_width ) ) $content_width = 800;

?>