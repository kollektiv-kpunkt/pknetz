<?php
$children = $args["children"];
global $post;
?>

<div class="pkn-children-nav-outer bg-primary pr-5 flex w-fit mt-4 mb-8">
    <div class="pkn-children-nav-inner flex gap-x-8">
        <?php
        foreach ($children as $child) :
        ?>
        <a href="<?= get_permalink( $child->ID ) ?>" class="pkn-children-nav-item pkn-noline text-white<?= ($child->ID == $post->ID) ? " pkn-children-nav-item-current" : "" ?>">
            <div class="pkn-children-nav-item-inner">
                <p><?= $child->post_title ?></p>
            </div>
        </a>
        <?php
        endforeach;
        ?>
    </div>
</div>

<div class="pkn-children-nav-outer-mobile" hidden>
    <div class="pkn-children-nav-inner-mobile md-container flex flex-col items-start text-primary">
        <div class="pkn-children-nav-mobile-open flex gap-x-2">
            Mehr
            <i data-feather="more-horizontal" class="h-4 w-4 mt-1"></i>
        </div>
        <div class="pkn-children-nav-mobile-content-wrapper">
            <div class="pkn-children-nav-mobile-content flex">
                <div class="pkn-children-nav-mobile-content-inner flex flex-col gap-y-2 mt-4 text-white">
                <?php
                foreach ($children as $child) :
                ?>
                <a href="<?= get_permalink( $child->ID ) ?>" class="pkn-children-nav-item pkn-noline<?= ($child->ID == $post->ID) ? " pkn-children-nav-item-current" : "" ?>">
                    <div class="pkn-children-nav-item-inner bg-primary p-2 w-fit">
                        <p><?= $child->post_title ?></p>
                    </div>
                </a>
                <?php
                endforeach;
                ?>
                </div>
            </div>
        </div>
    </div>
</div>