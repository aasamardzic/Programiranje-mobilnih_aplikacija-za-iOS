<?php
get_header();
?>
<div>
<?php
the_archive_title( '<h1 class="page-title">' , '</h1>' );
?>
<?php get_template_part("template-parts/posts"); ?>
</div>
<?php
get_footer();
?>