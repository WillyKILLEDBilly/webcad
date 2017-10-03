<div class="q-table-cell-wrapper col-md-4">
	<div class="q-table-cell q-shadow">
		<div class="q-detail-info">
			<div class="q-info-left">
				<span class="q-h4">
					<i class="fa fa-info-circle q-icon" aria-hidden="true"></i> {{$detail->category->name}}
				</span>
			</div>
			<div class="q-info-right">
			 додано <span class="q-f-5 time-ago">{{$detail->created_at}}</span>
			</div>
			<div style="clear: both;"></div>
		</div>
		<a href="{{route('detail',$detail->link_name)}}">
			<div class="q-background-wrapper">
				<div style="background-image: url({{URL::asset('public/'.$detail->preview_img)}})" class="q-datail-background">
				</div>
				<div class="q-background-loop text-center">
					<div class="q-loop-inner">
						<i class="fa-2x fa fa-search" aria-hidden="true"></i>
					</div>
				</div>
			</div>

		</a>
		<div class="q-detail-info">
			<div class="q-info-left">
				{{$detail->name}}
			</div>
			<div class="q-info-right">
				<i class="fa fa-eye q-icon" aria-hidden="true"></i> {{$detail->views()->count()}}
				<i class="fa fa-heart q-icon" aria-hidden="true"></i> {{$detail->likes()->count()}}
				<i class="fa fa-comments q-icon" aria-hidden="true"></i> {{$detail->comments()->count()}}
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
</div>