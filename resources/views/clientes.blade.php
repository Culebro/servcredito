@extends('layouts.app',['menu'=> 'catalogos','submenu'=>'catclientes','title'=>'Clientes','icon'=>'user'])

@section('estilos')
    <link href="assets/plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>
@endsection

@section('scripts')
    <script src="assets/plugins/jquery-ui/smoothness/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="js/clientes.js" ></script>
@endsection

@section('content')


<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">Cartera de clientes</h2>
            <div class="actions panel_actions pull-right">
                <!--<i class="box_setting fa fa-plus" data-toggle="modal" href="#modalcliente"><span style="font-family: Arial; font-size: 1.3em; padding-left:.5em">Agregar nuevo cliente</span></i>-->
            </div>
        </header>
        <div class="content-body">    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Límite</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- General section box modal start -->
<div class="modal" id="modalcliente" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog" style="width: 65%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Datos del cliente</h4>
            </div>
            <div class="modal-body">
                <form id="per">
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
                    <div class="col-md-4">
                        <label for="field-5" class="control-label">Límite de crédito</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="number" min="0" step="100" class="form-control" id="limitecredito">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="field-5" class="control-label">Máximo plazo</label>
                        <div class="input-group">
                            <input type="number" min="0" step="5" max="60" class="form-control" id="plazomax">
                            <span class="input-group-addon">Días</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Estado actual</label>
                            <select class="form-control" id="status"></select>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button" id="modalClose">Cerrar</button>
                <button class="btn btn-success" type="button" onclick="guardar()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
@endsection
