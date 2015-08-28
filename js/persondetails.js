
setPersonDetails(selectedPersonCard);
function setPersonDetails(data){
	$('#step4_head').attr('src', data.cardHead);
	$('#step4_name').html(data.cardName + (data.woman ? '<i class="woman"></i>': '<i></i>'));
	$('#step4_nickname').html(data.cardNickName);
}

$('#personBtn').click(function(){
	$('#step4').hide();
	$("#step5")
		.fadeIn(1000)
		.load('chat.html');
});

$('#backArea').click(function(){

	$('#step4').hide();
	$("#step3").show();
});
