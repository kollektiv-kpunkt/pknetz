<div class="pkn-frontpage-blogs-outer md-container">
    <div class="pkn-frontpage-blogs-inner flex flex-wrap">
        <?php
        $blogs = get_field("blogs");
        foreach ($blogs as $blog) :
            $blog_title = (($blog["title"] != "") ? $blog["title"] : $blog["blog"]->post_title);
            $blog_excerpt = (($blog["excerpt"] != "") ? $blog["excerpt"] : ($blog["blog"]->post_excerpt != "" ? $blog["blog"]->post_excerpt : wp_trim_words($blog["blog"]->post_content, 45)));
            $blog = $blog["blog"];
        ?>
        <div class="pkn-frontpage-blog-card p-4 w-1/3 flex flex-col justify-between gap-y-8 bg-grey-slight">
            <h2 class="pkn-frontpage-blog-card-title text-3xl text-primary mb-0"><?= $blog_title ?></h2>
            <div class="pkn-frontpage-blog-card-lower">
                <p class="pkn-frontpage-blog-card-excerpt mb-4">
                    <?= $blog_excerpt ?>
                </p>
                <a href="<?= get_permalink($blog->ID) ?>" class="pkn-frontpage-blog-card-link text-primary">Mehr lesen</a>
            </div>
        </div>
        <?php
        endforeach;
        ?>
    </div>
</div>