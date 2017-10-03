<!--hidden comment template-->
<div class="q-comment-template hidden q-comment row">
	<div class="q-comment-inner">
		<div class="q-comment-header">
			<span class="q-comment-username"></span>, 
			<span class="q-comment-timecreated"></span>
		</div>
		<div class="q-comment-content">
			<div class="col-md-1 q-left-content">
				<img class="q-comment-avatar img-circle img-responsive" src="{{asset('public/storage/avatars/avatar.jpg')}}">
			</div>
			<div class="col-md-11 q-right-content">
				<div class="q-comment-text q-shadow" >
				</div>
				<div class="q-comment-btns q-h5">
					@if(Auth::check())
						<div class="b-comment-like q-icon-button">
							<i class="q-icon q-icon-button fa fa-heart-o fa-fw" aria-hidden="true"></i>
							 <span class="q-comment-likes"></span>
						</div>
						<div class="b-child-comments q-icon-button ">
							<i class="q-icon q-icon-button  fa fa-comments fa-fw" aria-hidden="true"></i>
							<span></span>
						</div>
						<div comment-id="{{$detail->id}}" class="b-add-comment q-icon-button">
							<i class="q-icon fa fa-commenting fa-fw" aria-hidden="true"></i>
						</div>
					@else
						<i class="q-icon q-icon-button fa fa-heart-o fa-fw" aria-hidden="true"></i>
						<span class="q-comment-likes"></span>

						<div class="b-child-comments q-icon-button ">
							<i class="q-icon q-icon-button  fa fa-comments fa-fw" aria-hidden="true"></i>
							<span></span>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>			
</div>