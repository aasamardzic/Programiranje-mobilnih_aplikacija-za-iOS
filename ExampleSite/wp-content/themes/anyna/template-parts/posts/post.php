<div class="post-wrapper">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
?>
<div>
<a class="time" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_time('F j, Y'); ?></a>
</div>
<div class="excerpt">
<?php
    the_post_thumbnail();
    the_excerpt();
?>
</div>
<div class="clear-both"></div>
</article>
</div>