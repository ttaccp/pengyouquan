console.log(currentChatData);
var chatlistTopDat = currentChatData[currentChatData.length - 1];
$('#chatlistbox').prepend(['<div class="line">',
								'<img src="', chatlistTopDat.head,'" class="head" />',
								'<div class="name">', chatlistTopDat.name,
									'<span class="time">08:20</span>',
								'</div>',
								'<div class="msg">', chatlistTopDat.content,'</div>',
							'</div>'].join(''));
