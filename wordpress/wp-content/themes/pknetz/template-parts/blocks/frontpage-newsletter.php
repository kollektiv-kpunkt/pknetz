<?php
$short_form = get_field('short_form');
$short_form = (isset($short_form[0]) && $short_form[0] == 1) ? true : false;
if ($short_form) :
?>
<form action="/api/newsletter" method="POST" class="pkn-api-form pkn-newsletter-form flex-1 w-fit">
    <div class="pkn-form-input-wrapper pkn-form-input-round flex justify-items-stretch">
        <input type="email" name="email" id="email" placeholder="E-Mail Adresse" class="pkn-form-input text-primary-140">
        <button type="submit">Abonnieren</button>
    </div>
</form>
<?php
else :
?>
<div class="pkn-newsletter-wrapper bg-primary-140">
    <div class="py-20 md-container text-white">
        <p class="lg:w-1/3 md:w-1/2 w-full">
            <?= the_field("cta") ?>
        </p>
        <div class="pkn-newsletter-form-outer mt-4 flex gap-x-4 justify-center items-center">
            <h3 class="md:text-5xl text-3xl flex-1 mb-0 leading-none">Newsletter</h3>
            <form action="/api/newsletter" method="POST" class="pkn-api-form pkn-newsletter-form flex-1 w-fit">
                <div class="pkn-form-input-wrapper pkn-form-input-round flex justify-items-stretch">
                    <input type="email" name="email" id="email" placeholder="E-Mail Adresse" class="pkn-form-input text-primary-140">
                    <button type="submit">Abonnieren</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
endif;
?>