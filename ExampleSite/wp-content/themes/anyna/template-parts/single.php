<div id="primary" class="content-area single">
	<main class="site-main" role="main">
        <?php
        if( have_posts() ):
            while( have_posts() ):
                the_post();
                get_template_part("template-parts/single/post",get_post_format());
            endwhile;
        endif;
        ?>
    </main>
    <div class="comments-wrapper">
        <?php comments_template(); ?>
    </div>
</div>