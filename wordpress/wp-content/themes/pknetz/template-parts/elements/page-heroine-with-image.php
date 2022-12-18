<?php
$thumbnail = get_the_post_thumbnail_url( );
?>
<div class="pkn-page-imageheroine-outer relative mt-8">
    <div class="pkn-page-imageheroine-title-wrapper relative z-10">
        <div class="pkn-page-imageheroine-title-inner md-container pb-6">
            <h1 class="pkn-page-imageheroine-title text-white mb-0"><?= get_the_title( ) ?></h1>
        </div>
    </div>
    <div class="pkn-page-imageheroine-image-wrapper z-0">
        <img src="<?= $thumbnail ?>" alt="">
        <div class="pkn-page-imageheroine-image-overlay"></div>
    </div>
</div>