<?php
/*
Template Name: Alias
Template Post Type: page
*/

if (get_field('page_alias') != "") {
    header("Location: " . get_the_permalink(get_field('page_alias')->ID));
} else {
    header("Location: " . get_field("page_link"));
}