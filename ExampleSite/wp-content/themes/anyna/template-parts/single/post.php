<?php
namespace anyna;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
the_title( '<h2 class="entry-title">', '</h2>' );
?>
<div class="time">
<?php the_time('F j, Y'); ?>
</div>
<div class="content">
<?php if( has_post_thumbnail() ){ ?>
    <div class="thumbnail">
    <?php the_post_thumbnail(); ?>
    </div>
<?php
}
the_content();
?>
<div class="clear-both"></div>
</div>
<hr style="width:50%;text-align:center;margin:40px auto">
<?php
wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( '<span class="name">Pages:</span>', 'anyna' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
?>
<div class="tags"><?php the_tags(); ?></div>
<div class="author">
<?php the_author(); ?>
</div>
</article>