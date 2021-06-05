<?php if( !is_page() ){ ?>

</div>

<!-- /content -->

<?php get_sidebar( "left" ); ?>

<?php get_sidebar( "right" ); ?>

<div class="clear-both"></div>

</div>

<!-- /center -->

<?php get_template_part( "template-parts/main-parts/bottom" ); ?>

<?php } ?>

</div>

<!-- /main -->

</div>

<?php get_template_part( "template-parts/footer" ); ?>
<div class="mobile-mode"></div>
</div>

<!-- /site -->

<?php wp_footer(); ?>

</body>

</html>
