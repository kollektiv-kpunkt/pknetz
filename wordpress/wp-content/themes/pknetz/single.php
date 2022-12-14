<?php
get_header( );
?>

<?php
if ( has_post_thumbnail( ) ) :
        get_template_part( "template-parts/elements/page-heroine-with-image");
    else :
        get_template_part( "template-parts/elements/page-heroine");
endif;
?>

<div class="md-container mt-12">
    <div class="pkn-page-wrapper">
        <?php
        the_content();
        ?>
    </div>
</div>

<div class="pkn-footer-spacer h-28"></div>

<?php
get_footer( );
?>