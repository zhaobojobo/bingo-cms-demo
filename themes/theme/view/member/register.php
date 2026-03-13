<?php
/**
 * view data
 *
 * @var $site
 * @var $seo
 * @var $page
 */ ?>

<?php
$this->layout('layouts/main') ?>

<main class="main page-member-register" id="page-member-register">
    <div class="banner mb-5">
        <img src="<?= themePath() ?>/images/banner.jpeg" alt="">
    </div>
    <div class="container-fluid">
        <form class="bingo-form member-form member-register" id="member-register"
              action="<?= url('/member/register') ?>"
              method="post">
            <h2 class="text-center">會員注冊</h2>
            <hr>
            <div class="mb-3">
                <label for="register-email" class="form-label">郵件</label>
                <input type="text" class="form-control" id="register-email" name="email">
                <p class="text-warning error error-email"></p>
            </div>
            <div class="mb-3">
                <label for="register-password" class="form-label">密碼</label>
                <input type="password" class="form-control" id="register-password" name="password" autocomplete="off">
                <p class="text-warning error error-password"></p>
            </div>
            <div class="mb-3">
                <label for="register-password-repeat" class="form-label">重復密碼</label>
                <input type="password" class="form-control" id="register-password-repeat" name="password-repeat"
                       autocomplete="off">
                <p class="text-warning error error-password-repeat"></p>
            </div>
            <div class="mb-3">
                <label for="login-captcha" class="form-label">驗證碼</label>
                <div class="d-flex">
                    <input type="text" class="form-control" id="login-captcha" name="captcha">
                    <img src="<?= url('/captcha.jpg') ?>" alt="" height="38" class="captcha"
                         title="看不清? 點擊更換...">
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">注冊</button>
            </div>
            <hr>
            <div class="form-footer">
                已有帳號? <a href="<?= url('/member/login') ?>">登入</a>
            </div>
        </form>
    </div>
</main>
