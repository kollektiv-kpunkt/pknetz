<?php
require_once(__DIR__ . '/../../../../wp-load.php');

$ord_posts = get_posts(
    array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        "date_query" => array(
            array(
                "after" => "2019-12-31",
                "before" => "2023-01-01",
                "inclusive" => true
            )
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => 'actares',
                'include_children' => true,
                'operator' => 'NOT IN'
            )
        ),
    )
);

file_put_contents(__DIR__ . '/posts/posts.json', '');
$posts = [];
foreach ($ord_posts as $post) {
    $posts[] = [
        'id' => $post->ID,
        'title' => $post->post_title,
        'date' => $post->post_date,
        'content' => $post->post_content,
        'excerpt' => $post->post_excerpt,
        'link' => get_permalink($post->ID),
        'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
        'categories' => wp_get_post_categories($post->ID),
        'tags' => wp_get_post_tags($post->ID)
    ];
}

file_put_contents(__DIR__ . '/posts/posts.json', json_encode($posts, JSON_PRETTY_PRINT));