<?php
namespace anyna;

class Colors{
    static public function ColorToArray( $rgb ){
        $_rgb;
        if( gettype( $rgb ) == 'string' ){
            $rgb = str_replace( '/\s/' , '' , $rgb );
            if( strpos( $rgb , '#' ) === 0 ){
                $c1 = intval( substr( $rgb , 1 , 2 ) , 16 );
                $c2 = intval( substr( $rgb , 3 , 2 ) , 16 );
                $c3 = intval( substr( $rgb , 5 , 2 ) , 16 );
                $_rgb = array( $c1 , $c2 , $c3 );
            }
            else
                $_rgb = explode( ',' , preg_replace( '/rgba|rgb|\(|\)/' , '' , $rgb ) );
        }
        if( !isset( $_rgb ) ) return false;
        if( !is_array( $_rgb ) ) return false;
        for( $i = 0 ; $i < count( $_rgb ) ; $i++ ){
            if( $i == 3 ){
                $v = floatval( $_rgb[3] );
                if( $_rgb[3] == '' )
                    $_rgb[3] = 1;
                else{
                    $v = $v < 0 ? 0 : $v;
                    $v = $v > 1 ? 1 : $v;
                    $_rgb[3] = $v;
                }
            }
            else{
                $v = intval( $_rgb[$i] );
                $v = $v < 0 ? 0 : $v;
                $v = $v > 255 ? 255 : $v;
                $_rgb[$i] = $v;
            }
        }
        return $_rgb;
    }
    static private function _getColor( $color_1 , $color_2 , $offset = 0 ){
        $_color_1 = self::ColorToArray( $color_1 );
        $_color_2 = self::ColorToArray( $color_2 );
        if( !is_array( $_color_1 ) || !is_array( $_color_2 ) ) return '';
        $_color_r = array();
        $offset = floatval( $offset );
        $offset = $offset == null ? 0 : $offset;
        $offset = $offset > 100 ? 100 : $offset;
        $offset = $offset < -100 ? -100 : $offset;
        for( $i = 0 ; $i < 3 ; $i++ ){
            $_color_r[$i] = $_color_1[$i] + floor( abs( $_color_1[$i] - $_color_2[$i] )*$offset/100 );
            $_color_r[$i] = intval( $_color_r[$i] );
        }
        $color_r = $_color_r[0] . ',' . $_color_r[1] . ',' . $_color_r[2];
        if( isset( $_color_1[3] ) ){
            if( $_color_1[3] >= 0 && $_color_1[3] <= 1 )
                $color_r = 'rgba(' . $color_r . ',' . $_color_1[3] . ')';
        }
        else
            $color_r = 'rgb(' . $color_r . ')';
        return $color_r;
    }
    static public function get( $color , $offset = 0 ){
        if( $offset >= 0 )
            return self::_getColor( $color , 'rgb(255,255,255)' ,$offset );
        else
            return self::_getColor( $color , 'rgb(0,0,0)' , $offset );
    }
}
class Style{
    static public function create( $selector = ':root' ){
        $color_1 = get_theme_mod( "color_1" , "#006ea5" );
        $margin_1 = get_theme_mod( "margin_1" , "20" );
        $margin_2 = get_theme_mod( "margin_2" , "20" );
        $sidebar_left_width = get_theme_mod( "sidebar-left_width" , "250" );
        $sidebar_right_width = get_theme_mod( "sidebar-right_width" , "250" );
        $offsets = array(-67,-50,-43,-35,-20,0,40,55,70,90);
        $str = "";
        $str .= "--color-base: " . $color_1 . ";\n";
        for( $i = 0 ; $i < count( $offsets ) ; $i++ ){
            $str .= "--color-".$i.": " . Colors::get( $color_1 , $offsets[$i] ) . ";\n";
        }
        $str = $selector."{\n" . $str . "}\n";

        $str .= ".site{\nmargin: " . $margin_1 . "px " . $margin_2 . "px;\n}\n";

        $str .= "#center.has-left-sidebar{\n padding-left: " . $sidebar_left_width . "px;\n}\n";
        $str .= "[sidebar=main-left]{\n";
        $str .= "width: " . $sidebar_left_width . "px;\n";
        $str .= "margin-left: -" . $sidebar_left_width . "px;\n}\n";

        $str .= "#center.has-right-sidebar{\n padding-right: " . $sidebar_right_width . "px;\n}\n";
        $str .= "[sidebar=main-right]{\n";
        $str .= "width: " . $sidebar_right_width . "px;\n";
        $str .= "margin-right: -" . $sidebar_right_width . "px;\n}\n";
        return $str;
    }
    static public function echo(){
        echo "<style>\n".self::create()."</style>";
    }
}
add_action( 'wp_head' , __NAMESPACE__.'\Style::echo' );
?>