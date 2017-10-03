@section('navbarDetail')
active
@endsection

@extends('layouts.app')

@section('css')
	@parent
	<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/app/detail.css')}}">
@stop

@section('head_scripts')
	@parent
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@stop


@section('content')

<div class="q-main-container container">
	<div class="row">
		<div class="col-md-8 q-left-content">
			<div class="q-body-message"></div>
			<div class="q-detail-frame">
				<iframe seamless frameborder="no" allowfullscreen>
				    Ваш браузер не поддерживает плавающие фреймы!
				</iframe>
				<div class="q-frame-image" style="background-image: url({{URL::asset('public/'.$detail->preview_img)}});"></div>
				<div class="q-frame-text ">
					<div class="q-inner text-center q-h1 q-shadow-text">Оберіть параметри деталі</div>
				</div>
			</div>

			<div class="q-detail-info q-shadow">
				<div>
					<div class="pull-left q-h2">
						<span>{{$detail->name}}</span>
					</div>
					<div class="q-h3 pull-right">
						<i class="fa fa-eye q-icon" aria-hidden="true"></i>
						{{$detail->views()->count()}}

						@if(Auth::check())
							<div detail-id="{{$detail->id}}" class="q-like-button b-like-detail">							
								<i class="fa fa-heart-o q-icon" aria-hidden="true"></i> 
								<span>{{$detail->likes()->count()}}</span>
							</div>
						@else
							<i class="fa fa-heart-o q-icon" aria-hidden="true"></i> 
							<span>{{$detail->likes()->count()}}</span>
						@endif
					</div>
					<div style="clear: both;"></div>
				</div>
				<div>
					<div class="pull-left">
						Додано, <span class="q-f-5 time-ago">{{$detail->created_at}}</span>
					</div>
					<div class="pull-right">
						<a class="q-icon-link" href="#">
							<i class="fa fa-flag q-icon" aria-hidden="true"></i> Поскаржитись
						</a>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>

			<div class="q-detail-info q-shadow">
				<span class="q-h3">
					<i class="fa fa-info-circle q-icon" aria-hidden="true"></i> {{$detail->category->name}}
				</span>
				@foreach($detail->tags as $tag)
					<i class="fa fa-tag q-icon" aria-hidden="true"></i> {{$tag->name}} 
				@endforeach
			</div>

			<!--comments-->
			<div>
				@include('detail.sendForm')
				<!--hidden tempaltes-->
				@include('detail.hiddenComment')
				@include('detail.hiddenSendForm')
				<div class="q-comments">
				</div>
			</div>
		</div>
		<div class="col-md-4 q-right-content">
			<div class="q-parameters-table">
				<table>
					<thead>
						<tr>
							@foreach($detail->parameterTypes()->get() as $parameterType)
								<td>{{$parameterType->name}}, ({{$parameterType->dimention}})</td>
							@endforeach
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>						
						@foreach($detail->sculpts()->get() as $sculpt)
							<tr>
								@foreach($detail->parameterTypes()->get() as $parameterType)
									<td>
										{{
											$sculpt->parameterValues()
												->where('parameter_type_id', $parameterType->pivot->parameter_type_id)
												->first()
												->value
										}}
									</td>
								@endforeach
								<td>
									<div model-link="{{asset('public/'.$sculpt->showing_model.'?no_social')}}" class="b-render-detail q-table-button b-model-detail">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</div>
								</td>
								<td>
									<a download href="{{asset('public/'.$sculpt->showing_model.'?no_social')}}" class="q-table-button">
										<i class="fa fa-download" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
						@endforeach

					</tbody>
				</table>
			</div>
			<div class="q-detail-draw q-shadow">
				<img class="img-responsive" src="{{asset('public/'.$detail->draw_img)}}">
			</div>
		</div>	
	</div>
</div>


<script>
	
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

