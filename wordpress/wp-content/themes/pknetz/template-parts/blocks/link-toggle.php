<div class="pkn-link-toggle-outer">
    <div class="pkn-link-toggle-inner">
        <div class="pkn-link-toggle-wrapper">
            <div class="pkn-link-toggle-content py-4 pr-4">
                <a href="<?= get_field("link") ?>" class="flex justify-between items-center pkn-noline"<?= (in_array("newtab", get_field("new_tab"))) ? " target=\"_blank\"" : "" ?>>
                    <p class="leading-none text-xl"><?= get_field("title") ?></p>
                    <i data-feather="<?= (get_field("type") == "right") ? "chevron-right" : "download" ?>" class="h-6 w-6"></i>
                </a>
            </div>
        </div>
    </div>
</div>