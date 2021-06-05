<div id="primary" class="content-area page">
	<main class="site-main" role="main">
        <?php
        if( have_posts() ):
            while( have_posts() ):
                the_post();
                get_template_part("template-parts/single/post-page");
            endwhile;
        endif;
        ?>
    </main>
</div>