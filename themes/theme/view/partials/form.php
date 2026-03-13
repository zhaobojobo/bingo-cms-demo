<form class="contact-form" action="<?= url('/form/5') ?>" method="post">
    <div class="row g-3 g-xl-4">
        <div class="col-6">
            <input type="text" class="form-control" placeholder="<?= t('Your name') ?>*"
                   aria-label="<?= t('Your name') ?>*" name="name">
        </div>
        <div class="col-6">
            <input type="text" class="form-control" placeholder="<?= t('Company name') ?>"
                   aria-label="<?= t('Company name') ?>" name="company">
        </div>
        <div class="col-12">
            <input type="text" class="form-control" placeholder="<?= t('Your e-mail address') ?>*"
                   aria-label="<?= t('Your e-mail address') ?>*" name="email">
        </div>
        <div class="col-12">
            <input type="text" class="form-control" placeholder="<?= t('Phone number') ?>"
                   aria-label="<?= t('Phone number') ?>" name="phone">
        </div>
        <div class="col-12">
            <input type="text" class="form-control" placeholder="<?= t('Subject') ?>*" aria-label="<?= t('Subject') ?>"
                   name="subject">
        </div>
        <div class="col-12">
            <textarea class="form-control" rows="5" placeholder="<?= t('Message') ?>*" aria-label="<?= t('Message') ?>"
                      name="message"></textarea>
        </div>
        <div class="col-6">
            <input type="text" class="form-control" placeholder="<?= t('Captcha') ?>*" aria-label="<?= t('Captcha') ?>"
                   name="captcha">
        </div>
        <div class="col-6">
            <?= captchaImage('64px') ?>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-white"><?= t('Submit') ?></button>
        </div>
    </div>
</form>