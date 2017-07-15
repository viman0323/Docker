$.browser                             = {};
$.browser.mozilla                     = /firefox/.test(navigator.userAgent.toLowerCase());
$.browser.webkit                      = /webkit/.test(navigator.userAgent.toLowerCase());
$.browser.opera                       = /opera/.test(navigator.userAgent.toLowerCase());
$.browser.msie                        = /msie/.test(navigator.userAgent.toLowerCase());
var WST                               = WST ? WST : {};
WST.v                                 = '1.4.1';
WST.pageHeight                        = function () {
    if ($.browser.msie) {
        return document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight :
            document.body.clientHeight;
    } else {
        return self.innerHeight;
    }
};
//返回当前页面宽度 
WST.pageWidth                         = function () {
    if ($.browser.msie) {
        return document.compatMode == "CSS1Compat" ? document.documentElement.clientWidth :
            document.body.clientWidth;
    } else {
        return self.innerWidth;
    }
};
WST.TreeSelector                      = function (item, data, rootId, defaultValue) {
    this._data   = data;
    this._item   = item;
    this._rootId = rootId;
    if (defaultValue)this.defaultValue = defaultValue;
}
WST.TreeSelector.prototype.createTree = function () {
    var len = this._data.length;
    for (var i = 0; i < len; i++) {
        if (this._data[i].pid == this._rootId) {
            this._item.options.add(new Option(" " + this._data[i].text, this._data[i].id));
            for (var j = 0; j < len; j++) {
                this.createSubOption(len, this._data[i], this._data[j]);
            }
        }
    }
    if (this.defaultValue)this._item.value = this.defaultValue;
}

WST.TreeSelector.prototype.createSubOption = function (len, current, next) {
    var blank = "..";
    if (next.pid == current.id) {
        intLevel   = 0;
        var intlvl = this.getLevel(this._data, this._rootId, current);
        for (a = 0; a < intlvl; a++)
            blank += "..";
        blank += "├-";
        this._item.options.add(new Option(blank + next.text, next.id));
        for (var j = 0; j < len; j++) {
            this.createSubOption(len, next, this._data[j]);
        }
    }
}
WST.TreeSelector.prototype.getLevel        = function (datasources, topId, currentitem) {
    
    var pid = currentitem.pid;
    if (pid != topId) {
        for (var i = 0; i < datasources.length; i++) {
            if (datasources[i].id == pid) {
                intLevel++;
                this.getLevel(datasources, topId, datasources[i]);
            }
        }
    }
    return intLevel;
}

// 只能輸入數字，且第一數字不能為0
WST.digitalOnly = function (obj) {
    // 先把非数字的都替换掉
    obj.value = obj.value.replace(/\D/g, "");
    // 必须保证第一个为数字
    //obj.value = obj.value.replace(/^0/g, "");
}
/**
 * 获取版本
 */
WST.getWSTMAllVersion = function (url) {
    
}
/********************
 * 取窗口滚动条高度
 ******************/
WST.getScrollTop = function () {
    var scrollTop = 0;
    if (document.documentElement && document.documentElement.scrollTop) {
        scrollTop = document.documentElement.scrollTop;
    }
    else if (document.body) {
        scrollTop = document.body.scrollTop;
    }
    return scrollTop;
}

/********************
 * 取文档内容实际高度
 *******************/
WST.getScrollHeight = function () {
    return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
}

//只能輸入數字
WST.isNumberKey = function (evt) {
    var e        = evt || window.event;
    var charCode = (evt.which) ? evt.which : e.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        return true;
    }
}

//只能輸入數字和小數點
WST.isNumberdoteKey = function (evt) {
    var e          = evt || window.event;
    var srcElement = e.srcElement || e.target;
    
    var charCode = (evt.which) ? evt.which : e.keyCode;
    if (charCode > 31 && ((charCode < 48 || charCode > 57) && charCode != 46)) {
        return false;
    } else {
        if (charCode == 46) {
            var s = srcElement.value;
            if (s.length == 0 || s.indexOf(".") != -1) {
                return false;
            }
        }
        return true;
    }
}

