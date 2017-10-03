$('.disabled').click(false);
//captcha variables
var mysitekey = '6LcOqTIUAAAAALhHbv80mcLMhgJbZcoEpiTG6Gju';
var captchaId;

//captcha script load callback
var onloadCallback = function() {
	captchaId = grecaptcha.render('q-send-original-captcha', {
	'sitekey' : mysitekey,
	'callback' : function(){
					$('.q-send-original')
						.find('.b-send-comment')
						.removeClass('disabled');
				}
	});
};

//textarea decoration
autosize($('textarea'));
$('textarea').on('focus', function(){
	$(this).parent().addClass('q-input-decoration');
});

$('textarea').on('focusout', function(){
	$(this).parent().removeClass('q-input-decoration');
});

//render comment
function renderComment(commentData, parentElement){
	var commentView = $('.q-comment-template').clone();
	var createdAt = moment(commentData.created_at, "YYYYMMDD H:m:s").lang('uk').fromNow();
	//appending data to view
	commentView.find('.q-comment-text').text(commentData.text);
	commentView.find('.q-comment-username').text(commentData.user.name);
	commentView.find('.q-comment-timecreated').text(createdAt);
	commentView.find('.b-child-comments span').text(commentData.childs_count);
	//append view to its parent element
	if(commentData.parent_id!=null)
		commentView.children('.q-comment-inner')
					.addClass('col-md-offset-1');
	commentView.attr('comment-id', commentData.id)
	commentView.removeClass('q-comment-template')
				.removeClass('hidden')
				.appendTo(parentElement);
}

//hide&show comment form submit
$('.q-send-original .q-comment-input>textarea').on('input propertychange', function(){
	var submit = $(this).parents('.q-right-content')
						.first()
						.children('.q-submit-comment');
	if (this.value.length){
		//make send btn disable
		submit.find('.b-send-comment').addClass('disabled');
		//reset recaptcha
		grecaptcha.reset(captchaId);
		submit.show("slow");
	}
	else
		submit.hide("slow");
});

//add send comment form
$('.q-comments').on('click', '.b-add-comment', function(){
	var comment = $(this).parents('.q-comment').first();
	//cheif if comment has alredy sending form
	if(comment.children('.q-send-comment').length>0){
		//delete if has
		comment.children('.q-send-comment').remove();
		return;
	}
	//gettting template of comment form
	var sendForm = $('.q-send-comment-template').clone();
	//setting comment id
	sendForm.attr('comment-id', comment.attr('comment-id'));
	//adding captcha
	var captcha = sendForm.find('.q-send-template-captcha').get(0);
	grecaptcha.render(captcha, {
		'sitekey' : mysitekey,
		'callback' : function(){
						sendForm.find('.b-send-comment')
							.removeClass('disabled');
					}
	});	
	//appending comment form to parent comment
	sendForm.removeClass('q-send-comment-template')
			.removeClass('hidden');
	comment.append(sendForm);
	//update autoresize
	autosize($('textarea'));
});
//cancel sending comment
$('.q-comments').on('click', '.b-cancel-comment', function(){
	$(this).parents('.q-send-comment').first().remove();
});

//show child comments
$('.q-comments').on('click', '.b-child-comments', function(){
	var parent = $(this).parents('.q-comment').first();
	var childs = $(parent).children('.q-comment');
	// if childs are alredy shown, remove them
	if (childs.length){
		childs.remove();
		return;
	}

	var parentId = $(parent).attr('comment-id');

	var url = '{{URL::to('/')}}/comment/'+parentId+'/childs';

	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'JSON',
		success: function(childs){
			childs.forEach(function(child){
				renderComment(child, parent);
			});
		}
	});
});

//add detail like
$('.b-like-detail').click(function(){
	var countView = $(this).children('span');
	var url = '{{route("detailLike")}}';
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        /* the route pointing to the post function */
        url: url,
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {_token: CSRF_TOKEN, detailId: {{$detail->id}}},
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) { 
           countView.text(data.count);
        }
    });
});

//add new comment
$('.b-send-comment').click(function(){
	var url = '{{route("addDetailComment")}}';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var text = $('.q-send-original').find('.q-comment-input>textarea');
    var submit = $(this).parents('.q-submit-comment').first();

    $.ajax({
        url: url,
        type: 'POST',
        data: {
        	_token: CSRF_TOKEN,
        	detail_id: {{$detail->id}}, 
        	text: text.val()
        },
        dataType: 'JSON',
        success: function (data) {
        	text.val('');
        	submit.hide();
        	renderComment(data, $('.q-comments'));
        }
    }); 
});

//add new child comment
$('.q-comments').on('click', '.b-send-comment', function(){

	var url = '{{route("addChildComment")}}';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var commentForm = $(this).parents('.q-send-comment').first();

    var commentId = commentForm.attr('comment-id');
    var commentText = commentForm.find('.q-comment-input>textarea').val();
    var parentComment = commentForm.parents('.q-comment').first();

    $.ajax({
        url: url,
        type: 'POST',
        data: {
        	_token: CSRF_TOKEN,
        	comment_id: commentId,
        	text: commentText
        },
        dataType: 'JSON',
        success: function (data) {
        	commentForm.remove();
			renderComment(data, parentComment);
        }
    }); 
});

$(document).ready(function(){
	//format all times
	moment.locale('uk');
	$('.time-ago').each(function(){
		var time = $(this).text();
		var format = 'YYYY-MM-DD H:m:s';
		var convertedTime = moment(time, format).fromNow();
		$(this).text(convertedTime);
	});
	//loading all comments for curr detail
	$.ajax({
		type: 'GET',
		url: "{{route('allDetailComments', $detail->id)}}",
		dataType: 'JSON',
		success: function(comments){
			comments.forEach(function(comment){
				renderComment(comment, $('.q-comments'));
			});
		}
	});
});

////////////////////////////////////////////////


$('.q-model-btn').hover(
	function(){
		$(this).closest('tr').children('td').css('background-color','red');
	},
	function(){
		$(this).closest('tr').children('td').css('background-color','#212121');
	}
);



$('.render-detail').click(function(){
	var detailUrl = $(this).attr('model-link');
	$('iframe').attr('src', detailUrl);
});