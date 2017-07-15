$(function () {
    // 手机号验证
    $('.phone').blur(function () {
        var phone = $(this).val();
        if (!(/^1[34578]\d{9}$/.test(phone)) || phone.length != 11 || !phone || phone.substring(0, 2) == '输入') {
            $(this).parent().find(".info-mes").css("display","block");
            return;
        }
    });

    // 密码验证
    $('.password').blur(function () {
        var password = $(this).val();
        if (!password || password.substring(0, 2) == '输入' || !(/^[a-zA-Z0-9]{6,16}$/.test(password))) {
            $(this).parent().find(".info-mes").css("display","block");
            return;
        }
    });

    //手机验证码
    $('.public-code').blur(function () {
        var phone_code = $(this).val();
        if (!phone_code || phone_code.substring(0, 2) == '输入') {
            $(this).parent().find(".info-mes").css("display","block");
            return;
        }
    });

    //登录
    $('.imay-login').click(function () {
        if ($('input:checkbox[name="loginReg"]:checked').val() != 'on') {
            return;
        }
        var obj = {};
        //obj.country = $('.login-sc').val();
        obj.country = '86';
        obj.phone = $('.phone').val();
        obj.password = $('.password').val();

        if ((/^1[345789]\d{9}$/.test(obj.phone)) && obj.phone.length == 11 && obj.phone && obj.phone.substring(0, 2) != '输入' &&
            obj.password && obj.password.substring(0, 2) != '输入' && (/^[a-zA-Z0-9]{6,16}$/.test(obj.password)) && obj.country) {
            $.post(login, obj, function (data) {
                if (data.status == '1') {
                    window.location.href = jumpPage;
                } else if (data.status == '2') {
                    $('.imay-login').siblings('.p-l-error').html(data.content);
                    $('.imay-login').siblings('.p-l-error').css("display", "block");
                } else {
                    $(".imay-login").siblings('.p-l-error').css("display", "block");
                }
            }, "json")
        }
    });

    //忘记密码
    $('.forget-password').click(function () {
        var obj = {};
        //obj.country = $('.forget-sc').val();
        obj.country = '86';
        obj.phone = $('.forgot-phone').val();
        obj.phone_code = $('.forgot-code').val();
        obj.password = $('.forgot-password').val();
        obj.type = $('.forgot-message').text();

        if ((/^1[34578]\d{9}$/.test(obj.phone)) && obj.phone.length == 11 && obj.phone && obj.phone.substring(0, 2) != '输入' &&
            obj.password && obj.password.substring(0, 2) != '输入' && (/^[a-zA-Z0-9]{6,16}$/.test(obj.password)) &&
            obj.country && obj.phone_code && obj.phone_code.substring(0, 2) != '输入' && obj.type == '0') {
            $.post(forgetPassword, obj, function (data) {
                if (data.status == '1') {
                    window.location.href = jumpPage;
                } else if (data.status == '2') {
                    $(".forget-password").siblings('.p-l-error').html(data.content);
                    $(".forget-password").siblings('.p-l-error').css("display", "block");
                } else {
                    $(".forget-password").siblings('.p-l-error').css("display", "block");
                }
            }, "json")
        }
    });

    //获取注册信息并赋值到上传头像窗口并打开
    $('.iamy-register').click(function () {
        var obj = {};
        //obj.country = $('.register-sc').val();
        obj.country = '86';
        obj.phone = $('.register-phone').val();
        obj.type = $('.register-message').text();
        obj.phone_code = $('.register-code').val();
        obj.password = $('.register-password').val();
        if ((/^1[34578]\d{9}$/.test(obj.phone)) && obj.phone.length == 11 && obj.phone && obj.phone.substring(0, 2) != '输入' &&
            obj.password && obj.password.substring(0, 2) != '输入' && (/^[a-zA-Z0-9]{6,16}$/.test(obj.password)) &&
            obj.country && obj.phone_code && obj.phone_code.substring(0, 2) != '输入' && obj.type == '0') {
            $('.g-upload-pop').show();
            $('.country-register').attr('value', obj.country);
            $('.phone-register').attr('value', obj.phone);
            $('.code-register').attr('value', obj.phone_code);
            $('.password-register').attr('value', obj.password);
            $('.g-login-pop').hide();
        }
    });

    //提交注册
    $('.submit-register').click(function () {
        var obj = {};
        var reg = /[^\a-\z\A-\Z0-9\u4E00-\u9FA5]/g;
        //obj.country = $('.country-register').val();
        obj.country = '86';
        obj.phone = $('.phone-register').val();
        obj.code = $('.code-register').val();
        obj.password = $('.password-register').val();
        obj.nick = $('.nick').val();
        if (!obj.nick || obj.nick.substring(0, 3) == '请输入' || obj.nick.length > 8 || (reg.test(obj.nick))) {
            $('.nick').parent().find(".info-mes").css("display","block");
            return;
        }
        obj.img_head = $('#s_Filedata').val();
        if (!obj.img_head || obj.img_head.substring(0, 2) == '输入') {
            $('#s_Filedata').parent().find(".info-mes").css("display","block");
            return;
        }

        if (obj.nick != '' && obj.img_head != '') {
            $.post(register, obj, function (data) {
                if (data.status == '1') {
                    window.location.href = jumpPage;
                } else if (data.status == '2') {
                    $('.submit-register').siblings('.p-l-error').html(data.content);
                    $('.submit-register').siblings('.p-l-error').css("display", "block");
                } else {
                    $('.submit-register').siblings('.p-l-error').css("display", "block");
                }
            }, "json")
        }
    });

    //获取验证码
    $('.getCode').click(function () {
        var obj = {};
        obj.type = '1';
        obj.phone = $('.register-phone').val();

        //obj.country = $('.register-sc').val();
        obj.country = '86';
        if (obj.phone) {
            time(this);
            $.post(verificationCode, obj, function (data) {
                if (data.status == '2') {
                    $('.getCode').parents().parents().find('.register-phone').siblings('span').html(data.content);
                    $('.register-message').html('1');
                    $('.getCode').parents().parents().find('.register-phone').siblings('span').css("display", "block");
                } else if (data.status == 1) {
                    $('.getCode').parents().parents().find('.register-phone').siblings('b').html('0');
                }
            }, "json");
        } else {
            $('.getCode').parents().parents().find('.register-phone').siblings('span').css("display", "block");
        }
    });

    //获取验证码
    $('.getCodes').click(function () {
        var obj = {};
        obj.type = '2';
        obj.phone = $('.forgot-phone').val();

        //obj.country = $('.forget-sc').val();
        obj.country = '86';
        if (obj.phone) {
            times(this);
            $.post(verificationCode, obj, function (data) {
                if (data.status == '2') {
                    $('.getCodes').parents().parents().find('.forgot-phone').siblings('span').html(data.content);
                    $('.forgot-message').html('1');
                    $('.getCodes').parents().parents().find('.forgot-phone').siblings('span').css("display","block");
                } else if (data.status == 1) {
                    $('.getCodes').parents().parents().find('.forgot-phone').siblings('b').html('0');
                }
            }, "json");
        } else {
            $('.getCodes').parents().parents().find('.forgot-phone').siblings('span').css("display", "block");
        }
    });

    //退出
    $('.i-exit-a').click(function () {
        $.post(signOut, function (data) {
            if (data.status == '1') {
                window.location.href = jumpPage;
            }
        }, "json");
    });

});


//60s倒计时
function time(btn){
    if (wait===0) {
        $('.getCode').html("重新发送").show();
        $('.code_btn_dis').hide();
        wait = 60;
    }else{
        $('.getCode').hide();
        $('.code_btn_dis').html(wait).show();
        wait--;
        setTimeout(function(){
            time(btn);
        },1000);
    }
}

//60s倒计时
function times(btn){
    if (wait===0) {
        $('.getCodes').html('重新发送').show();
        $('.codes_btn_dis').hide();
        wait = 60;
    }else{
        $('.getCodes').hide();
        $('.codes_btn_dis').html(wait).show();
        wait--;
        setTimeout(function(){
            times(btn);
        },1000);
    }
}