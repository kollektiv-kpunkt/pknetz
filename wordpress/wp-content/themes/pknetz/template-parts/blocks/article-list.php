<?php

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

if (isset($_GET["terms"])) {
    $search_terms = (isset($_GET["terms"]) ? $_GET["terms"] : '');
} else {
    $search_terms = "";
}

$args = array(
    'post_type' => get_field("select_post_types"),
    'posts_per_page' => -1,
    'posts_per_page' => (isset($_GET["posts_per_page"]) ? $_GET["posts_per_page"] : 8),
    'post_status' => 'publish',
    'paged' => $paged,
    'orderby' => (isset($_GET["orderby"]) ? $_GET["orderby"] : ''),
    'order' => (isset($_GET["order"]) ? $_GET["order"] : 'DESC'),
    's' => (isset($_GET["query"]) ? $_GET["query"] : ''),
    'date_query' => array(
        'after' => (isset($_GET["date_after"]) ? $_GET["date_after"] : ''),
        'before' => (isset($_GET["date_before"]) ? $_GET["date_before"] : '')
    )
);

if ($search_terms != "") {
    $args['tax_query'] = array(
        array(
            'taxonomy' => $_GET["taxonomy"],
            'field' => 'slug',
            'terms' => explode(",", $search_terms)
        )
    );
}

if (in_array("categories", get_field("filters"))) {
    $search_categories = get_field("select_categories");
    foreach ($search_categories as $key => $category) {
        $search_categories[$key] = get_category($category)->slug;
    }
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $search_categories
        )
    );
}
$post_query = new WP_Query( $args );


?>


<div class="pkn-article-list-filters-wrapper mb-12">
    <div class="pkn-article-list-filters-outer pkn-article-list-filters-desktop flex justify-between py-3 border-primary-20">
        <div class="pkn-article-list-filters-types flex gap-x-8 items-center">
            <div class="pkn-article-list-searchbar flex gap-x-2 justify-between items-center border-b-2 border-b-primary h-full">
                <input type="text" name="query" placeholder="<?= __("Artikel durchsuchen...", "pknetz") ?>" value="<?php echo (isset($_GET["query"]) ? $_GET["query"] : ''); ?>" class="w-56">
                <i data-feather="search" class="text-primary"></i>
            </div>
            <div class="pkn-article-list-categories h-fit">
                <?php
                if (get_field("select_post_types") == "recommendations") {
                    $categories = get_categories(array(
                        'taxonomy' => 'firma'
                    ));
                    $cat_label = __("Firmen wählen...", "pknetz");
                    $type="firma";
                } else {
                    $categories = get_tags(array(
                        "hide_empty" => false
                    ));
                    $cat_label = __("Schlagwörter wählen...", "pknetz");
                    $type="post_tag";
                }
                ?>
                <select multiple name="taxonomy" data-taxonomy="<?= $type ?>">
                    <option value=""><?= $cat_label ?></option>
                    <?php
                    foreach ($categories as $category) {
                        echo '<option value="' . $category->slug . '" ' . (in_array($category->slug, explode(",", $search_terms)) ? 'selected' : '') . '>' . $category->name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="pkn-article-list-filters-button">
            <button class="pkn-article-list-filters-button-apply p-3 bg-primary text-white"><?= esc_html__("Filtern", "pknetz") ?></button>
        </div>
    </div>
    <div class="pkn-article-list-filters-mobile" hidden>
        <div class="pkn-article-list-filters-mobile-container max-h-0 overflow-hidden">
            <div class="pkn-article-list-filters-height pb-6">
                <div class="pkn-article-list-filters-outer flex flex-col gap-y-4 justify-between">
                    <div class="pkn-article-list-searchbar flex gap-x-2 justify-between items-center border-b-2 border-b-primary py-2">
                        <input type="text" name="query" placeholder="<?= __("Artikel durchsuchen...", "pknetz") ?>" value="<?php echo (isset($_GET["query"]) ? $_GET["query"] : ''); ?>" class="w-full">
                        <i data-feather="search" class="text-primary"></i>
                    </div>
                    <div class="pkn-article-list-categories h-fit">
                        <?php
                        if (get_field("select_post_types") == "recommendations") {
                            $categories = get_categories(array(
                                'taxonomy' => 'firma'
                            ));
                            $cat_label = __("Firmen wählen...", "pknetz");
                            $type="firma";
                        } else {
                            $categories = get_tags(array(
                                "hide_empty" => false
                            ));
                            $cat_label = __("Schlagwörter wählen...", "pknetz");
                            $type="post_tag";
                        }
                        ?>
                        <select multiple name="taxonomy" data-taxonomy="<?= $type ?>">
                            <option value=""><?= $cat_label ?></option>
                            <?php
                            foreach ($categories as $category) {
                                echo '<option value="' . $category->slug . '" ' . (in_array($category->slug, explode(",", $search_terms)) ? 'selected' : '') . '>' . $category->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="pkn-article-list-filters-button">
                        <button class="pkn-article-list-filters-button-apply p-3 bg-primary text-white w-full"><?= esc_html__("Filtern", "pknetz") ?></button>
                    </div>
                </div>
            </div>
        </div>
        <button class="pkn-article-list-show-mobile-filter p-2 flex gap-x-1 items-center text-primary bg-grey-20"><i data-feather="plus" class="h-3 w-3"></i><?= esc_html__("Filter anzeigen", "pknetz") ?></button>
    </div>
</div>

<div class="pkn-article-list-wrapper flex flex-col gap-y-6">
    <?php if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post(); ?>

      <div class="pkn-article-wrapper border-y-2 border-y-grey-20 bg-grey-slight">
        <div class="pkn-article-inner <?= (has_post_thumbnail(  )) ? " pkn-article-inner--with-thumbmail" : "" ?>">
            <?php
            if (has_post_thumbnail(  )) :
            ?>
            <div class="pkn-article-image-mobile w-full" hidden>
                <img src="<?= get_the_post_thumbnail_url($post_query->ID, "medium_large"  ) ?>" alt="<?= the_title() ?>">
            </div>
            <?php
            endif;
            ?>
            <div class="pkn-article-content p-3">
                    <h3 class="text-xl normal-case font-semibold mb-3"><?= the_title() ?></h3>
                <?= the_excerpt(  ) ?>
                <a href="<?= the_permalink() ?>" class="pkn-article-read-more pkn-noline inline-flex items-center mt-3"><?= esc_html__("Weiterlesen", "pknetz") ?><i data-feather="chevron-right"></i></a>
            </div>
            <?php
            if (has_post_thumbnail(  )) :
            ?>
            <div class="pkn-article-image">
                <img src="<?= get_the_post_thumbnail_url($post_query->ID, "medium_large"  ) ?>" alt="<?= the_title() ?>">
            </div>
            <?php
            endif;
            ?>
        </div>
      </div>

    <?php endwhile; else: ?>

        <div class="pkn-article-list-item pkn-article-none-found">
            <h3><?= esc_html__("Keine Artikel gefunden", "pknetz") ?></h3>
            <p><?= esc_html__("Anhand Ihrer Kriterien konnten wir leider keine Beiträge finden.", "pknetz") ?></p>
        </div>

<?php endif; ?>
</div>

<div class="pkn-article-list-pagination">
    <?php
    echo paginate_links( array(
        'current' => max( 1, get_query_var('paged') ),
        'total' => $post_query->max_num_pages
    ) );
?>
</div>