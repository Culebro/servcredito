@extends('layouts.app', ['menu'=> 'creditos','submenu'=>'aprobaciones','title'=>'Aprobaciones','icon'=>'credit-card'])

@section('estilos')
    <link href="assets/plugins/jquery-ui/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>
@endsection

@section('scripts')
    <script src="assets/plugins/jquery-ui/smoothness/jquery-ui.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="js/aprobaciones.js" ></script>
@endsection

@section('content')

<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">Solicitudes pendientes</h2>
        </header>
        <div class="content-body">    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Intereses</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="bodySolicitudes">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">Créditos vigentes</h2>
        </header>
        <div class="content-body">    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Monto</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Interes</th>
                                <th>Pago diario</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="bodyVigentes">
                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    </section>
</div>
<!-- General section box modal start -->
<div class="modal" id="modalsolicitud" tabindex="-1" style="z-index: 1040" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog" style="width: 65%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Solicitud</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">CURP</label>
                            <input type="text" class="form-control" id="sol_curp" name="sol_curp" readonly>
                            <input type="hidden" class="form-control" id="sol_id" name="sol_id">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="sol_nombre" name="sol_nombre" readonly>
                            <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Ingresos mensuales</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" min="0" step="1" class="form-control" id="sol_ingresos" name="sol_ingresos" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Ingresos cada</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sol_periodicidad" id="sol_periodicidad" readonly>
                                <span class="input-group-addon">Días</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Su vivienda es</label>
                            <input type="text" class="form-control" id="sol_vivienda" name="sol_vivienda" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Tiene vehículo</label>
                            <input type="text" class="form-control" id="sol_vehiculo" id="sol_vehiculo" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Direccion (Calle y No)</label>
                            <input type="text" class="form-control" id="sol_calle" name="sol_calle" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-4" class="control-label">Direccion (Colonia)</label>
                            <input type="text" class="form-control" id="sol_colonia" name="sol_colonia" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Direccion (Codigo Postal)</label>
                            <input type="text" class="form-control" id="sol_cp" name="sol_cp" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Direccion (Ciudad)</label>
                            <input type="text" class="form-control" id="sol_ciudad" name="sol_ciudad" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Direccion (Estado)</label>
                            <input type="text" class="form-control" id="sol_estado" name="sol_estado" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Comisión por Apertura</label>
                            <input type="number" class="form-control" id="sol_comision" name="sol_comision">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Plazo</label>
                            <select class="form-control" id="sol_plazo" name="sol_plazo"></select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Monto a otorgar</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" id="sol_monto" name="sol_monto">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="field-5" class="control-label" id="lblintereses">Intereses</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="sol_intereses" name="sol_intereses">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Pago diario</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" id="sol_montoabono" name="sol_montoabono">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Total a pagar</label>                            
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" id="sol_totalpagar" name="sol_totalpagar" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Visita</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sol_fecvisita" name="sol_fecvisita" autocomplete="off" readonly>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Entrega del crédito</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sol_fecentrega" name="sol_fecentrega" autocomplete="off">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Primer pago</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sol_fecinicio" name="sol_fecinicio" autocomplete="off">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-5" class="control-label">Último pago</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sol_fecfin" name="sol_fecfin" autocomplete="off">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Anexos</h2>
                            <div class="actions panel_actions pull-right" style="width: 50%; text-align:right">
                                <div>
                                <select class="form-input" id="tipodoc" name="tipodoc"></select>
                                <i class="box_setting fa fa-plus" style="display: inline" onclick="openFile(this)">&nbsp;<span style="font-size: 1.2em; font-family:Arial, Helvetica, sans-serif">Anexar</span></i>
                                <input type="file" id="archivo" name="archivo" accept="image/*" capture="camera" style="display:none" />
                                </div>
                            </div>
                        </header>
                        <div class="content-body">    <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row" id="documents">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default btn-lg" type="button">Cerrar</button>
                <button class="btn btn-success btn-lg" type="button" onclick="apruebaCredito()">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
@endsection
