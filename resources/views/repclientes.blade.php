@extends('layouts.app',['menu'=> 'reportes','submenu'=>'repclientes','title'=>'Clientes','icon'=>'chart-line'])

@section('estilos')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" media="screen"/>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="js/reportes.js" ></script>
@endsection

@section('content')


<div class="col-lg-12">
    <section class="box ">
        <div class="content-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table cellspacing="0" id="tabla" class="table table-small-font table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>CURP</th>
                                    <th>Edad</th>
                                    <th>Sexo</th>
                                    <th>Edo. Civil</th>
                                    <th>Direccion</th>
                                    <th>Nacionalidad</th>
                                    <th>Telefono</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Ocupacion</th>
                                    <th>Direccion laboral</th>
                                    <th>Telefono laboral</th>
                                    <th>Límite de crédito</th>
                                    <th>Plazo Máximo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="body">
                                @foreach($arrayResp as $row)
                                    <tr>
                                        <td>{{$row['nombre']}}</td>
                                        <td>{{$row['curp']}}</td>
                                        <td>{{$row['edad']}}</td>
                                        <td>{{$row['sexo']}}</td>
                                        <td>{{$row['edocivil']}}</td>
                                        <td>{{$row['dir_calle']}}</td>
                                        <td>{{$row['nacionalidad']}}</td>
                                        <td>{{$row['telefono']}}</td>
                                        <td>{{$row['celular']}}</td>
                                        <td>{{$row['email']}}</td>
                                        <td>{{$row['ocupacion']}}</td>
                                        <td>{{$row['dirlab_calle']}}</td>
                                        <td>{{$row['dirlab_telefono']}}</td>
                                        <td>{{$row['limitecredito']}}</td>
                                        <td>{{$row['plazomax']}}</td>
                                        <td>{{$row['status']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
