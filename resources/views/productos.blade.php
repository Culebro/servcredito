@extends('layouts.app', ['menu'=> 'catalogos','submenu'=>'catproductos','title'=>'Productos','icon'=>'table'])

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
    <script src="js/productos.js" ></script>
@endsection

@section('content')


<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">Productos Financieros</h2>
            <div class="actions panel_actions pull-right">
                <i class="box_setting fa fa-plus" data-toggle="modal" href="#modalproducto"><span style="font-family: Arial; font-size: 1.3em; padding-left:.5em">Agregar nuevo producto</span></i>
            </div>
        </header>
        <div class="content-body">    <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">


                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Plazo</th>
                                <th>Intereses</th>
                                <th>Reserva</th>
                                <th>Mínimo</th>
                                <th>Mínimo</th>
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
<div class="modal" id="modalproducto" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog" style="width: 65%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Producto Financiero</h4>
            </div>
            <div class="modal-body">
                <form id="pro">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Nombre</label>
                            <input type="text" class="form-control" id="pro_nombre" name="pro_nombre">
                            <input type="hidden" class="form-control" id="pro_id" name="pro_id">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Intereses</label>
                            <input type="text" class="form-control" id="pro_intereses" name="pro_intereses">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Plazo</label>
                            <input type="text" class="form-control" id="pro_cantidadcobros" name="pro_cantidadcobros">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Periodicidad</label>
                            <select class="form-control" id="pro_idcat-periodicidad" name="pro_idcat-periodicidad"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Monto mínimo</label>
                            <input type="text" class="form-control" id="pro_montominimo" name="pro_montominimo">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Monto máximo</label>
                            <input type="text" class="form-control" id="pro_montomaximo" name="pro_montomaximo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Comisión por apertura</label>
                            <input type="text" class="form-control" id="pro_comisionapertura" name="pro_comisionapertura">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Comisión por incumplimiento</label>
                            <input type="text" class="form-control" id="pro_comisionincumplimiento" name="pro_comisionincumplimiento">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Reserva</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pro_reserva" name="pro_reserva">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button" id="closeModal">Cerrar</button>
                <button class="btn btn-success" type="button" onclick="guardar()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
@endsection
