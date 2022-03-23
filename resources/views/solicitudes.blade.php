@extends('layouts.app', ['menu'=> 'creditos','submenu'=>'solicitudes','title'=>'Solicitudes','icon'=>'credit-card'])

@section('estilos')
    <link href="assets/plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" media="screen"/>
@endsection

@section('scripts')
    <script src="assets/plugins/jquery-ui/smoothness/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/autosize/autosize.min.js" type="text/javascript"></script>
        <script src="assets/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="js/solicitudes.js" ></script>
@endsection

@section('content')
<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <div class="page-title">

        <div class="pull-left">
            <h1 class="title">SOLICITUDES DE CREDITO</h1>
        </div>


    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-12">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading1">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                         DATOS PERSONALES
                    </a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                <form id="per" method="POST" action="">
                <div class="panel-body">
                    <div class='row'>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">CURP</label>
                                        <input type="text" class="form-control" id="per_curp" name="per_curp" required>
                                        <input type="hidden" class="form-control" id="per_id" name="per_id">
                                        <input type="hidden" class="form-control" id="per_idcat-tipopersona" name="per_idcat-tipopersona" value="1">
                                        <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Nombre(s)</label>
                                        <input type="text" class="form-control" id="per_nombre" name="per_nombre">
                                        <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="per_paterno" name="per_paterno">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido materno</label>
                                        <input type="text" class="form-control" id="per_materno" name="per_materno">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Fecha de Nacimiento</label>
                                        <input type="text" class="form-control" id="per_fechanac" name="per_fechanac" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Edad</label>
                                        <input type="text" class="form-control" id="per_edad" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Sexo</label>
                                        <select class="form-control" id="per_sexo" name="per_sexo">
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Estado Civil</label>
                                        <select class="form-control" id="per_idcat-edocivil" name="per_idcat-edocivil"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Direccion (Calle y No)</label>
                                        <input type="text" class="form-control" id="per_dir-calle" name="per_dir-calle">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Direccion (Colonia)</label>
                                        <input type="text" class="form-control" id="per_dir-colonia" name="per_dir-colonia">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion (Codigo Postal)</label>
                                        <input type="text" class="form-control" id="per_dir-cp" name="per_dir-cp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion (Estado)</label>
                                        <select class="form-control" id="per_dir-estado" onchange="combobox('cat_ciudad','per_dir-ciudad',0,'idcat_estado',this.value)"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion (Ciudad)</label>
                                        <select class="form-control" id="per_dir-ciudad" name="per_dir-ciudad"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Nacionalidad</label>
                                        <select class="form-control" id="per_idcat-nacionalidad" name="per_idcat-nacionalidad"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Telefono local</label>
                                        <input type="text" class="form-control" id="per_telefono" name="per_telefono">
                                        <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Celular</label>
                                        <input type="text" class="form-control" id="per_celular" name="per_celular">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Correo electrónico</label>
                                        <input type="text" class="form-control" id="per_email" name="per_email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Ocupación</label>
                                        <input type="text" class="form-control" id="per_ocupacion" name="per_ocupacion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Direccion laboral (Calle y No)</label>
                                        <input type="text" class="form-control" id="per_dirlab-calle" name="per_dirlab-calle">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Direccion laboral (Colonia)</label>
                                        <input type="text" class="form-control" id="per_dirlab-colonia" name="per_dirlab-colonia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (Estado)</label>
                                        <select class="form-control" id="per_dirlab-estado" onchange="combobox('cat_ciudad','per_dirlab-ciudad',0,'idcat_estado',this.value)"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (Ciudad)</label>
                                        <select class="form-control" id="per_dirlab-ciudad" name="per_dirlab-ciudad"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (C.P)</label>
                                        <input type="text" class="form-control" id="per_dirlab-cp" name="per_dirlab-cp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (Telefono)</label>
                                        <input type="text" class="form-control" id="per_dirlab-telefono" name="per_dirlab-telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4" id="btnnext1">
                                    <a class="btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse2"  aria-expanded="false" aria-controls="collapse2" style="display: none" id="sig_per"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                    <a class="btn btn-primary btn-block" onclick="siguiente(2,'DATOS PERSONALES','per')"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading2">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                         DATOS DE LA PAREJA
                    </a>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                <form id="par" method="POST" action="">
                <div class="panel-body">
                    <div class='row'>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Nombre(s)</label>
                                        <input type="text" class="form-control" id="par_nombre" name="par_nombre" required>
                                        <input type="hidden" class="form-control" id="par_idcre-credito" name="par_idcre-credito">
                                        <input type="hidden" class="form-control" id="par_idcat-tipopersona" name="par_idcat-tipopersona" value="2">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="par_paterno" name="par_paterno">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido materno</label>
                                        <input type="text" class="form-control" id="par_materno" name="par_materno">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Ocupación</label>
                                        <input type="text" class="form-control" id="par_ocupacion" name="par_ocupacion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Direccion laboral (Calle y No)</label>
                                        <input type="text" class="form-control" id="par_dirlab-calle" name="par_dirlab-calle">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Direccion laboral (Colonia)</label>
                                        <input type="text" class="form-control" id="par_dirlab-colonia" name="par_dirlab-colonia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Estado</label>
                                        <select class="form-control" id="par_dirlab-estado" onchange="combobox('cat_ciudad','par_dirlab-ciudad',0,'idcat_estado',this.value)"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (Ciudad)</label>
                                        <select class="form-control" id="par_dirlab-ciudad" name="par_dirlab-ciudad"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (C.P)</label>
                                        <input type="text" class="form-control" id="par_dirlab-cp" name="par_dirlab-cp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (Telefono)</label>
                                        <input type="text" class="form-control" id="par_dirlab-telefono" name="par_dirlab-telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4" id="btnnext2">
                                    <a class="btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse3"  aria-expanded="false" aria-controls="collapse3" style="display: none" id="sig_par"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                    <a class="btn btn-primary btn-block" onclick="siguiente(3,'DATOS DE LA PAREJA','par')"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading3">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                         ASPECTO SOCIOECONÓMICO
                    </a>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                <form id="as" method="POST" action="">
                <div class="panel-body">
                    <div class='row'>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Su vivienda es:</label>
                                        <select class="form-control" id="as_vivienda" name="as_vivienda">
                                            <option value="Propia">Propia</option>
                                            <option value="Rentada">Rentada</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                        <input type="hidden" class="form-control" id="as_idcre-credito" name="as_idcre-credito">
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="row" id="as_g1_Propia">
                                        <div class="col-md-4">
                                            <label for="field-1" class="control-label">La vivienda está:</label>
                                            <select class="form-control" id="as_viviendaesta" name="as_viviendaesta">
                                                <option value="Con escrituras">Con escrituras</option>
                                                <option value="Sin escrituras">Sin escrituras</option>
                                                <option value="Comodato">Comodato</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" id="as_g1_Rentada">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">Renta ($)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="number" min="0" step="1" class="form-control" id="as_renta" name="as_renta">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">Antigüedad</label>
                                                <input type="text" class="form-control" id="as_antiguedad" name="as_antiguedad">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">Plazo</label>
                                                <input type="text" class="form-control" id="as_plazo" name="as_plazo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="as_g1_Otro">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">Especifique</label>
                                                <input type="text" class="form-control" id="as_otroespecifique" name="as_otroespecifique">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="field-2" class="control-label">Antigüedad</label>
                                                <input type="text" class="form-control" id="as_otroantiguedad" name="as_otroantiguedad">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Vive con:</label>
                                        <select class="form-control" id="as_vivecon" name="as_vivecon">
                                            <option value="Pareja">Pareja</option>
                                            <option value="Hijos">Hijos</option>
                                            <option value="Padres">Padres</option>
                                            <option value="Parientes">Parientes</option>
                                            <option value="Vecindad">Vecindad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">No. de hijos</label>
                                        <input type="text" class="form-control" id="as_numhijos" name="as_numhijos">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Edades</label>
                                        <input type="text" class="form-control" id="as_edadeshijos" name="as_edadeshijos">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Dependientes económicos</label>
                                        <input type="text" class="form-control" id="as_dependientes" name="as_dependientes">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Estado de salud</label>
                                        <input type="text" class="form-control" id="as_edosalud" name="as_edosalud">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">¿Padece alguna enfermedad?¿Cuál?</label>
                                        <input type="text" class="form-control" id="as_enfermedad" name="as_enfermedad">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">¿Cuenta con vehículo propio?</label>
                                        <select class="form-control" id="as_vehiculo" name="as_vehiculo">
                                            <option value="No">No</option>
                                            <option value="Si">Si</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="as_datosvehiculo">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Marca</label>
                                        <input type="text" class="form-control" id="as_vehiculomarca" name="as_vehiculomarca">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Tipo</label>
                                        <input type="text" class="form-control" id="as_vehiculotipo" name="as_vehiculotipo">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Modelo</label>
                                        <input type="text" class="form-control" id="as_vehiculomodelo" name="as_vehiculomodelo">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Placa</label>
                                        <input type="text" class="form-control" id="as_vehiculoplaca" name="as_vehiculoplaca">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4" id="btnnext3">
                                    <a class="btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse4"  aria-expanded="false" aria-controls="collapse4" style="display: none" id="sig_as"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                    <a class="btn btn-primary btn-block" onclick="siguiente(4,'ASPECTO SOCIOECONÓMICO','as')"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading4">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                         FUENTE DE INGRESOS POR NEGOCIO PROPIO
                    </a>
                </h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                <form id="finp" method="POST" action="">
                <div class="panel-body">
                    <div class='row'>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Giro</label>
                                        <input type="text" class="form-control" id="finp_giro" name="finp_giro">
                                        <input type="hidden" class="form-control" id="finp_idcre-credito" name="finp_idcre-credito">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Nombre del negocio</label>
                                        <input type="text" class="form-control" id="finp_nombre" name="finp_nombre">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Observaciones</label>
                                        <textarea class="form-control" id="finp_observaciones" name="finp_observaciones"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Calle y numero</label>
                                        <input type="text" class="form-control" id="finp_callenum" name="finp_callenum">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Colonia</label>
                                        <input type="text" class="form-control" id="finp_colonia" name="finp_colonia">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Estado</label>
                                        <select class="form-control" id="finp_estado" onchange="combobox('cat_ciudad','finp_idcat-ciudad',0,'idcat_estado',this.value)"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Ciudad</label>
                                        <select class="form-control" id="finp_idcat-ciudad" name="finp_idcat-ciudad"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Periodicidad de ingresos</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">Cada</span>
                                            <input type="number" min="0" step="1" class="form-control" id="finp_periodicidad" name="finp_periodicidad">
                                            <span class="input-group-addon">Días</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Monto de ventas ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" min="0" step="1" class="form-control" id="finp_ventas" name="finp_ventas">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Utilidad neta ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" min="0" step="1" class="form-control" id="finp_utilidad" name="finp_utilidad">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4" id="btnnext4">
                                    <a class="btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse5"  aria-expanded="false" aria-controls="collapse5" style="display: none" id="sig_finp"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                    <a class="btn btn-primary btn-block" onclick="siguiente(5,'FUENTE DE INGRESOS POR NEGOCIO PROPIO','finp')"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading5">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                         FUENTE DE INGRESOS POR TRABAJO
                    </a>
                </h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                <form id="fitr" method="POST" action="">
                <div class="panel-body">
                    <div class='row'>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Nombre de empresa o Patrón</label>
                                        <input type="text" class="form-control" id="fitr_nombre" name="fitr_nombre">
                                        <input type="hidden" class="form-control" id="fitr_idcre-credito" name="fitr_idcre-credito">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Puesto</label>
                                        <input type="text" class="form-control" id="fitr_puesto" name="fitr_puesto">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Fecha aprox. de ingreso</label>
                                        <input type="text" class="form-control" id="fitr_antiguedad" name="fitr_antiguedad" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Sueldo ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" min="0" step="1" class="form-control" id="fitr_sueldo" name="fitr_sueldo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Periodo de pago</label>
                                        <select class="form-control" id="fitr_periodopago" name="fitr_periodopago">
                                            <option value="1">Diario</option>
                                            <option value="7">Semanal</option>
                                            <option value="15">Quincenal</option>
                                            <option value="30">Mensual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4" id="btnnext5">
                                    <a class="btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse6"  aria-expanded="false" aria-controls="collapse6" style="display: none" id="sig_fitr"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                    <a class="btn btn-primary btn-block" onclick="siguiente(6,'FUENTE DE INGRESOS POR TRABAJO','fitr')"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading6">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                         DATOS DE AVAL
                    </a>
                </h4>
            </div>
            <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                <form id="aval" method="POST" action="">
                <div class="panel-body">
                    <div class='row'>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Nombre(s)</label>
                                        <input type="text" class="form-control" id="aval_nombre" name="aval_nombre">
                                        <input type="hidden" class="form-control" id="aval_idcre-credito" name="aval_idcre-credito">
                                        <input type="hidden" class="form-control" id="aval_idcat-tipopersona" name="aval_idcat-tipopersona" value="3">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="aval_paterno" name="aval_paterno">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido materno</label>
                                        <input type="text" class="form-control" id="aval_materno" name="aval_materno">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Parentesco</label>
                                        <input type="text" class="form-control" id="aval_parentesco" name="aval_parentesco">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Direccion (Calle y No)</label>
                                        <input type="text" class="form-control" id="aval_dir-calle" name="aval_dir-calle">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Direccion (Colonia)</label>
                                        <input type="text" class="form-control" id="aval_dir-colonia" name="aval_dir-colonia">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion (Codigo Postal)</label>
                                        <input type="text" class="form-control" id="aval_dir-cp" name="aval_dir-cp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion (Estado)</label>
                                        <select class="form-control" id="aval_dir-estado" onchange="combobox('cat_ciudad','aval_dir-ciudad',0,'idcat_estado',this.value)"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion (Ciudad)</label>
                                        <select class="form-control" id="aval_dir-ciudad" name="aval_dir-ciudad"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Telefono</label>
                                        <input type="text" class="form-control" id="aval_telefono" name="aval_telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Ocupación</label>
                                        <input type="text" class="form-control" id="aval_ocupacion" name="aval_ocupacion">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Direccion laboral (Calle y No)</label>
                                        <input type="text" class="form-control" id="aval_dirlab-calle" name="aval_dirlab-calle">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Direccion laboral (Colonia)</label>
                                        <input type="text" class="form-control" id="aval_dirlab-colonia" name="aval_dirlab-colonia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (Estado)</label>
                                        <select class="form-control" id="aval_dirlab-estado" onchange="combobox('cat_ciudad','aval_dirlab-ciudad',0,'idcat_estado',this.value)"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (Ciudad)</label>
                                        <select class="form-control" id="aval_dirlab-ciudad" name="aval_dirlab-ciudad"></select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (C.P)</label>
                                        <input type="text" class="form-control" id="aval_dirlab-cp" name="aval_dirlab-cp">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Direccion laboral (Telefono)</label>
                                        <input type="text" class="form-control" id="aval_dirlab-telefono" name="aval_dirlab-telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4" id="btnnext6">
                                    <a class="btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse7"  aria-expanded="false" aria-controls="collapse7" style="display: none" id="sig_aval"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                    <a class="btn btn-primary btn-block" onclick="siguiente(7,'DATOS DE AVAL','aval')"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading7">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="false" aria-controls="collapse7">
                         REFERENCIAS PERSONALES
                    </a>
                </h4>
            </div>
            <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
                <div class="panel-body">
                    <div class='row'>
                        <form id="ref1" method="POST" action="">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Nombre(s)</label>
                                        <input type="text" class="form-control" id="ref1_nombre" name="ref1_nombre">
                                        <input type="hidden" class="form-control" id="ref1_idcre-credito" name="ref1_idcre-credito">
                                        <input type="hidden" class="form-control" id="ref1_idcat-tipopersona" name="ref1_idcat-tipopersona" value="4">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="ref1_paterno" name="ref1_paterno">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido materno</label>
                                        <input type="text" class="form-control" id="ref1_materno" name="ref1_materno">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Parentesco</label>
                                        <input type="text" class="form-control" id="ref1_parentesco" name="ref1_parentesco">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Calle y No</label>
                                        <input type="text" class="form-control" id="ref1_dir-calle" name="ref1_dir-calle">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Colonia</label>
                                        <input type="text" class="form-control" id="ref1_dir-colonia" name="ref1_dir-colonia">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Codigo Postal</label>
                                        <input type="text" class="form-control" id="ref1_dir-cp" name="ref1_dir-cp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Estado</label>
                                        <select class="form-control" id="ref1_dir-estado" onchange="combobox('cat_ciudad','ref1_dir-ciudad',0,'idcat_estado',this.value)"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Ciudad</label>
                                        <select class="form-control" id="ref1_dir-ciudad" name="ref1_dir-ciudad"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Telefono</label>
                                        <input type="text" class="form-control" id="ref1_telefono" name="ref1_telefono">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class='row'>
                        <div class="col-xs-12">
                            <hr/>
                        </div>
                    </div>
                    <div class='row'>
                        <form id="ref2" method="POST" action="">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-1" class="control-label">Nombre(s)</label>
                                        <input type="text" class="form-control" id="ref2_nombre" name="ref2_nombre">
                                        <input type="hidden" class="form-control" id="ref2_idcre-credito" name="ref2_idcre-credito">
                                        <input type="hidden" class="form-control" id="ref2_idcat-tipopersona" name="ref2_idcat-tipopersona" value="4">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="ref2_paterno" name="ref2_paterno">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Apellido materno</label>
                                        <input type="text" class="form-control" id="ref2_materno" name="ref2_materno">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Parentesco</label>
                                        <input type="text" class="form-control" id="ref2_parentesco" name="ref2_parentesco">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-2" class="control-label">Calle y No</label>
                                        <input type="text" class="form-control" id="ref2_dir-calle" name="ref2_dir-calle">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-4" class="control-label">Colonia</label>
                                        <input type="text" class="form-control" id="ref2_dir-colonia" name="ref2_dir-colonia">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Codigo Postal</label>
                                        <input type="text" class="form-control" id="ref2_dir-cp" name="ref2_dir-cp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Estado</label>
                                        <select class="form-control" id="ref2_dir-estado" onchange="combobox('cat_ciudad','ref2_dir-ciudad',0,'idcat_estado',this.value)"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Ciudad</label>
                                        <select class="form-control" id="ref2_dir-ciudad" name="ref2_dir-ciudad"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Telefono</label>
                                        <input type="text" class="form-control" id="ref2_telefono" name="ref2_telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4" id="btnnext7">
                                    <a class="btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse8"  aria-expanded="false" aria-controls="collapse8" style="display: none" id="sig_ref"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                    <a class="btn btn-primary btn-block" onclick="siguiente(8,'REFERENCIAS PERSONALES','ref')"><i class="fa fa-arrow-right"></i><br/>Siguiente</a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading8">
                <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse8"  aria-expanded="false" aria-controls="collapse8">
                         DATOS DEL CRÉDITO
                    </a>
                </h4>
            </div>
            <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                <div class="panel-body">
                    <div class='row'>
                        <form id="cre" method="POST" action="">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Visita</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cre_fecvisita" name="cre_fecvisita" value="<?=date('d/m/Y')?>" autocomplete="off">
                                            <input type="hidden" id="cre_id" name="cre_id">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Entrega del crédito</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cre_fecentrega" name="cre_fecentrega" value="<?=date('d/m/Y')?>" autocomplete="off">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Primer pago</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cre_fecinicio" name="cre_fecinicio" value="<?=date('d/m/Y')?>" autocomplete="off">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Último pago</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cre_fecfin" name="cre_fecfin" readonly>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Plazo</label>
                                        <select class="form-control" id="cre_plazo" name="cre_plazo"></select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">Monto a otorgar</label>
                                        <input type="number" class="form-control" id="cre_monto" name="cre_monto">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label" id="lblintereses">% Intereses</label>
                                        <input type="number" class="form-control" id="cre_interesesbruto" name="cre_interesesbruto">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">($) Pago diario</label>
                                        <input type="number" class="form-control" id="cre_montoabono" name="cre_montoabono">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="field-5" class="control-label">($) Total a pagar</label>
                                        <input type="number" class="form-control" id="cre_totalpagar" name="cre_totalpagar" readonly>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button type="button" id="btnsave" class="btn btn-primary btn-block" onclick="saveCredit('cre')"><i class="fa fa-check"></i><br/>Solicitar</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="clearfix"><br></div>
@endsection
