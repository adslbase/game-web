$(function () {
        gamechange();
        $("#Submit1").click( function () {
                if (checkserver() && validateaccount() && checkEMail() && checkgoldnum() ) {
                        //ajax不能返回值checkaccount
                        var areaid = $("#selectserver").val();
                        var account = $("#account").val();
                        if (areaid != 0 && account != '') {
                                $.ajax({
                                        url: "../Services/checkpayname.html?t=" + (new Date()).getTime(),
                                        dataType: "json",
                                        async:false,
                                        data: {
                                                gameid: $('input[name="gameid"]').val(), 
                                                server: $("#selectserver").val(), 
                                                account: encodeURI($("#account").val())
                                        },
                                        success: function (da) {
                                                if (da.state == 0 || da.state == 11) {
                                                        $("#accountTip").html("&nbsp;").attr("class", "onCorrect");
                                                        if (da.state == 11) {
                                                                $("#trEmail,#trEmailTip").show();
                                                                $("#email").val("");
                                                        }
                                                        else {
                                                                $("#trEmail,#trEmailTip").hide();
                                                                $("#email").val(da.data);
                                                        }
                                                        $("#payform").submit();
                                                } else {
                                                        $("#accountTip").html(da.message).attr("class", "onError");
                                                }
                                        }
                                });
                        }
                }
        });
        //选择游戏下拉列表
        jQuery(".selectGame").click(function () {
                var jumplist = jQuery(".jumplist").css("display");
                if (jumplist == "none") {
                        jQuery(".jumplist").slideDown().css("display", "block");
                        jQuery(this).css("background-position", "184px -94px");
                } else if (jumplist == "block") {
                        jQuery(".jumplist").slideUp().css("display", "none");
                        jQuery(this).css("background-position", "184px -70px");
                }
        });
        //下拉游戏列表鼠标移上去变色
        jQuery(".selectBox span").hover(
                function () {
                        jQuery(this).addClass("bg");
                },
                function () {
                        jQuery(this).removeClass("bg");
                }
                );

        jQuery(".selectBox span").click(function () {
                jQuery(".selectGame").empty();
                jQuery(this).clone().prependTo(".selectGame");
                jQuery(".jumplist").css("display", "none");
                jQuery(".selectGame").css("background-position", "184px -70px");
                var gameid = jQuery(this).find('img').attr('gameid');
                var gamename = $.trim(jQuery(this).find('img').parent().text());
                jQuery('input[name="gameid"]').val(gameid);
                jQuery('input[name="gamename"]').val(gamename);
                gamechange();
        });



        $("#selectserver").bind("change", function () {
                areachange();
        });

        $("#account").bind("blur", function () {
                if (validateaccount()) {
                        checkaccount();
                }
        })

        $("#othermoney").bind("keyup", function () {
                if (/^[0-9]*[1-9][0-9]*$/.test(this.value)) {
                        $("#selectmoney").val(0);
                        $("#goldnum").val(parseInt(this.value * parseFloat($("#spRate").text(), 10), 10));
                        $("#othermoneyTip").html("&nbsp;").attr("class", "onCorrect");
                } else {
                        $("#othermoney").val("");
                        $("#goldnum").val("");
                }
        }).bind("blur", function () {
                if ($("#goldnum").val() == '') {
                        $("#selectmoneyTip").html("请选择充值金额！").attr("class", "onError");
                } else {
                        $("#selectmoneyTip").html("&nbsp;").attr("class", "onCorrect");
                }
        });
        $("#selectmoney").bind("change", function () {
                if (this.value != 0) {
                        $("#othermoney").val("");
                        $("#goldnum").val(parseInt(this.value * parseFloat($("#spRate").text(), 10), 10));
                        $("#selectmoneyTip").html("&nbsp;").attr("class", "onCorrect");
                } else {
                        $("#selectmoneyTip").html("请选择充值金额！").attr("class", "onError");
                }
        });
        
        $("#email").bind("blur", function () {
                checkEMail();
        });

});


function gamechange() {
        var gameid = $('input[name="gameid"]').val();
        var serverid = getQueryString("server");
        $("#selectserver").empty();
        changePayWayLink();
        gameExchangeUnit(gameid);
        $.ajax({
                url: "../Services/server.html?t=" + (new Date()).getTime(),
                dataType: "json",
                data: {
                        gameid: gameid
                },
                success: function (da) {
                        $("#selectserver").prepend("<option value='0'>请选择服务器</option>");
                        if (da != '') {
                                $.each(da, function () {
                                        $("#selectserver").append("<option value='" + this.object_id + "'>" + this.object_name + "</option>");
                                });
                                if (serverid) {
                                        $("#selectserver").val(serverid);
                                        $("#servername").val($("#selectserver option:selected").text());
                                }
                        }
                        areachange();
                }
        });
}

