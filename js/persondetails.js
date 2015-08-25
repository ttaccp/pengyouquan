
setPersonDetails(selectedPersonCard);
function setPersonDetails(data){
	$('#step4_head').attr('src', data.cardHead);
	$('#step4_name').html(data.cardName + '<i></i>');
	$('#step4_nickname').html('昵称：' + data.cardNickName);
}