<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5">
    <?php
    wp_head();
    ?>
    <script src="<?= get_template_directory_uri(  ) ?>/public/hyphenation/Hyphenopoly_Loader.js"></script>
        <script>
        Hyphenopoly.config({
            require: {
                "de-ch": "FORCEHYPHENOPOLY",
            },
            setup: {
                selectors: {
                    "#main-content": {}
                }
            }
        });
        </script>
</head>
<body <?= body_class(  ) ?>>
    <?php
    get_template_part( "template-parts/elements/header-menu" );
    ?>
    <div id="main-content">