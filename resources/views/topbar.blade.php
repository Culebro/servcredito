<div class='page-topbar '>
	<div class='logo-area'>

	</div>
	<div class='quick-area'>
		<div class='pull-left'>
			<ul class="info-menu left-links list-inline list-unstyled">
				<li class="sidebar-toggle-wrap">
					<a href="#" data-toggle="sidebar" class="sidebar_toggle">
						<i class="fa fa-bars"></i>
					</a>
				</li>
				<li class="">
					<a href="#" data-toggle="dropdown" class="toggle">
						<i class="fa fa-bell"></i>
						<span class="badge badge-orange">0</span>
					</a>
					<ul class="dropdown-menu notifications animated fadeIn">
						<li class="total">
							<span class="small">
								Tienes <strong>0</strong> nuevas notificaciones.
								<a href=" " class="pull-right">Marcar como leidas</a>
							</span>
						</li>
						<li class="list">

							<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
							</ul>

						</li>

						<li class="external">
							<a href=" ">
								<span>Leer todas la Notificaciones</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<div class='pull-right'>
			<ul class="info-menu right-links list-inline list-unstyled">
				<li class="profile">
					<a href="#" data-toggle="dropdown" class="toggle">
						<img src="data/profile/profile.png" alt="user-image" class="img-circle img-inline">
						<span>{{ Auth::user()->name }}<i class="fa fa-angle-down"></i></span>
					</a>
					<ul class="dropdown-menu profile animated fadeIn">
						<!--
						<li>
							<a href="#settings">
								<i class="fa fa-wrench"></i>
								Settings
							</a>
						</li>
						<li>
							<a href="#profile">
								<i class="fa fa-user"></i>
								Profile
							</a>
						</li>
						<li>
							<a href="#help">
								<i class="fa fa-info"></i>
								Help
							</a>
						</li>
						-->
						<li class="last">
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<i class="fa fa-lock"></i>
								Cerrar Sesi&oacute;n
							</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
					</ul>
				</li>

				<li class="chat-toggle-wrapper">
					<a href="#" data-toggle="chatbar" class="toggle_chat">
						<i class="fa fa-comments"></i>
						<span class="badge badge-warning">0</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>