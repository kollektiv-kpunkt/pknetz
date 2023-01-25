<?php
$post = get_post();
?>
<div class="pkn-event-signup">
    <h4 class="text-primary">Melden Sie sich für diesen Event an!</h4>
    <form action="https://n8n.victorinus.ch/webhook/7e794650-11f3-411c-b671-8669f358a97c" method="post" class="pkn-ajax-form pkn-form" data-success-action="showBilling">
        <div class="pkn-form-group flex flex-col">
            <label for="fname">Vorname</label>
            <input type="text" name="fname" id="fname" class="pkn-form-input" required>
        </div>
        <div class="pkn-form-group flex flex-col">
            <label for="lname">Nachname</label>
            <input type="text" name="lname" id="lname" class="pkn-form-input" required>
        </div>
        <div class="pkn-form-group flex flex-col fullwidth">
            <label for="email">E-Mail Adresse</label>
            <input type="email" name="email" id="email" class="pkn-form-input" required>
        </div>
        <div class="pkn-form-group flex flex-col fullwidth">
            <label for="organisation">Organisation</label>
            <input type="text" name="organisation" id="organisation" placeholder="optional" class="pkn-form-input">
        </div>
        <input type="hidden" name="event_tag" value="<?= (get_field("mautic_tag") != "") ? get_field("mautic_tag") : $post->post_name ?>">
        <button type="submit" class="pkn-button">Anmelden</button>
    </form>
    <form action="https://n8n.victorinus.ch/webhook/7e794650-11f3-411c-b671-8669f358a97c" method="post" class="pkn-ajax-form pkn-form pkn-billing-form" style="max-height: 0; overflow-y:hidden" data-success-action="finishSignup">
        <div class="pkn-form-group flex flex-col fullwidth">
            <label for="fname">An welche Adresse dürfen wir die Rechnung senden?</label>
            <textarea name="billing" id="billing" cols="30" rows="5" required></textarea>
            <p class="text-xs mt-2 italic text-gray-500">Bitte entweder E-Mail Adresse oder Postadresse angeben.</p>
        </div>
        <input type="hidden" name="email" value="">
        <button type="submit" class="pkn-button">Rechnungsadresse hinterlegen</button>
    </form>
    <div class="pkn-event-signup-success hidden">
        <p class="text-primary font-bold text-2xl mb-0 mt-8">Vielen Dank für Ihre Anmeldung!</p>
        <p class="m-0">Wir werden uns mit mehr Informationen bei Ihnen melden.</p>
    </div>
</div>