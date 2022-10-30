<?php
get_header();
?>

<?php
// do the wordpress loop
if ( have_posts() ) : while ( have_posts() ) : the_post();

// get the content
the_content();


endwhile; endif;
?>


<?php
get_footer();
?>