@if (Auth::check())
	<div style="margin-top:20px;" class="q-h3">Залишити коментар</div> 
	<div class="row q-send-comment q-send-original">
		<div class="q-left-content col-md-1">
			<img class="q-comment-avatar img-circle img-responsive" src="{{asset('public/'.'storage/avatars/avatar.jpg')}}">
		</div>
		<div class="q-right-content col-md-11">
			<div class="q-comment-input q-input-container">
				<textarea class="q-input" placeholder="Введіть ваш коментар" autocomplete="off" rows="1"></textarea>
			</div>
			<div class="q-submit-comment" style="display: none;">
				<div id="q-send-original-captcha"></div>
				<div class="blockquote-reverse">
					<div class="btn btn-primary b-send-comment disabled">
						Відправити
					</div>
				</div>	
			</div>
		</div>
	</div>
@else
	<div style="margin-top:20px;" class="q-h3 alert alert-danger">
		<i class="fa fa-exclamation-circle q-icon" aria-hidden="true"></i>
		Для того щоб залишити коментар необхідно авторизуватись
	</div>
@endif