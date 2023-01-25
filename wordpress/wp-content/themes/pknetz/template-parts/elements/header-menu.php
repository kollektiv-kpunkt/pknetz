<nav class="pkn-nav-wrapper">
    <div class="pkn-nav-outer md-container pt-8 pb-4">
        <div class="pkn-nav-upper">
            <div class="pkn-nav-upper-content flex justify-between">
                <div class="pkn-some-icons h-fit flex gap-x-3 mt-auto">
                    <?php
                    $icons = pkn_menu_items("pkn-some-icons");
                    foreach ($icons as $icon) :
                    ?>
                    <a href="<?= $icon->url ?>" class="pkn-some-icon-wrapper pkn-some-link pkn-noline text-primary flex<?= ($icon->classes != "") ? " " . implode(" ", $icon->classes) : ""; ?>">
                        <div class="pkn-some-icon flex p-1 border-2 border-primary rounded-full">
                            <div class="p-0">
                                <div class="pkn-some-icon-svg h-3 w-3" data-feather="<?= $icon->title ?>"></div>
                            </div>
                        </div>
                    </a>
                    <?php
                    endforeach;
                    ?>
                </div>
                <a href="/" class="flex pkn-main-logo pkn-noline">
                    <?php
                    get_template_part( "public/ressources/img/logo" );
                    ?>
                </a>
            </div>
        </div>
        <div class="pkn-nav-lower">
            <div class="pkn-nav-desktop">
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
            <div class="pkn-nav-mobile" hidden>
                <button class="pkn-nav-mobile-toggle w-full flex justify-center p-4 font-bold bg-primary-20 mt-4 text-primary">
                    <p>Menu</p>
                    <div class="pkn-nav-mobile-tofuburger">
                        <i data-feather="chevron-down" class="h-4 w-4 mt-1 ml-2"></i>
                    </div>
                </button>
                <div class="pkn-nav-lower-content pkn-nav-mobile-lower-content">
                    <?php
                    wp_nav_menu( array(
                        "theme_location" => "pkn-main-nav",
                        "container" => "ul",
                        "menu_class" => "pkn-main-nav pkn-main-nav-mobile flex flex-col gap-y-3 mb-4 pkn-menu bg-grey-10 p-4",
                    ) );
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>
