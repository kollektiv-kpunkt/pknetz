<?php
$now = date('Y-m-d', time());
$expires = date('Y-m-d', strtotime('+1 year'));
$events = tribe_get_events(array("start_date" => date('Y-m-d', time()), "end_date" => $expires, 'posts_per_page' => 4));
// var_dump($events);
?>

<div class="pkn-events-fp-outer bg-primary">
    <div class="pkn-events-fp-inner md-container text-white py-32">
        <h2 class="pkn-events-fp-title md:text-6xl text-3xl mb-10">Veranstaltungen</h2>
        <div class="pkn-events-fp-grid flex flex-wrap">
            <?php
            foreach($events as $event) :
            ?>
            <a href="<?= get_the_permalink($event->ID) ?>" class="pkn-events-fp-card p-6 pkn-noline">
                <h3 class="pkn-events-fp-card-title text-2xl normal-case max-w-xs mb-2"><?= $event->post_title ?></h3>
                <p class="pkn-events-fp-card-date text-xl"><?= date("j. F", strtotime($event->event_date)) ?></p>
            </a>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>