<div id="primary" class="content-area posts">
	<main class="site-main" role="main">
        <?php
        if( have_posts() ):
            while( have_posts() ):
                the_post();
                get_template_part("template-parts/posts/post",get_post_format());
            endwhile;
        endif;
        ?>
    </main>
    <?php
    the_posts_pagination(
					array(
						'prev_text'          => __( 'Previous page' , 'anyna' ),
						'next_text'          => __( 'Next page' , 'anyna' ),
						'before_page_number' => '',
					)
				);
    ?>
</div>