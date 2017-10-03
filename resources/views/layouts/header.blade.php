<nav id="q-navbar" class="navbar navbar-fixed-top q-navbar-small">
	<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
			</button>
			<a class="navbar-brand q-navbar-brand" href="{{route('home')}}">WebCAD</a>
		</div>

		<!-- login/registration -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav q-navbar-nav navbar-nav q-navbar-left">
				<li class="@yield('navbarHome')"><a href="{{route('home')}}">Головна <span class="sr-only">(current)</span></a></li>
				<li class="@yield('navbarDetail')"><a href="http://webcad.tk#q-details-table">Деталі</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right q-navbar-right q-navbar-nav">
				<!-- Authentication Links -->
				@if (Auth::guest())
				<li><a href="{{ route('login') }}">Login</a></li>
				<li><a href="{{ route('register') }}">Register</a></li>
				@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					<i class="fa fa-user-circle-o" aria-hidden="true"></i>{{Auth::user()->name}}<span class="caret"></span>
					</a>

					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="{{ route('logout') }}"
							onclick="event.preventDefault();
							 document.getElementById('logout-form').submit();">
							Logout
							<i class="fa fa-sign-out" aria-hidden="true"></i>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
							</form>
						</li>						
					</ul>
				</li>
				@endif
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-->
</nav>