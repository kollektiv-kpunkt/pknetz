<?php
$recs = get_posts (
    array(
        'post_type' => 'recommendations',
        'posts_per_page' => 4
    )
);
?>
<div class="pkn-actares-fp-outer bg-grey-20">
    <div class="pkn-actares-fp-inner md-container py-32">
        <h2 class="pkn-actares-fp-title md:text-5xl text-3xl mb-10">Actares Empfehlungen</h2>
        <div class="pkn-actares-fp-grid flex flex-wrap">
            <?php
            foreach($recs as $rec) :
                $firma = get_the_terms($rec->ID, 'firma')[0];
            ?>
            <div class="pkn-actares-fp-card p-6 pkn-noline bg-primary text-white h-fit">
                <h3 class="pkn-actares-fp-card-title text-2xl normal-case max-w-xs mb-2 underline"><a href="<?= get_the_permalink($rec->ID) ?>" class="pkn-noline"><?= $rec->post_title ?></a></h3>
                <a href="/angebot/actares/?terms=<?= $firma->slug ?>&taxonomy=firma" class="pkn-noline text-white"><?= $firma->name ?></a>
            </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>