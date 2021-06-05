<?php namespace anyna;
$n = is_active_sidebars( array( 'footer-2-1' , 'footer-2-2' , 'footer-2-3' , 'footer-2-4' ) );
$fn = is_active_sidebars( array( 'footer-1' , 'footer-3' ) ) + $n;
if( $fn > 0 ){
?>
<div class="footer">
<?php
sidebar_HTML( 'footer-1' );
if( $n > 0 ){
    $class = 'sidebars-'.$n;
?>
<div class="footer-2 <?php echo $class; ?>">
<?php
sidebar_HTML( 'footer-2-1' );
sidebar_HTML( 'footer-2-2' );
sidebar_HTML( 'footer-2-3' );
sidebar_HTML( 'footer-2-4' );
?>
<div class="clear-both"></div>
</div>
<?php
};
sidebar_HTML( 'footer-3' );
?>
</div>
<?php
}
?>