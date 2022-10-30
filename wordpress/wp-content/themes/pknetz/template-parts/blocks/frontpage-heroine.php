<div class="pkn-fp-heroine-wrapper">
    <div class="pkn-fp-carousel-outer">
        <div class="pkn-fp-carousel-slides relative">
            <?php
            $slides = get_field('slides');
            $i = 1;
            foreach ($slides as $slide) :
                switch ($slide["type"]):
                    case "url";
                        $url = $slide["url"];
                    break;
                    case "page";
                        $url = get_permalink($slide["object"]->ID);
                    break;
                endswitch;
            ?>
            <div class="pkn-fp-slide absolute top-0 left-0 <?= ($i == 1) ? "pkn-slide-active" : "" ?>">
                <?php
                if ($slide["image"]) {
                    $image = $slide["image"]["ID"];
                    $image_html = wp_get_attachment_image($image, 'full');
                } else {
                    $template_dir = get_template_directory_uri();
                    $image_html = <<<EOD
                    <img src="{$template_dir}/template-parts/blocks/img/default_fp_slider.jpg" alt="Slide Background: {$slide["title"]}" loading="lazy">
                    EOD;
                }
                ?>
                <div class="pkn-fp-slide-image">
                    <?= $image_html ?>
                </div>
                <div class="pkn-fp-slide-overlay"></div>
                <div class="pkn-fp-slide-title">
                    <h1 class="text-4xl font-bold text-white mb-0 uppercase"><?= $slide["title"] ?></h1>
                </div>
            </div>
            <?php
            $i++;
            endforeach;
            ?>
        </div>
        <div class="pkn-fp-pagination">
            <?php
            $i = 1;
            foreach ($slides as $slide) :
            ?>
            <div class="pkn-fp-pagination-item<?= ($i == 1) ? " pkn-pagination-item-active" : "" ?>"></div>
            <?php
            $i++;
            endforeach;
            ?>
        </div>
    </div>
    <?php
    $buttons = get_field('buttons');
    ?>
    <div class="pkn-fp-buttons-wrapper" style="--buttons:<?= count($buttons) ?>">
        <div class="pkn-fp-buttons md-container">
            <div class="pkn-fp-buttons-inner flex justify-center">
                <?php
                $i = 1;
                foreach ($buttons as $button) :
                ?>
                <div class="pkn-fp-button-wrapper">
                    <div class="pkn-fp-button">
                        <div class="pkn-fp-button-inner">
                            <a href="<?= get_permalink($button["page"]->ID) ?>" data-button-id="<?= $i ?>">
                                <div class="pkn-fp-button-icon">
                                    <div class="pkn-fp-button-feather" data-feather="<?= $button["icon"] ?>"></div>
                                </div>
                                <div class="pkn-fp-button-title">
                                    <h3 class="text-2xl mb-0"><?= $button["title"] ?></h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
