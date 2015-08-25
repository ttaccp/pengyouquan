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
		
	
	showchat('#chatlist .msgline:last-child', addchat);	
});

function showchat(id, callback){
	setTimeout(function(){
		$(id).addClass('show');
		if(callback){
			setTimeout(callback, 500);
		}
	}, 50);
	
	if(callback){
		$(document).scrollTop(99999);
	}
}
var chatDataList = [];
chatDataList.push({
	type: 'msg',
	head: '../img/head10.png',
	name: 'c同学',
	content: '哈哈！你们真想认识他们？我有他们的微信号！你们可以自己添加5位大趴导师，和他们聊聊！'
});
chatDataList.push({
	type: 'card',
	head: '../img/head10.png',
	name: 'c同学',
	cardHead: '../img/head6.png',
	cardName: 'Terrence',
	cardNickName: 'Terrence'
});
chatDataList.push({
	type: 'card',
	head: '../img/head10.png',
	name: 'c同学',
	cardHead: '../img/head1.png',
	cardName: '梁捷',
	cardNickName: '梁捷'
});
chatDataList.push({
	type: 'card',
	head: '../img/head10.png',
	name: 'c同学',
	cardHead: '../img/head3.png',
	cardName: 'Pascal',
	cardNickName: 'Pascal'
});
chatDataList.push({
	type: 'card',
	head: '../img/head10.png',
	name: 'c同学',
	cardHead: '../img/head11.png',
	cardName: 'Jaimie',
	cardNickName: 'Jaimie'
});
chatDataList.push({
	type: 'card',
	head: '../img/head10.png',
	name: 'c同学',
	cardHead: '../img/head2.png',
	cardName: '潘清',
	cardNickName: '潘清'
});
var addchatIndex = 0;
function addchat(){
	
	if(chatDataList.length > addchatIndex){
		var data = chatDataList[addchatIndex];
		if(data.type == 'msg'){
			$('#chatlist')
				.append(['<div class="msgline">',
					'<img src="', data.head,'" class="head" />',
					'<div class="name">', data.name,'</div>',
					'<div class="msgcontent">', data.content,'</div>',
				'</div>'].join(''));
		} else if(data.type == 'card'){
			$('#chatlist')
				.append(['<div class="msgline">',
					'<img src="', data.head,'" class="head" />',
					'<div class="name">', data.name,'</div>',
					'<div class="msgcontent">',
						'<div class="tl">名片</div>',
						'<img src="', data.cardHead,'" class="c_head" />',
						'<div class="c_name">', data.cardName,'</div>',
						'<div class="c_nick">昵称：', data.cardNickName,'</div>',
					,'</div>',
				'</div>'].join(''));
		}
		
		addchatIndex++
		showchat('#chatlist .msgline:last-child', addchat);
	}
}
