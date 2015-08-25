// ===============step1========================
var Msg = (function(window, $){
	
	var count = 0;
	var fn_addDom = function(){
		$('#msglist').append(['<div class="msg">',
								'<img src="../img/msg1.png" class="img" />',
							'</div>'].join(''));
		setTimeout(function(){
			$('#msglist .msg:last').addClass('show');
			count++
			
			if(count < 3){
				fn_addDom();
			}
		}, 800);
	}
	
	var self = {
		start: function(){
			fn_addDom()
		}
	};
	
	return self;
	
})(window, $);

var startX = 0;
var hammertime = new Hammer(document.getElementById("text"));
hammertime.on("panstart panend", function (ev) {
	var x = ev.deltaX;
	if(ev.type == 'panstart'){
		startX = x;
	} else {
		if((x - startX) > 30){
			$('#step1').hide();
			$('#step2').show();
		}
	}
});
//$('#step1').hide();
//$('#step2').show();

// ===============step2========================
$('#numlist .num').live('click', function(){
	var self = $(this),
		val = self.attr('_val'),
		num = $('#numbox [_val="' + val + '"]'),
		topnumVal = num.attr('_val');
	
	if(num.length > 0){
		var pre = num.prev();
		if(pre.length > 0 && pre.hasClass('cur') && val == topnumVal){
			num.addClass('cur')
		} else if(pre.length == 0 && val == topnumVal){
			num.addClass('cur')
		} else {
			clearNumSelected();
		}
	} else {
		clearNumSelected();
	}
	
	if($('#numbox .num:last').hasClass('cur')){
		console.log('next');
	}
});

function clearNumSelected(){
	
	$('#numbox .num').removeClass('cur');
	var count = 0,
		temp = ['-30px', '30px', '-30px', '30px'];
		
	animate();

	function animate(){
		
		$('#numbox')
		.stop()
		.animate({
			'margin-left': temp[count]
		}, 80, function(){
			if(temp.length > ++count){
				animate();
			}
		});
	}
}








