<?php if (!defined('EMLOG_ROOT')) {
    exit('error!');
} ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-10 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12 p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><?= lang('account_register') ?></h1>
                            </div>
                            <div class="alert alert-danger" style="display: none;" id="send-btn-resp"></div>
                            <?php if (isset($_GET['err_ckcode'])): ?>
                                <div class="alert alert-danger"><?= lang('validation_error') ?></div><?php endif ?>
                            <?php if (isset($_GET['err_mail_code'])): ?>
                                <div class="alert alert-danger"><?= lang('verification_error') ?></div><?php endif ?>
                            <?php if (isset($_GET['error_login'])): ?>
                                <div class="alert alert-danger"><?= lang('email_format_error') ?></div><?php endif ?>
                            <?php if (isset($_GET['error_exist'])): ?>
                                <div class="alert alert-danger"><?= lang('email_in_use') ?></div><?php endif ?>
                            <?php if (isset($_GET['error_pwd_len'])): ?>
                                <div class="alert alert-danger"><?= lang('password_short') ?></div><?php endif ?>
                            <?php if (isset($_GET['error_pwd2'])): ?>
                                <div class="alert alert-danger"><?= lang('password_not_equal') ?></div><?php endif ?>
                            <form method="post" class="user" action="./account.php?action=dosignup">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="mail" name="mail" aria-describedby="emailHelp" placeholder="<?= lang('user_name') ?>" required
                                           autofocus>
                                </div>
                                <div class="form-group">
<!--vot-->                          <input type="password" class="form-control form-control-user" minlength="5" id="passwd" autocomplete="new-password" name="passwd"
                                           placeholder="<?= lang('password') ?>" required>
                                </div>
                                <div class="form-group">
<!--vot-->                          <input type="password" class="form-control form-control-user" minlength="5" id="repasswd" name="repasswd" placeholder="<?= lang('password_confirm') ?>"
                                           required>
                                </div>
                                <?php if ($email_code): ?>
                                    <div class="form-group form-inline">
                                        <input type="text" name="mail_code" class="form-control form-control-user" style="width: 180px;" id="mail_code" placeholder="<?= lang('email_verification_code') ?>"
                                               required>
                                        <button class="btn btn-success btn-user mx-2" type="button" id="send-btn"><?= lang('send_email_code') ?></button>
                                    </div>
                                <?php endif ?>
                                <?php if ($login_code): ?>
                                    <div class="form-group form-inline">
                                        <input type="text" name="login_code" class="form-control form-control-user" style="width: 180px;" id="login_code" placeholder="<?= lang('captcha') ?>"
                                               required>
                                        <img src="../include/lib/checkcode.php" id="checkcode" class="mx-2">
                                    </div>
                                <?php endif ?>
                                <button class="btn btn-success btn-user btn-block" type="submit"><?= lang('register') ?></button>
                                <hr>
<!-- vot-->                     <div class="text-center"><a href="./"><?= lang('log_in') ?></a></div>
                                <hr>
<!-- vot-->                     <div class="text-center"><a href="<?= BLOG_URL ?>" class="small" role="button">&larr;<?= lang('back_home') ?></a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
<script>
    // send mail code
    $(function () {
        setTimeout(hideActived, 6000);
        $('#checkcode').click(function () {
            var timestamp = new Date().getTime();
            $(this).attr("src", "../include/lib/checkcode.php?" + timestamp);
        });

        $('#send-btn').click(function () {
            const email = $('#mail').val();
            const sendBtn = $(this);
            const sendBtnResp = $('#send-btn-resp');
            sendBtnResp.html('')
            sendBtn.prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: './account.php?action=send_email_code',
                data: {
                    mail: email
                },
                success: function (response) {
                    // After sending the email successfully, start the countdown
                    let seconds = 60;
                    // Start the countdown
                    const countdownInterval = setInterval(() => {
                        seconds--;
                        if (seconds <= 0) {
                            clearInterval(countdownInterval);
/*vot*/                     sendBtn.html(lang('send_email_code'));
                            sendBtn.prop('disabled', false);
                        } else {
/*vot*/                     sendBtn.html(lang('code_valid_for') + seconds + lang('_seconds'));
                        }
                    }, 1000);
                },
                error: function (data) {
                    sendBtnResp.html(data.responseJSON.msg).addClass('text-danger').show()
                    sendBtn.prop('disabled', false);
                }
            });
        });
    });
</script>
