<?php
namespace anyna;

?>
<div class="header">
	<div class="bloginfo">
		<div class="title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( "name" ); ?></a></span></div>
		<div class="description"><span><?php bloginfo( "description" ); ?><span></div>
	</div>
	<div class="nav">
		<div class="items">
			<?php wp_nav_menu( array( 
				'menu' => 'primary',
				'theme_location' => 'top'
			) );?>
		</div>
		<div class="search-form-wrapper test-search-form">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>