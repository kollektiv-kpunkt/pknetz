<div class="pkn-footer-some-icons h-fit flex gap-x-3 mt-auto justify-end">
    <?php
    $icons = pkn_menu_items("pkn-some-icons");
    foreach ($icons as $icon) :
    ?>
    <div class="pkn-some-icon-wrapper text-white flex<?= ($icon->classes != "") ? " " . implode(" ", $icon->classes) : ""; ?>">
        <div class="pkn-some-icon flex p-1 border-2 border-white rounded-full">
            <a href="<?= $icon->url ?>" class="pkn-some-link text-white p-0 pkn-noline">
                <div class="pkn-some-icon-svg h-3 w-3" data-feather="<?= $icon->title ?>"></div>
            </a>
        </div>
    </div>
    <?php
    endforeach;
    ?>
</div>