//只能輸入數字和字母
WST.isNumberCharKey = function (evt) {
    var e          = evt || window.event;
    var srcElement = e.srcElement || e.target;
    var charCode   = (evt.which) ? evt.which : e.keyCode;
    
    if ((charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode == 8) {
        return true;
    } else {
        return false;
    }
}

WST.isChinese = function (obj, isReplace) {
    var pattern = /[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/i
    if (pattern.test(obj.value)) {
        if (isReplace)obj.value = obj.value.replace(/[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/ig, "");
        return true;
    }
    return false;
}

Number.prototype.toFixed = function (exponent) {
    return parseInt(this * Math.pow(10, exponent) + 0.5) / Math.pow(10, exponent);
}

//用户名判断 （可输入"_",".","@", 数字，字母）
WST.isUserName = function (evt) {
    var e          = evt || window.event;
    var srcElement = e.srcElement || e.target;
    var charCode   = (evt.which) ? evt.which : event.keyCode;
    if ((charCode == 95 || charCode == 46 || charCode == 64) || (charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode == 8) {
        return true;
    } else {
        return false;
    }
}

WST.isEmail     = function (v) {
    var tel = new RegExp("^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$");
    return (tel.test(v));
}
//判断是否电话
WST.isTel       = function (v) {
    var tel = new RegExp("^[[0-9]{3}-|\[0-9]{4}-]?(\[0-9]{8}|[0-9]{7})?$");
    return (tel.test(v));
}
WST.isPhone     = function (v) {
    var tel = new RegExp("^[1][0-9]{10}$");
    return (tel.test(v));
}
//判断url
WST.isUrl       = function (str) {
    if (str == null || str == "") return false;
    var result = str.match(/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\’:+!]*([^<>\"])*$/);
    if (result == null)return false;
    return true;
}
//比较时间差
WST.getTimeDiff = function (startTime, endTime, diffType) {
    //将xxxx-xx-xx的时间格式，转换为 xxxx/xx/xx的格式
    startTime = startTime.replace(/-/g, "/");
    endTime   = endTime.replace(/-/g, "/");
    //将计算间隔类性字符转换为小写
    diffType  = diffType.toLowerCase();
    var sTime = new Date(startTime); //开始时间
    var eTime = new Date(endTime); //结束时间
    //作为除数的数字
    var divNum = 1;
    switch (diffType) {
        case "second":
            divNum = 1000;
            break;
        case "minute":
            divNum = 1000 * 60;
            break;
        case "hour":
            divNum = 1000 * 3600;
            break;
        case "day":
            divNum = 1000 * 3600 * 24;
            break;
        default:
            break;
    }
    return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
}

/***
 * 获取字节数
 * @param str
 * @returns
 */
WST.getBytes = function (str) {
    var cArr = str.match(/[^\x00-\xff]/ig);
    return str.length + (cArr == null ? 0 : cArr.length);
};

/***
 * 判断最小字节数
 * @param o
 * @param minLength
 * @returns
 */
WST.checkMinLength = function (o, minLength) {
    if (WST.getBytes(o) <= minLength) {
        return false;
    }
    return true;
}
/***
 * 判断最大字节数
 * @param o
 * @param maxLength
 * @returns
 */
WST.checkMaxLength = function (o, maxLength) {
    if (WST.getBytes(o) > maxLength) {
        return false;
    }
    return true;
}
WST.msg    = function (msg, options, func) {
    var opts = {};
    //有抖動的效果,第二位是函數
    if (typeof(options) != 'function') {
        opts = $.extend(opts, {time: 2000, shade: [0.4, '#000000']}, options);
        return layer.msg(msg, opts, func);
    } else {
        return layer.msg(msg, options);
    }
}
WST.toJson = function (str, notLimit) {
    var json = {};
    try {
        if (typeof(str ) == "object") {
            json = str;
        } else {
            json = eval("(" + str + ")");
        }
        if (!notLimit) {
            if (json.status && json.status == '-999') {
                alert('对不起，您已经退出系统！请重新登录');
                if (window.parent) {
                    window.parent.location.reload();
                } else {
                    location.reload();
                }
            } else if (json.status && json.status == '-998') {
                if (Plugins) {
                    Plugins.closeWindow();
                    Plugins.Tips({title: '信息提示', icon: 'error', content: '对不起，您没有操作权限，请与管理员联系', timeout: 1000});
                } else {
                    alert('对不起，您没有操作权限，请与管理员联系');
                }
                return;
            }
        }
    } catch (e) {
        alert("系统发生错误:" + e.getMessage);
        json = {};
    }
    return json;
}
//把wst-panel-full样式的表单设置布满屏幕高度
$(function () {
    if ($('.wst-panel-full').height() < WST.pageHeight())$('.wst-panel-full').height(WST.pageHeight() - 3);
});


/***
 * 加载下拉搜索选项
 * @param loginName
 * @param namelist
 */
function loadSearchList(loginName, namelist) {
    $("#" + loginName).keyup(function (event) {
        
        if (event.which == 38 || event.which == 40) {
            
            if ($(".options").length > 0) {
                curRowIndex = (event.which == 38) ? (curRowIndex - 1) : (curRowIndex + 1);
                if (curRowIndex < 1) {
                    curRowIndex                            = $(".options").length;
                    $(".options")[0].style.backgroundColor = "white";
                } else if (curRowIndex > $(".options").length) {
                    curRowIndex                                                   = 1;
                    $(".options")[$(".options").length - 1].style.backgroundColor = "white";
                } else {
                    var preIdx = (event.which == 40) ? (curRowIndex - 2) : curRowIndex;
                    if (event.which == 40) {
                        if (curRowIndex > 1)$(".options")[preIdx].style.backgroundColor = "white";
                    } else {
                        $(".options")[preIdx].style.backgroundColor = "white";
                    }
                }
                var obj                   = $(".options")[curRowIndex - 1];
                obj.style.backgroundColor = "#E9E5E1";
                var optionId              = obj.id;
                
                $("#" + loginName).val($("#" + optionId).html());
            }
        } else if (event.which == 13) {
            var optionId = 0;
            if ($(".options").length > 0 && curRowIndex >= 0) {
                
                var obj  = $(".options")[curRowIndex - 1];
                optionId = obj.id;
                $("#" + loginName).val($("#" + optionId).html());
                $("#" + namelist).hide();
                $("#" + namelist).html("");
            }
            
        } else {
            var keywords = $.trim($("#loginName").val());
            var html     = new Array();
            if (keywords.length < 1) {
                $("#" + namelist).hide();
                $("#" + namelist).html("");
                return;
            } else {
                if (keywords.indexOf("@") >= 0) {
                    var works  = keywords.split("@");
                    var rworks = keywords.split("@")[0];
                    var lworks = keywords.split("@")[1];
                    for (var i = 0; i < emailList.length; i++) {
                        if (emailList[i].indexOf(lworks) == 0) {
                            html.push("<div class='options' idx='" + i + "' id='nopt" + i + "' onmouseover='optionsOver(this," + i + ");' onclick='selectOpt(" + i + ")'>" + rworks + (i == 0 ? "" : "@") + emailList[i] + "</div>");
                        }
                    }
                } else {
                    for (var i = 0; i < emailList.length; i++) {
                        html.push("<div class='options' idx='" + i + "' id='nopt" + i + "' onmouseover='optionsOver(this," + i + ");' onclick='selectOpt(" + i + ")'>" + keywords + (i == 0 ? "" : "@") + emailList[i] + "</div>");
                    }
                }
                $("#" + namelist).show();
                $("#" + namelist).html(html.join(""));
            }
        }
    });
}

/**
 * 去除url中指定的参数(用于分页)
 */
WST.splitURL = function (spchar) {
    var url     = location.href;
    var urlist  = url.split("?");
    var furl    = new Array();
    var fparams = new Array();
    furl.push(urlist[0]);
    if (urlist.length > 1) {
        var urlparam = urlist[1];
        params       = urlparam.split("&");
        for (var i = 0; i < params.length; i++) {
            var vparam = params[i];
            var param  = vparam.split("=");
            if (param[0] != spchar) {
                fparams.push(vparam);
            }
        }
        if (fparams.length > 0) {
            furl.push(fparams.join("&"));
        }
        
    }
    if (furl.length > 1) {
        return furl.join("?");
    } else {
        return furl.join("");
    }
}

/**
 * 替换url
 */
WST.replaceURL = function (url, ar) {
    if (ar instanceof Array) {
        for (var i = 0; i < ar.length; i++) {
            url = url.replace('__' + i, ar[i]);
        }
        return url;
    } else {
        return url.replace('__0', ar);
    }
}
/**
 * 截取字符串
 */
WST.cutStr = function (str, len) {
    if (!str || str == '')return '';
    var strlen = 0;
    var s      = "";
    for (var i = 0; i < str.length; i++) {
        if (strlen >= len) {
            return s + "...";
        }
        if (str.charCodeAt(i) > 128)
            strlen += 2;
        else
            strlen++;
        s += str.charAt(i);
    }
    return s;
}
WST.checkChks    = function (obj, cobj) {
    $(cobj).each(function () {
        $(this)[0].checked = obj.checked;
    })
}
WST.getChks      = function (obj) {
    var ids = [];
    $(obj).each(function () {
        if ($(this)[0].checked)ids.push($(this).val());
    });
    return ids;
}
WST.showHide     = function (t, str) {
    var s = str.split(',');
    if (t) {
        for (var i = 0; i < s.length; i++) {
            $(s[i]).show();
        }
    } else {
        for (var i = 0; i < s.length; i++) {
            $(s[i]).hide();
        }
    }
    s = null;
}
WST.blank        = function (str, defaultVal) {
    if (str == '0000-00-00')str = '';
    if (str == '0000-00-00 00:00:00')str = '';
    if (!str)str = '';
    if (typeof(str) == 'null')str = '';
    if (typeof(str) == 'undefined')str = '';
    if (str == '' && defaultVal)str = defaultVal;
    return str;
}
WST.tips         = function (content, selector, options) {
    var opts = {};
    opts     = $.extend(opts, {tips: 1, time: 2000, maxWidth: 260}, options);
    return layer.tips(content, selector, opts);
}
WST.open         = function (options) {
    var opts = {};
    opts     = $.extend(opts, {}, options);
    return layer.open(opts);
}
WST.limitDecimal = function (obj, len) {
    var s = obj.value;
    if (s.indexOf(".") > -1) {
        if ((s.length - s.indexOf(".") - 1) > len) {
            obj.value = s.substring(0, s.indexOf(".") + len + 1);
        }
    }
    s = null;
}
WST.fillForm     = function (obj) {
    var params = {};
    var chk    = {}, s;
    $(obj).each(function () {
        if ($(this)[0].type == 'hidden' || $(this)[0].type == 'number' || $(this)[0].type == 'tel' || $(this)[0].type == 'password' || $(this)[0].type == 'select-one' || $(this)[0].type == 'textarea' || $(this)[0].type == 'text') {
            params[$(this).attr('id')] = $.trim($(this).val());
        } else if ($(this)[0].type == 'radio') {
            if ($(this).attr('name')) {
                params[$(this).attr('name')] = $('input[name=' + $(this).attr('name') + ']:checked').val();
            }
        } else if ($(this)[0].type == 'checkbox') {
            if ($(this).attr('name') && !chk[$(this).attr('name')]) {
                s                         = [];
                chk[$(this).attr('name')] = 1;
                $('input[name=' + $(this).attr('name') + ']:checked').each(function () {
                    s.push($(this).val());
                });
                params[$(this).attr('name')] = s.join(',');
            }
        }
    });
    chk = null, s = null;
    return params;
}

/**
 * 判断字符串是否为空
 * @param str
 * @returns {Boolean}
 */
WST.isNull = function (str)
//function IsNULL(str)
{
    if (typeof (value) == "function") {
        return false;
    }
    if (str == undefined || str == null || str == "" || str.length == 0) {
        return true;
    }
    
    return false;
}

//弹窗
function screen_position(className, screen, bkcl) {
    
    if (bkcl == 'block') {
        var b_height = $(window).height(),
            b_width  = $(window).width(),
            d_height = $('.' + className).height(),
            d_width  = $('.' + className).width();
        
        $('.' + className).css({
            top    : (b_height - d_height) / 2,
            left   : (b_width - d_width) / 2,
            display: 'block'
        })
        
        $('.' + screen).css({'display': 'block'})
        
    } else if (bkcl == 'close') {
        
        $('.' + screen).css({'display': 'none'})
        $('.' + className).css({'display': 'none'})
        
    } else {
        alert('必须传第三个参数，block或close')
    }
    
    
}


$(function () {
    //兼容ie8的placeholder 的代码
    if (!('placeholder' in document.createElement('input'))) {
        $('input[placeholder],textarea[placeholder]').each(function () {
            var that = $(this),
                text = that.attr('placeholder');
            if (that.val() === "") {
                that.val(text).addClass('placeholder');
            }
            that.focus(function () {
                if (that.val() === text) {
                    that.val("").removeClass('placeholder');
                }
            })
                .blur(function () {
                    if (that.val() === "") {
                        that.val(text).addClass('placeholder');
                    }
                })
                .closest('form').submit(function () {
                if (that.val() === text) {
                    that.val('');
                }
            });
        });
    }
    
    
})
/**
 * 直至20161202为止，所有的errorcode都已经被加到这里
 * 注释的内容表示还没转换为属性:"字符串" 的形式
 * 若发现你的errcode没有被转换，自己转换一下就可以了
 * @param errordesc
 * @returns {*}
 */
WST.getErrorMsg = function (errordesc) {
    var map = {
            CodeSuccess      : "",
            CodeSysError     : "系统错误",
            CodeParamError   : "参数错误",
            CodeDbError      : "数据库错误",
            CodeAuthError    : "鉴权失败",
            CodeIllegalAction: "非法操作",
        
            CodeAccountNameExist        : "用户名重复",
            CodeAccountPhoneNotExist    : "手机号未注册",
            CodeAccountSecretError      : "密码错误",
            CodeAccountAccesstokenExpire: "登陆已过期",
            CodeAccountUserNotLogin     : "用户未登陆",
            CodeAccountNickExist        : "昵称重复",
            CodeAccountPhoneRegisted    : "该手机号已注册",
            CodeAccountOldPasswordWrong : "旧密码不对",
            CodeAccountVerifyTooMany    : "发送验证码次数过多,请明天再试",
            CodeAccountVerifyError      : "验证码错误",
            CodeSensitiveWordLimit      : "敏感词限制",
            CodeAccountPhoneIllegel     : "手机号不合法",
            CodeAccountLock             : "您已被封号，暂时无法进行提现操作，如有问题请联系客服~",
            CodeAccountSmsFail          : "发送验证码失败",
            //
            CodeUserNotExist            : "用户不存在",
            CodeUserExist               : "用户已注册",
        
            // CodeUserSignInOnly = 210; 				//用户每天签到一次
            //
            // CodeUserRealNameVerified         = 220; 		//用户已经实名验证
            // CodeUserRealNameVerifieding      = 221; 		//用户实名验证中,请稍等
            // CodeUserBankVerifiedSame         = 222; 		//出现相同提现账号
            // CodeUserIdentificationLinkOnly   = 223; 	//出现相同身份
            // CodeUserIdentificationBlacklist  = 224; 	//此身份已进入黑名单
            // CodeUserLargeVipVerifieding      = 225; 		//大V已验证中,请稍等
            // CodeUserLargeVipVerified         = 226; 		//大V已验证
            // CodeUserLargeVipVerifiedLimit    = 227; 	//大V验证条件限制
            // CodeUserBrokerLimit              = 228; 				//经纪人身份限制
            // CodeUserBrokerChangeCDLimit      = 229; 		//经纪人更换时间限制
            // CodeUserRealNameVerifiedNotExist = 230; //用户未实名验证
            //
            //
            CodeAccountDiamondNotEnough     : "魅钻不足",
            CodeAccountMeiliNotEnough       : "魅力不足",
            CodeAccountWithdrawValueExceed  : "超出提现额度",
            CodeAccountWithdrawLiveTimeLimit: "直播时间不够60分钟",
            CodeAccountWithdrawCountLimit   : "每日提现限制3次",
            //
            // CodeRptDisable         = 501; // 你当前不能举报
            // CodeRptAlreadyReported = 502; // 你已举报过该内容
            // CodeRptReportLimite    = 503; // 已达每日举报3次的上限
            // CodeRptFeedLimite      = 504; // Feed只能举报1次
            // CodeRptRoomLimite      = 505; // 同房间10分钟内只能举报1次
            //
            // CodeFeedDelNotExist           = 1000;//评论不存在
            // CodeFeedNotExist              = 1001;//动态不存在
            // CodeFeedLikeNotExist          = 1002;//动态点赞不存在
            // CodeUserFollowNotExist        = 1003;//此用户未关注
            // CodeUserFollowExist           = 1004;//此用户已关注
            // CodeDelFeedNotUser            = 1005;//只能删除自己动态
            // CodeDelFeedModifyLimit        = 1006;//只能修改自己动态
            // CodeFeedRepostsNotFindSrcFeed = 1007;//转发动态失败.可能原创被删除
            // CodeFeedRepostsMsgLimit       = 1008;//转发动态失败.转发内容字数限制
            // CodeUserFollowFullLimit       = 1009;//用户关注已达上限
            //
            // CodeGiftTimeLimit             = 1998;//礼物时间限制
            // CodeStopBuyLimit              = 1999;//商城购买条件限制
            // CodeStopBuyError              = 2000;//商城购买失败
            // CodePetNotExist               = 2001;//宠物不存在
            // CodePetForeverTime            = 2002;//宠物不需要延续
            // CodePetReleaseLimit           = 2003;//宠物不允许放生
            // CodePetSetFightPosIsTimeLimit = 2004;//宠物已过期,无法上阵
            //
            //
            // CodeMountsNotExist = 2010;//座驾不存在
            //
            // CodeTaskNotExist           = 2020; //任务不存在
            // CodeTaskReceiveRewardLimit = 2021; //任务奖励已领取
            // CodeTaskUnFinish           = 2022; //任务未完成
            //
            // CodeSetUserLabelLimit     = 2050;//好友不允许设置形象
            // CodeSetUserLabelSameLimit = 2051;//已添加该标签
            //
            //
            // CodeGameGoldNotEnough      = 2100;//金币不足
            // CodeGamePetCreditNotEnough = 2101;//战魂不足
            // CodeItemNotExist           = 2102;//物品不存在
            //
            // CodeGiftConfigListEmpty  = 2103;//礼物配置信息空数据
            // CodeItemUseLimit         = 2104;//物品不能直接使用
            // CodeItemCatchLimit       = 2105;//物品不能抓捕
            // CodeItemCountLimit       = 2106;//物品数量限制
            // CodeItemSellLimit        = 2107;//物品出售限制
            // CodeItemPackGirdMaxLimit = 2108;//物品背包格子数已达上限
            //
            // CodeTeamLvLargeWorldLv = 2109;//角色等级大于世界等级
            //
            // CodeFeedSendGiftLimit      = 2110;//不能对自己送礼
            // CodeFeedSendGiftCountLimit = 2111;//礼物送礼达到上限
            //
            // CodePetElfCreateError       = 2150;//宠物精灵创建失败
            // CodePetElfNotExist          = 2151;//宠物精灵不存在
            // CodePetElfFeedCountLimit    = 2152;//宠物精灵喂养次数不足
            // CodePetElfFeedByOwnerLimit  = 2153;//宠物精灵不能给自己喂养
            // CodePetElfBeFeedCountLimit  = 2154;//宠物精灵被喂养次数不足
            // CodePetElfUnFightLimit      = 2155;//对方宠物精灵未上阵
            // CodePetElfFirstDownLimit    = 2156;//宠物精灵首战不能下阵
            // CodePetElfFeedByUidLimit    = 2157;//对同个用户只能喂养一次
            // CodePetElfHatchMaxLimit     = 2158;//孵化最大上限限制
            // CodePetElfHatchNotExist     = 2159;//孵化数据不存在
            // CodePetElfMaxLimit          = 2160;//宠物精灵最大上限限制
            // CodePetElfCatching          = 2161;//宠物精灵正在抓捕中
            // CodePetElfCatchListNotExist = 2162;//抓捕宠物精灵列表中不存在该精灵
            // CodePetElfCatchUnStart      = 2163;//抓捕宠物精灵未开启
            // CodePetElfCatchTimeOut      = 2164;//抓捕宠物精灵结束(时间)
            // CodePetElfCatchCountLimit   = 2165;//抓捕宠物精灵结束(数量)
            // CodePetElfCatchOnly         = 2166;//抓捕宠物精灵中仅限抓一个
            // CodePetElfkGirdMaxLimit     = 2167;//宠物精灵格子数已达上限
            //
            // CodeFightReportTimeLimit        = 2200;//战报已过期
            // CodeFightReportCreateError      = 2201;//战报创建失败
            // CodeGameEnergyNotEnough         = 2202;//体力不足
            // CodeGameBuyEnergyCountNotEnough = 2203;//购买体力次数不足
            // CodeGameBuyGoldCountNotEnough   = 2204;//购买体力次数不足
            //
            // CodeRoomAlreadyLive             = 3000;				//已经在直播中
            // CodeRoomNotLive                 = 3001;					//未在直播
            // CodeRoomNotEnter                = 3002;				//未进入房间
            // CodeRoomNotExist                = 3003;				//房间不存在
            // CodeRoomInQueue                 = 3004;					//房间超出人数 排队
            // CodeRoomKickLevelLimit          = 3005;			//等级不够高 不能踢人
            // CodeRoomKicked                  = 3006;					//被踢出房间 10分钟内不能进入
            // CodeRoomSilenceLevelLimit       = 3007;		//等级不够高 不能禁言别人
            // CodeRoomSilence                 = 3008;					//被禁言 10分钟内不能发言
            // CodeRoomPetElfFightUserNotExist = 3009;	//宠物挑战不存在
            // CodeRoomAdminCountLimit         = 3010;			//管理员人数已满
            // CodeRoomKickLimit               = 3011;				//踢出权限不足
            // CodeRoomSilenceLimit            = 3012;				//禁言权限不足
            //
            // CodeRoomMarbleStarting               = 3013;				//星际弹珠开启中
            // CodeRoomMarbleInviteReplyTimeOut     = 3014;	//星际弹珠回复超时
            // CodeRoomMarbleInviteUserLimit        = 3015;	//星际弹珠不是邀请用户
            // CodeRoomMarbleInviteUserNotEnter     = 3016;	//星际弹珠邀请用户不在房间
            // CodeRoomMarblePenaltyNamesCountLimit = 3017;	//星际弹珠彩头数量限制
            // CodeRoomMarbleUnStart                = 3018;				//星际弹珠未开启
            //
            //
            // CodeRoomBossExist           = 3100;	//boss已存在
            // CodeRoomBossNotExist        = 3101;	//boss不存在
            // CodeRoomRainExist           = 3110;	//暴雨已存在
            // CodeRoomRainNotExist        = 3111;//暴雨不存在
            // CodeRoomPetElfNotExist      = 3112;//宠物挑战不存在
            // CodeRoomPetElfBattleHpLimit = 3113;//宠物挑战时,当前Hp限制
            //
            // CodeRoomAngelToday              = 3121;	//今天已放飞过天使
            // CodePetElfLvLargeTeamLv         = 3999;//宠物等级大于角色等级
            // CodePetElfEvolutionUidError     = 4000; //宠物进化用户id不匹配
            // CodePetElfEvolutionHighestError = 4001; //宠物进化已达到最高进阶等级
            // CodePetElfEvolutionShapeError   = 4003; //宠物进化进阶等级不匹配
            // CodePetElfEvolutionLevelError   = 4004; //宠物进化未达到进阶所需等级
            //
            // CodePetElfPromoteUidError          = 4005; //宠物升级用户id不匹配
            // CodePetElfSkillPromoteUidError     = 4006; //宠物技能升级用户id不匹配
            // CodePetElfSkillPromoteSkillIdError = 4007; //宠物技能升级技能id不匹配
            // CodePetElfSkillPromoteLevelError   = 4008; //宠物技能升级技能等级已达到最高级
            // CodePetElfGeniusUidError           = 4009; //宠物天赋解锁用户id不匹配
            // CodePetGeniusUnlockSuccess         = 4010; //宠物解锁天赋成功
            // CodePetGeniusQualityError          = 4011; //宠物天赋品质有误
            // CodePetGeniusLuckyTooLow           = 4012; //宠物幸运值太低，没有达到解锁天赋的范围
            // CodePetGeniusNotUnlock             = 4013;   //宠物没有解锁天赋
            // CodeGameSigned                     = 4014;   //当天已经签到过
            // CodeGameSignRewardFailed           = 4015; //游戏签到获取奖励失败
            // CodeGameCumulationSignRewardFailed = 4016; //游戏累计签到获取奖励失败
            // CodeGameSignUserRecordNotExist     = 4017; //用户签到记录不存在
            // CodeGameSignDayNotMatch            = 4018; //客户端签到的天数和服务器签到的天数不一致
            // CodeGameFruitOngoing               = 4019; //切水果游戏进行中
            // CodeGameFruitUnStart               = 4020; //切水果游戏未开启
            // CodeGameFruitTimeOut               = 4021;//切水果游戏结束(时间)
            // CodeGameFruitCountLimit            = 4022; //切水果游戏主播当天开启游戏次数超过限制
            // CodeGameFruitMeliAwardFailed       = 4023; //切水果游戏魅力增加失败
        }
        ;
    
    return (map[errordesc]) ? map[errordesc] : errordesc;
}
/**
 * 按钮频率次数限制,$("#btn-login").click(WST.throttle(ff, 2000));
 * @param callback 回调函数
 * @param period 多久才能点击生效一次 单位：毫秒
 * @returns {Function}
 */
WST.throttle = function (callback, period) {
    var prevTime = null;
    return function () {
        var now = Date.now();
        if (!prevTime || ((now - prevTime) > period)) {
            prevTime = now;
            callback.call(this, arguments);
        } else {
            console.log("点击频率过高了!" + period / 1000 + "秒后才能点击!");
        }
    }
}