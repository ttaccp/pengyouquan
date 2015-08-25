showchat('#chatlist .msgline:first-child');

$('#input').click(function(){
	$(this).hide();
	$('#input2').fadeIn(500);
});

$('#input2').click(function(){
	
	$(this).hide();
	$('#input')
		.fadeIn(500)
		.unbind('click');
	
	$('#chatlist')
		.append(['<div class="msgline me">',
			'<img src="../img/head.png" class="head" />',
			'<div class="msgcontent">我知道他们！他们可是很厉害的人物！好想认识他们！</div>',
		'</div>'].join(''));
		
	$(document).scrollTop(9999999);
	showchat('#chatlist .msgline:last-child');
	
});

function showchat(id){
	setTimeout(function(){
		$(id).addClass('show');
	}, 500);
}
