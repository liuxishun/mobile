$(function() {
	
	// 菜单 
	var menu = $('#menu');
	var nav = $('#D1_nav');
	var bgg = $('#bgg');
function caidan() {
	
	menu.click(function(e) {
        bgg.show();
		yans();
		
	});

}
caidan();
$('.bgg').mouseup(function(e){
	    var _con = nav.find('.navCn');   // 设置目标区域
	    if(!_con.is(e.target) && _con.has(e.target).length === 0){ // Mark 1
	      _con.css({'left':' -440px'});
		  yans1();
		  bgg.fadeOut(1500);
	   }
	});	

function yans() {
		setTimeout(function() {
			nav.css({'left':' '+ 0 +'px'});
			
		},100)
	}
function yans1() {
		setTimeout(function() {
			nav.css({'left':' -440px'});
			
		},100)
	}

	function tiehuan(obj) {
		obj.on('click','li',function() {
			var liback = obj.find('li[class="back"]');
			if (liback.length >= 3) {
				alert('最多选 '+ 3 +' 项！');
				liback.eq(2).removeClass('back');
			}else{
				$(this).toggleClass('back');
				$(this).attr('data','ba1');

			}
			

		})

	}
	tiehuan($('.D3_ysYsLs'));
	tiehuan($('.D3_Xb'));
	function xuanxi(obj) {
		obj.on('click','li',function() {
			obj.find('li').removeClass('back');
			$(this).addClass('back');
			
		})

	}
	xuanxi($('#D3_Rentn'));
	xuanxi($('#D3_Rent'));
	xuanxi($('.D3_lei'));

	function qiehuan() {
		var con3 = $(".D4_nav");
		con3.on('click','li',function() {
			con3.find('a').removeClass('active');
			$(this).find('a').addClass('active');
		})
	}
	qiehuan();

	function openFied() {
		var D1_fiexT = $('#D1_fiexT');
		var gubi    = D1_fiexT.find('#D1_guanbi');
		var open    = $('#openD1_fiexT');

			open.click(function() {
				D1_fiexT.show();
			})
			gubi.click(function() {
				D1_fiexT.hide();
			})
	}
	openFied();



	//caryd();
			
	// function caryd() {
	// 	var qdX = 0, ydX = 0,zdX = 0;     
	// 	document.addEventListener('touchstart', function(event) {
	//      // 如果这个元素的位置内只有一个手指的话
	//     if (event.targetTouches.length == 1) {
	// 　　　　 event.preventDefault();// 阻止浏览器默认事件，重要 
	//         var touch = event.targetTouches[0];
	//         // 把元素放在手指所在的位置
	//         qdX = touch.pageX;
	//         }
	//         //console.log('qdX:'+qdX);
	// 	}, false);
	// 	document.addEventListener('touchmove', function(event){
	// 		var touch = event.targetTouches[0];
 //        	ydX = touch.pageX;

 //        	//console.log('ydX:'+ydX);
 //        });

 //        document.addEventListener('touchend', function(){
			
 //        	zdX = ydX - qdX;
 //        	var ss = 0

 //        	if (zdX >= 100) {
 //        		yans(-444);
 //        		console.log('0')
 //        	}
 //        	 if(zdX <= -100){
 //        		yans(0);

 //        		console.log('1')

 //        	};

 //        	console.log('zdX:'+ zdX);
 //        })
	// }
	




});