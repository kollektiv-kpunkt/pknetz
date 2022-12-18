<?php
require_once(__DIR__ . '/../../../../wp-load.php');

$actares_posts = get_posts(
    array(
        'post_type' => 'post',
        'category_name' => 'actares',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    )
);

file_put_contents(__DIR__ . '/actares/posts.json', '');
$posts = [];
foreach ($actares_posts as $post) {
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

file_put_contents(__DIR__ . '/actares/posts.json', json_encode($posts, JSON_PRETTY_PRINT));