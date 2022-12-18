<?php

$posts = json_decode(file_get_contents(__DIR__ . '/actares/posts.json'));

foreach ($posts as $key => $post) {
    if (!isset($post->firma)) {
        $post->firma = explode(",", $post->title)[0];
        $post->firma = str_replace("GV von ","", $post->firma);
        $post->firma = str_replace("GV der ","", $post->firma);
    }
    unset($post->categories);
}

file_put_contents(__DIR__ . '/actares/posts-firma.json', json_encode($posts, JSON_PRETTY_PRINT));