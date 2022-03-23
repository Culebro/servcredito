<div class="page-sidebar ">


    <!-- MAIN MENU - START -->
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">

        <!-- USER INFO - START -->
        <div class="profile-info row">

            <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                <a href="ui-profile.html">
                    <img src="data/profile/profile.png" class="img-responsive img-circle">
                </a>
            </div>

            <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                <h3>
                    <a href="ui-profile.html">{{ Auth::user()->name }}</a>

                    <!-- Available statuses: online, idle, busy, away and offline -->
                    <span class="profile-status online"></span>
                </h3>

                <p class="profile-title">{{ Auth::user()->email }}</p>

            </div>

        </div>
        <!-- USER INFO - END -->

        <ul class='wraplist'>

            <li class="<?=$menu=='home'?'open opened':''?>">
                <a href="home" class="">
                    <i class="fa fa-tachometer-alt"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="<?=$menu=='creditos'?'open opened':''?>">
                <a href="javascript:;">
                    <i class="fa fa-credit-card"></i>
                    <span class="title">Cr&eacute;ditos</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" >
                    <li class="">
                        <a class="<?=$submenu=='solicitudes'?'selected':''?>" href="solicitudes">Solicitudes</a>
                    </li>
                    <li class="">
                        <a class="<?=$submenu=='aprobaciones'?'selected':''?>" href="aprobaciones">Aprobaciones</a>
                    </li>
                </ul>
            </li>
            <li class="<?=$menu=='cobranza'?'open opened':''?>">
                <a href="javascript:;">
                    <i class="fa fa-calculator"></i>
                    <span class="title">Cobranza</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" >
                    <li class="">
                        <a class="<?=$submenu=='abonos'?'selected':''?>" href="abonos">Caja</a>
                    </li>
                    <li class="">
                        <a class="<?=$submenu=='rutas'?'selected':''?>" href="rutas">Monitor de rutas</a>
                    </li>
                </ul>
            </li>
            <li class="<?=$menu=='catalogos'?'open opened':''?>">
                <a href="javascript:;">
                    <i class="fa fa-table"></i>
                    <span class="title">Catalogos</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" >
                    <li class="">
                        <a class="<?=$submenu=='catclientes'?'selected':''?>" href="catclientes">Clientes</a>
                    </li>
                    <li class="">
                        <a class="<?=$submenu=='catpersonal'?'selected':''?>" href="catpersonal">Personal</a>
                    </li>
                    <li class="">
                        <a class="<?=$submenu=='catproductos'?'selected':''?>" href="catproductos">Productos Financieros</a>
                    </li>
                </ul>
            </li>
            <li class="<?=$menu=='reportes'?'open opened':''?>">
                <a href="javascript:;">
                    <i class="fa fa-chart-line"></i>
                    <span class="title">Reportes</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" >
                    <li class="">
                        <a class="<?=$submenu=='repcreditos'?'selected':''?>" href="repcreditos">Cr&eacute;ditos</a>
                    </li>
                    <li class="">
                        <a class="<?=$submenu=='repcxc'?'selected':''?>" href="repcxc">Cuentas X Cobrar</a>
                    </li>
                    <li class="">
                        <a class="<?=$submenu=='repfinanzas'?'selected':''?>" href="repfinanzas">Finanzas</a>
                    </li>
                    <li class="">
                        <a class="<?=$submenu=='repclientes'?'selected':''?>" href="repclientes">Clientes</a>
                    </li>
                    <li class="">
                        <a class="<?=$submenu=='repcobranza'?'selected':''?>" href="repcobranza">Cobranza</a>
                    </li>
                </ul>
            </li>

            <li class="<?=$menu=='sistema'?'open opened':''?>">
                <a href="javascript:;">
                    <i class="fa fa-cogs"></i>
                    <span class="title">Sistema</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="">
                        <a class="<?=$submenu=='sysparametros'?'selected':''?>" href="sysparametros">Parametros</a>
                    </li>
                </ul>
            </li>

        </ul>

    </div>
    <!-- MAIN MENU - END -->
    <div class="project-info">
        <div class="block1">
            <div class="data">
                <span class='title'>&copy; SERVICREDITO. Todos los derechos reservados.</span>
            </div>
        </div>
    </div>



</div>