$('.q-parameters-table .q-table-button').click(function(){
	if ($('.q-body-message').children('.q-alert-hosting').length>0)
		return;
	
	var alertBlock = function (message){
		return '<div class="alert alert-danger q-alert-hosting" role="alert">'+message+'</div>';
	}
	var message = 'Нажаль через конфіг хостинга не вдається завантажити файл, розмір якого перевишує ліміт 2мб.';
	
	$('.q-body-message').prepend(alertBlock(message));
});

//textarea decoration
autosize($('textarea'));
$('.q-input').on('focus', function(){
	$(this).parent().addClass('q-input-line');
});

$('.q-input').on('focusout', function(){
	$(this).parent().removeClass('q-input-line');
});

function alertDanger(message){
	return '<div class="alert alert-danger">' + message + '</div>';
}

//render comment
function renderComment(commentData, parentElement){
	var commentView = $('.q-comment-template').clone();
	var createdAt = moment(commentData.created_at, "YYYYMMDD H:m:s").lang('uk').fromNow();
	//appending data to view
	commentView.find('.q-comment-text').text(commentData.text);
	commentView.find('.q-comment-username').text(commentData.user.name);
	commentView.find('.q-comment-timecreated').text(createdAt);
	commentView.find('.b-child-comments span').text(commentData.childs_count);
	commentView.find('.q-comment-likes').text(commentData.active_likes_count);
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
	var grecaptchaId = grecaptcha.render(captcha, {
		'sitekey' : mysitekey,
		'callback' : function(){
						sendForm.find('.b-send-comment')
							.removeClass('disabled')
							.unbind('click');
					}
	});
	//appending comment form to parent comment
	sendForm.removeClass('q-send-comment-template')
			.removeClass('hidden')
			.attr('g-recaptcha-id', grecaptchaId);
	comment.append(sendForm);
	//update autoresize
	autosize($('textarea'));
	$('.disabled').click(false);

	$('textarea').on('focus', function(){
		$(this).parent().addClass('q-input-line');
	});
	$('textarea').on('focusout', function(){
		$(this).parent().removeClass('q-input-line');
	});
});

//comment like
$('.q-comments').on('click', '.b-comment-like', function(){
	var countView = $(this).children('span');
	var commentId = $(this).parents('.q-comment')
					.first()
					.attr('comment-id');
	var url = '{{route("commentLike")}}';
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        /* the route pointing to the post function */
        url: url,
        type: 'POST',
        /* send the csrf-token and the input to the controller */
        data: {_token: CSRF_TOKEN, commentId: commentId},
        dataType : 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) { 
           	countView.text(data.count);
        }
    });
	
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
    if (text.val().length==0)
    	return;
    $.ajax({
        url: url,
        type: 'POST',
        data: {
        	_token: CSRF_TOKEN,
        	detail_id: {{$detail->id}}, 
        	text: text.val(),
        	grecaptcha : grecaptcha.getResponse(captchaId)
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
    commentForm.find('.alert-danger').remove();

    var commentId = commentForm.attr('comment-id');
    var commentText = commentForm.find('.q-comment-input>textarea').val();
    var parentComment = commentForm.parents('.q-comment').first();
    var recaptchaResponse = grecaptcha.getResponse(commentForm.attr('g-recaptcha-id'));
    if (commentText.length==0)
    	return;
    $.ajax({
        url: url,
        type: 'POST',
        data: {
        	_token: CSRF_TOKEN,
        	comment_id: commentId,
        	text: commentText,
        	grecaptcha : recaptchaResponse
        },
        dataType: 'JSON',
        statusCode: {
        	422 : function(data){
        		alert('something went wrong :) error 422')
        	}
        },
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

//table horline hover decoration
$('.q-table-button').hover(
	function(){
		$(this).closest('tr').children('td').css('background-color','#ffab00');
	},
	function(){
		$(this).closest('tr').children('td').css('background-color','#212121');
	}
);

//detail rendering
/*
$('.b-model-detail').click(function(){
	var detailUrl = $(this).attr('model-link');
	$('.q-detail-frame>iframe').attr('src', detailUrl);
});*/

</script>
@endsection