function gameExchangeUnit(gameId) {
        var paywayid = getQueryString("payway");
        if (!paywayid)
                paywayid = "";
        $.ajax({
                type: "GET",
                url: "../Services/gamemoney.html?t=" + (new Date()).getTime(),
                dataType: "json",
                data: {
                        gameid: gameId, 
                        payway: paywayid
                },
                success: function (data) {
        
                        $("#spUnit").text(data.unit);
                        $("#spRate").text(data.rate);
                        $("#selectmoney").val(0);
                        $("#othermoney").val("");
                        $("#goldnum").val("");
       
                }
        });
}


function areachange() {
        var gameid = $('input[name="gameid"]').val();
        var areaid = $("#selectserver").val();
        var account = $("#account").val();
        if (account == '') {
                account = $("#account").text();
        }
        if (areaid == 0) {
                $("#selectserverTip").html("请选择区服！").attr("class", "onError");
                return;
        } else {
                $("#selectserverTip").html("&nbsp;").attr("class", "onCorrect");
                $("#servername").val($("#selectserver option:selected").text());
                changePayWayLink();
        }
        if (account == '') {
                $("#accountTip").html("请输入账号！").attr("class", "onError");
                return;
        }
        $.ajax({
                url: "../Services/checkpayname.html?t=" + (new Date()).getTime(),
                dataType: "json",
                data: {
                        gameid: gameid, 
                        server: areaid, 
                        account: encodeURI(account)
                },
                success: function (da) {
                        if (da.state == 0 || da.state == 11) {
                                $("#accountTip").html("&nbsp;").attr("class", "onCorrect");
                                if (da.state == 11) {
                                        $("#trEmail,#trEmailTip").show();
                                        $("#email").val("");
                                }
                                else {
                                        $("#trEmail,#trEmailTip").hide();
                                        $("#email").val(da.data);
                                }
                        } else {
                                $("#accountTip").html(da.message).attr("class", "onError");
                        }
                }
        });
}

function changePayWayLink() {
        var gameid = $('input[name="gameid"]').val();
        var serverid = $("#selectserver").val();
        var url = "";
        $(".payway li a").each(function () {
                var _this = this;
                var way = $(_this).attr("class");
                var paywayId = way.replace("way_", "");
                url = "game.html?gameid=" + gameid + "&payway=" + paywayId;
                if (serverid)
                        url = url + "&server=" + serverid;
                $(_this).attr("href", url);
        });
}





function checkaccount() {       
        var areaid = $("#selectserver").val();
        var account = $("#account").val();
        if (areaid != 0 && account != '') {
                $.ajax({
                        url: "../Services/checkpayname.html?t=" + (new Date()).getTime(),
                        dataType: "json",
                        async:false,
                        data: {
                                gameid: $('input[name="gameid"]').val(), 
                                server: $("#selectserver").val(), 
                                account: encodeURI($("#account").val())
                        },
                        success: function (da) {
                                if (da.state == 0 || da.state == 11) {
                                        $("#accountTip").html("&nbsp;").attr("class", "onCorrect");
                                        if (da.state == 11) {
                                                $("#trEmail,#trEmailTip").show();
                                                $("#email").val("");
                                        }
                                        else {
                                                $("#trEmail,#trEmailTip").hide();
                                                $("#email").val(da.data);
                                        }
                                } else {
                                        $("#accountTip").html(da.message).attr("class", "onError");
                                }
                        }
                });
        }
}

function checkserver() {
        var server = $("#selectserver").val();
        if (server == 0) {
                $("#selectserverTip").html("请选择区服！").attr("class", "onError");
                $("#selectserver").focus();
                return false;
        }
        return true;
}

function validateaccount() {
        var areaid = $("#selectserver").val();
        var account = $("#account").val();
        var statu = false;
        if (areaid == 0) {
                $("#selectserverTip").html("请选择区服！").attr("class", "onError");
                $("#selectserver").focus();
                return false;
        }
        $("#servername").val($("#selectserver option:selected").text());
        if (account == '') {
                $("#accountTip").html("请输入账号！").attr("class", "onError");
                $("#account").focus();
                return false;
        }
        return true;
}

function checkEMail() {
        if (!$("#trEmail").is(":hidden")) {
                var email = $("#email").val();
                if (email == '') {
                        $("#emailTip").html("请输入邮箱！").removeClass("onShow").addClass("onError");
                        $("#email").focus();
                        return false;
                } else {
                        var reg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                        if (!reg.test(email)) {
                                $("#emailTip").html("你输入的邮箱格式不正确！").removeClass("onShow").addClass("onError");
                                $("#email").focus();
                                return false;
                        }
                        else {
                                $("#emailTip").html("&nbsp;").removeClass("onError").addClass("onCorrect");
                        }
                }
        }
        return true;
}

function checkgoldnum() {
        if ($("#goldnum").val() == '' || ($("#selectmoney").val() == '' && $("#othermoney").val() == '')) {
                $("#selectmoneyTip").html("请选择充值金额！").attr("class", "onError");
                $("#selectmoney").focus();
                return false;
        }
        return true;
}

