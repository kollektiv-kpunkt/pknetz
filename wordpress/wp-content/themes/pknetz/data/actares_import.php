<?php
require_once(__DIR__ . '/../../../../wp-load.php');

$posts = json_decode(file_get_contents(__DIR__ . '/actares/posts-firma.json'), true);

foreach ($posts as $key => $post) {
    $post_id = wp_insert_post([
        'post_title' => $post['title'],
        'post_content' => $post['content'],
        'post_excerpt' => $post['excerpt'],
        'post_date' => $post['date'],
        'post_status' => 'publish',
        'post_type' => 'recommendations',
        'post_author' => 1
    ]);

    if ($post_id) {
        $posts[$key]['id'] = $post_id;
        set_post_thumbnail($post_id, $post['thumbnail']);
        wp_set_post_terms($post_id, $post['firma'], "firma");
        wp_set_post_tags($post_id, $post['tags']);
    }
}