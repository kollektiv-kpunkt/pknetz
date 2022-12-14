<?php
get_header( );
?>

<?php
if ($post->post_parent != 0) {
    $siblings = get_pages( array( 'child_of' => $post->post_parent, 'parent' => $post->post_parent, 'sort_column' => 'menu_order' ));
} else {
    $siblings = array();
}
$children = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order' ) );

if (count($siblings) != 0) {
    get_template_part( "template-parts/elements/children-nav", null, array( "children" => $siblings ));
} else if (count($children) != 0) {
    get_template_part( "template-parts/elements/children-nav", null, array( "children" => $children ));
}

?>

<?php
if ( has_post_thumbnail( ) ) :
        get_template_part( "template-parts/elements/page-heroine-with-image");
    else :
        get_template_part( "template-parts/elements/page-heroine");
endif;
?>


<div class="pkn-breadcrumbs-wrapper my-8">
    <div class="pkn-breadcrumbs-inner md-container text-xs">
        <?php
        the_breadcrumb();
        ?>
    </div>
</div>

<div class="md-container">
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