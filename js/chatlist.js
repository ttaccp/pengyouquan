var chatlistTopDat = currentChatData[currentChatData.length - 1];
$('#chatlistbox').prepend(['<div class="line">',
  '<img src="', chatlistTopDat.head, '" class="head" />',
  '<div class="name">', chatlistTopDat.name,
  '<span class="time">08:20</span>',
  '</div>',
  '<div class="msg">', chatlistTopDat.content, '</div>',
  '</div>'].join(''));

$('#step6_toolbar').click(function () {
  $('#step6').hide();
  $("#step7")
    .fadeIn(1000)
    .load('pyq.html', function () {
      var __openid = $('body').attr('data-openid');
      var __href = $('.gotoFriendTimeLine').attr('href');
      $('.gotoFriendTimeLine').attr('href', __href + __openid);
    });
});
$('#step6 .clickTip').click(function () {
  $('#step6_toolbar').click();
});