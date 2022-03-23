@extends('layouts.app',['menu'=> 'catalogos','submenu'=>'catpersonal','title'=>'Personal','icon'=>'users'])

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
    <script src="js/personal.js" ></script>
@endsection

@section('content')


<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">Catálogo de Personal</h2>
            <div class="actions panel_actions pull-right">
                <i class="box_setting fa fa-plus" data-toggle="modal" href="#modalpersonal"><span style="font-family: Arial; font-size: 1.3em; padding-left:.5em" onclick="reiniciaCampos('per')">Agregar nuevo personal</span></i>
            </div>
        </header>
        <div class="content-body">    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>TIpo</th>
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
<div class="modal" id="modalpersonal" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog" style="width: 65%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Datos del personal</h4>
            </div>
            <div class="modal-body">
                <form id="per">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Nombre(s)</label>
                            <input type="text" class="form-control" id="per_nombre" name="per_nombre">
                            <input type="hidden" class="form-control" id="per_id" name="per_id">
                            <input type="hidden" class="form-control" id="per_idcat-tipopersona" name="per_idcat-tipopersona" value="2">
                            <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="per_paterno" name="per_paterno">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Apellido materno</label>
                            <input type="text" class="form-control" id="per_materno" name="per_materno">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Direccion (Calle y No)</label>
                            <input type="text" class="form-control" id="per_dir-calle" name="per_dir-calle">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="field-4" class="control-label">Direccion (Colonia)</label>
                            <input type="text" class="form-control" id="per_dir-colonia" name="per_dir-colonia">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Direccion (Codigo Postal)</label>
                            <input type="text" class="form-control" id="per_dir-cp" name="per_dir-cp">
                        </div>
                    </div>
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
                            <label for="field-5" class="control-label">Nombre de Usuario</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="usr_username" name="usr_username">
                                <input type="hidden" class="form-control" id="usr_id" name="usr_id">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" id="usr_password" name="usr_password">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Repetir Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control" id="usr_password2" name="usr_password2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="field-5" class="control-label">Tipo de personal</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-shield"></i></span>
                            <select class="form-control" id="usr_tipo" name="usr_tipo"></select>
                        </div>
                    </div>
                </div>
                <div class="row" id="divcobrador">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Meta mensual</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" id="usr_metamensual" name="usr_metamensual">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Alias en Mapa</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" id="usr_alias" name="usr_alias">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Mostrar en mapa</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marked-alt"></i></span>
                                <select class="form-control" id="usr_mapa" name="usr_mapa">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button" id="modalClose">Cerrar</button>
                <button class="btn btn-success" type="button" onclick="saveForm()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
@endsection
