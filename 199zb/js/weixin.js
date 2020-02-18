//<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    var dataUrl = {url:window.location.href.split('#')[0]};
    console.log(dataUrl);
    var Share = {
            title: '测一测:你值多少钱？当月嫂/育儿嫂拿多少钱月薪',
            link: 'http://m.mumway.com/testAunt/index.html?sfrom_openid=',
            desc: '做试卷测水平，看一看你值多少月薪。完成《521科学月嫂育儿嫂挑战》奖521元',
            imgUrl: 'http://m.mumway.com/Public/ke/images/fenx.png',
            type: 'link',
            dataUrl: '',
            success: function () { 
                    console.log('分享ok');
                    },
            cancel: function () { 
                // 用户取消分享后执行的回调函数
                  console.log('分享null');
            }
        };
    // ajax请求
     function diaoaj(){
        $.ajax({
             url: 'http://m.mumway.com/wxshell.php?url='+dataUrl.url,
                dataType: 'JSON',
                type:'get',
                success: function(_data){
                    console.log(_data);
                    weixindiao(_data);
                }
        })
    }

    
    // 调用分享方法
    function weixindiao(_data){
        wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。false/true
            appId: _data.appId, // 必填，公众号的唯一标识
            timestamp: _data.timestamp, // 必填，生成签名的时间戳
            nonceStr: _data.nonceStr, // 必填，生成签名的随机串
            signature: _data.signature,// 必填，签名，见附录1
            jsApiList: [
				'hideMenuItems',
                'onMenuShareTimeline',
                ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function(){
                console.log('验证成功！');
                wx.onMenuShareTimeline(Share);
                wx.onMenuShareAppMessage(Share);
                wx.onMenuShareQQ(Share);
                wx.onMenuShareWeibo(Share);
                wx.onMenuShareQZone(Share);
				//wx.hideOptionMenu();
                //wx.hideAllNonBaseMenuItem();
              //批量隐藏功能按钮接口'menuItem:favorite',
        		wx.hideMenuItems({
        			menuList: [
        			    "menuItem:copyUrl",'menuItem:share:appMessage',
        				'menuItem:share:qq','menuItem:share:weiboApp','menuItem:share:QZone',
        				"menuItem:originPage","menuItem:readMode","menuItem:openWithQQBrowser",
        				"menuItem:openWithSafari","menuItem:share:email","menuItem:share:brand"
        				
        			] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
        		});
            // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
        });


        wx.error(function(res){
            console.log(res);
            console.log('验证失败');
        //config信息验证失败会执行error函数，如签名过期导致验证失败，
        //具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，
        //对于SPA可以在这里更新签名。

        });


    }