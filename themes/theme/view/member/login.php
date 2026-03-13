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

<main class="main page-member-login" id="page-member-login">
    <div class="banner mb-5">
        <img src="<?= themePath() ?>/images/banner.jpeg" alt="">
    </div>
    <div class="container-fluid">
        <form class="bingo-form member-form member-login" id="member-login" action="<?= url('/member/login') ?>"
              method="post">
            <h2 class="text-center">會員登入</h2>
            <hr>
            <div class="mb-3">
                <label for="login-email" class="form-label">郵件</label>
                <input type="text" class="form-control" id="login-email" name="email">
                <p class="text-warning error error-email"></p>
            </div>
            <div class="mb-3">
                <label for="login-password" class="form-label">密碼</label>
                <input type="password" class="form-control" id="login-password" name="password" autocomplete="off">
                <p class="text-warning error error-password"></p>
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
                <button type="submit" class="btn btn-primary">登入</button>
            </div>
            <hr>
            <div class="form-footer d-flex justify-content-between align-items-center">
                <span>沒有帳號? <a href="<?= url('/member/register') ?>">注冊</a></span>
                <a href="<?= url('/member/password/forget') ?>">忘記密碼</a>
            </div>
        </form>
    </div>
</main>
