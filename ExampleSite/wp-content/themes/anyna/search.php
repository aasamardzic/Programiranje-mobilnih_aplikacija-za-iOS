<?php
namespace anyna;
get_header();
?>
<header class="page-header">
	<?php if ( have_posts() ) : ?>
		<h1 class="page-title">
		<?php
		/* translators: Search query. */
		printf( __( 'Search Results for: %s', 'anyna' ), '<span>' . get_search_query() . '</span>' );
		?>
		</h1>
	<?php else : ?>
		<h1 class="page-title"><?php _e( 'Nothing Found', 'anyna' ); ?></h1>
	<?php endif; ?>
</header><!-- .page-header -->
<?php get_template_part("template-parts/posts"); ?>
<?php if( !have_posts() ){ ?>
<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'anyna' ); ?></p>
	<?php
		get_search_form();
}
    ?>
<?php
get_footer();
?>