<nav class="pkn-nav-wrapper">
    <div class="pkn-nav-outer md-container pt-8 pb-4">
        <div class="pkn-nav-upper">
            <div class="pkn-nav-upper-content flex justify-between">
                <div class="pkn-some-icons h-fit flex gap-x-3 mt-auto">
                    <?php
                    $icons = pkn_menu_items("pkn-some-icons");
                    foreach ($icons as $icon) :
                    ?>
                    <div class="pkn-some-icon-wrapper text-primary flex<?= ($icon->classes != "") ? " " . implode(" ", $icon->classes) : ""; ?>">
                        <div class="pkn-some-icon flex p-1 border-2 border-primary rounded-full">
                            <a href="<?= $icon->url ?>" class="pkn-some-link text-primary p-0 pkn-noline">
                                <div class="pkn-some-icon-svg h-3 w-3" data-feather="<?= $icon->title ?>"></div>
                            </a>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <a href="/" class="flex">
                    <?php
                    get_template_part( "public/ressources/img/logo" );
                    ?>
                </a>
            </div>
        </div>
        <div class="pkn-nav-lower">
            <div class="pkn-nav-lower-content">
                <?php
                wp_nav_menu( array(
                    "theme_location" => "pkn-main-nav",
                    "container" => "ul",
                    "menu_class" => "pkn-main-nav flex gap-x-3 justify-between mt-6 pkn-menu",
                ) );
                ?>
            </div>
        </div>
    </div>
</nav>
