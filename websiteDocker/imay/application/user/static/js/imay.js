$(function() {
    //给第一个充值金额选项添加样式
    $('.bg_click li').each(function () {
        if ( $(this).val() == 1) {
            $(this).addClass('click_count');
        }
    });

    //选择充值金额
    $('.total_count ').html($('.bg_click li').first().find('i').text());
    $('.diamond ').attr('value', $('.bg_click li').first().find('span').text());
    $('.bg_click li').click(function() {
        var diamond = $(this).find('span').text();
        $('.bg_click li').children('span').css('color', '#7e7e7e');
        $('.bg_click li').children('i').css('color', '#f36363');
        $('.bg_click li').removeClass('click_count');
        $(this).addClass('click_count');
        $(this).children('span').css('color', '#fff');
        $(this).children('i').css('color', '#fff');
        $('.total_count ').html($(this).find('i').text());
        $('.diamond ').attr('value', diamond);
    });

    //选择充值金额
    $('.pay_way ul li').click(function() {
        if ($(this).attr('value') == 'weixin') {
            $('.pay_way ul li').removeClass('click_zi');
            $(this).addClass('click_wai')
        } else if ($(this).attr('value') == 'zhifubao') {
            $('.pay_way ul li').removeClass('click_wai');
            $(this).addClass('click_zi')
        }
    });


    //弹登录出框
    $('.login_alert').click(function() {
        $('.code_btn_dis').hide();
        $('.verification_code').hide();
            screen_position('imay_login', 'screen', 'block');
            $(window).on('resize', function() {
                if ($('.imay_login').css('display') == 'block') {
                    screen_position('imay_login', 'screen', 'block')
                }


            })
        });
        //关闭登录出框
    $('.close_login span').click(function() {
        screen_position('imay_login', 'screen', 'close')

    });


    // 弹出来imay输入框
    $('.imay_number').click(function() {
            screen_position('recharge_num', 'screen', 'block');
            $(window).on('resize', function() {
                screen_position('code_btn_dis', 'screen', 'block');
                if ($('.recharge_num').css('display') == 'block') {
                    screen_position('recharge_num', 'screen', 'block')
                }
            })

        });
        // 关闭imay输入框
    $('.close_imay_num span').click(function() {
        screen_position('recharge_num', 'screen', 'close')
    })


});
