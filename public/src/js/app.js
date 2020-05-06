var postId = 0;
var postBodyElement = null;
$(document).ready(function() {
  $('.post .interaction .Edit').click(function(event) {
  	event.preventDefault();
  	postBodyElement = event.target.parentNode.parentNode.childNodes[1];
  	var postBody = postBodyElement.textContent;
  	postId = event.target.parentNode.parentNode.dataset['postid'];
  	$('#post-body').val(postBody);
     $('#edit-modal').modal();
  });
$('#modal-save').on('click', function(){
	$.ajax({
		method: 'POST',
		url: url,
		data:{body:$('#post-body').val(),postid: postId, _token: token}
	})
	.done(function (msg){
		$('#edit-modal').modal('hide');
		 $(postBodyElement).text(msg['new_body']);
	});

});

$('.Like').click(function(event){
	event.preventDefault();
	postId = event.target.parentNode.parentNode.dataset['postid'];
	var islike = event.target.previousElementSibling == null ? true : false;
	$.ajax({
		method: 'POST',
		url:urlLike,
		data:{islike: islike,postid:postId, _token:token}

	})  
	.done(function (msg){
		debugger	});

});


})


