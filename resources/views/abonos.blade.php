@extends('layouts.app', ['menu'=> 'cobranza','submenu'=>'abonos','title'=>'Abonos','icon'=>'calculator'])

@section('estilos')
    <link href="assets/plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/typeahead/css/typeahead.css" rel="stylesheet" type="text/css" media="screen"/>
@endsection

@section('scripts')
    <script src="assets/plugins/jquery-ui/smoothness/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="assets/plugins/typeahead/typeahead.bundle.js" type="text/javascript"></script>
    <script src="assets/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
    <script src="js/abonos.js" type="text/javascript"></script>
@endsection

@section('content')

<div class="col-lg-12">
    <section class="box ">
        <div class="content-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="field-1" class="control-label">Nombre del Cliente</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="cliente" id="cliente">
                            <a class="btn btn-default input-group-addon" onclick="showAmortizacion()"><i class="fa fa-search"></i></a>
                        </div>
                        <input type="hidden" class="form-control" id="cre_id" name="sol_id">
                    </div>
                    <input type="radio" name="tipoform" value="1" onclick="verDiv('dispersion')" checked> Dispersión 
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="tipoform" value="0" onclick="verDiv('aplicacionpagos')"> Por aplicación de pagos
                </div>
                <div class="col-md-2">
                    <div class="r12_counter db_box" style="background-color:#DDD">
                        <div class="stats">
                            <span>Monto Crédito</span>
                            <h4 id="prestamo"><strong>0.00</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="r12_counter db_box" style="background-color:#DDD">
                        <div class="stats">
                            <span>Saldo Actual</span>
                            <h4 id="saldoactual"><strong>0.00</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="r12_counter db_box" style="background-color:#DDD">
                        <div class="stats">
                            <span>Saldo Intereses</span>
                            <h4 id="creintereses"><strong>0.00</strong></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="r12_counter db_box" style="background-color:#DDD">
                        <div class="stats">
                            <span>Saldo Cobranza</span>
                            <h4 id="gastoscobranza"><strong>0.00</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <hr/>
                </div>
            </div>
            <div class="row" id="divdispersion">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Fecha</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="disp_fecha" value="<?=date('d/m/Y')?>" autocomplete="off">
                                    <input type="hidden" class="form-control" id="dis_id">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Forma de pago</label>
                                <select class="form-control" id="disp_formapago">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Deposito Bancario">Deposito Bancario</option>
                                </select>
                                <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Clave</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control" style="text-align: right" id="disp_clave" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Abono a Capital</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="abono_capital" autocomplete="off">
                                    <span class="input-group-addon"><a href="javascript:addAbono('capital')"><i class="fa fa-plus"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Abono a Intereses</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="abono_intereses" autocomplete="off">
                                    <span class="input-group-addon"><a href="javascript:addAbono('intereses')"><i class="fa fa-plus"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Abono a Cobranza</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="abono_cobranza" autocomplete="off">
                                    <span class="input-group-addon"><a href="javascript:addAbono('cobranza')"><i class="fa fa-plus"></i></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Observaciones</label>
                                <textarea class="form-control" id="disp_observaciones" style="height: 120px"></textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12" style="text-align: right">
                                    <label class="control-label">Capital:</label>
                                    <input type="text" id="distot_capital" value="0.00" style="text-align: right" readonly><br>
                                    <label class="control-label">Intereses:</label>
                                    <input type="text" id="distot_intereses" value="0.00" style="text-align: right" readonly><br>
                                    <label class="control-label">Cobranza:</label>
                                    <input type="text" id="distot_cobranza" value="0.00" style="text-align: right" readonly><br>
                                    <label class="control-label">Total:</label>
                                    <input type="text" id="distot_total" value="0.00" style="text-align: right" readonly><br>
                                    <label class="control-label">S.A:</label>
                                    <input type="text" id="distot_sa" value="0.00" style="text-align: right" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-success btn-block" id="btndispsave" onclick="pagoDisperso()"><i class="fa fa-donate" style="font-size: 1.1em"></i><br>Pagar</a>
                        </div>
                        <div class="col-md-3">
                        <a class="btn btn-warning btn-block" id="btndispnew" onclick="limpiar()"><i class="fa fa-file" style="font-size: 1.1em"></i><br>Nuevo</a>
                            <!-- <a class="btn btn-warning btn-icon btn-lg" data-toggle="modal" href="#modalcondonacion" onclick="abrePago('c')"><i class="fa fa-handshake" style="font-size: 1.1em"></i><br>Condonar</a>
                            <a class="btn btn-orange btn-icon btn-lg" data-toggle="modal" href="#modalliquidacion" onclick="abrePago('l')"><i class="fa fa-stamp" style="font-size: 1.1em"></i><br>Liquidar</a> -->
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12" style="text-align: right">
                                    <label class="control-label">PAGO:</label>
                                    <input type="text" id="distot_pago" value="" style="text-align: right; background-color:#EFFFBF" autocomplete="off"><br>
                                    <label class="control-label">CAMBIO:</label>
                                    <input type="text" id="distot_cambio" value="0.00" style="text-align: right; background-color:#DDD" readonly><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="divaplicacionpagos" style="display:none">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form>
                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>No.</th>
                                <th>Fecha</th>
                                <th>Saldo inicial</th>
                                <th>Capital</th>
                                <th>Intereses</th>
                                <th>Pago</th>
                                <th>Saldo final</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="bodyPagos">
                        </tbody>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General section box modal start -->
<div class="modal" id="modalpago" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Aplicar Pago</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Cliente</label>
                            <input type="text" class="form-control" id="mod_nombre" readonly>
                            <input type="hidden" class="form-control" id="mod_id">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Saldo</label>
                            <input type="text" class="form-control" style="text-align: right" id="mod_saldo" readonly>
                            <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="mod_fecha" value="<?=date('d/m/Y')?>" autocomplete="off">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Forma de pago</label>
                            <select class="form-control" id="mod_formapago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Deposito Bancario">Deposito Bancario</option>
                            </select>
                            <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Clave</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control" style="text-align: right" id="mod_clave" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Fecha</th>
                                <th>Capital</th>
                                <th>Intereses</th>
                                <th>Cobranza</th>
                                <th>Pago</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="tbodyModal">
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Observaciones</label>
                            <textarea class="form-control" id="mod_observaciones" style="height: 120px"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12" style="text-align: right">
                                <label class="control-label">Capital:</label>
                                <input type="text" id="tot_capital" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Intereses:</label>
                                <input type="text" id="tot_intereses" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Cobranza:</label>
                                <input type="text" id="tot_cobranza" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Total:</label>
                                <input type="text" id="tot_total" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">S.A:</label>
                                <input type="text" id="tot_sa" value="0.00" style="text-align: right" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12" style="text-align: right">
                                <label class="control-label">PAGO:</label>
                                <input type="text" id="tot_pago" value="" style="text-align: right; background-color:#EFFFBF" autocomplete="off"><br>
                                <label class="control-label">CAMBIO:</label>
                                <input type="text" id="tot_cambio" value="0.00" style="text-align: right; background-color:#DDD" readonly><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modalfooter">
                <button data-dismiss="modal" class="btn btn-default btn-lg" type="button">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- MODAL DE CONDONACION
Campos que llevara:
1.- Causa o razón
2.- Clave de autorizacion
3.- Foto de acuerdo
4.- Fecha
-->
<div class="modal" id="modalcondonacion" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Condonación de Pago</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Cliente</label>
                            <input type="text" class="form-control" id="modc_nombre" readonly>
                            <input type="hidden" class="form-control" id="modc_id">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Saldo</label>
                            <input type="text" class="form-control" style="text-align: right" id="modc_saldo" readonly>
                            <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="modc_fecha" value="<?=date('d/m/Y')?>" autocomplete="off">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Forma de pago</label>
                            <select class="form-control" id="modc_formapago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Deposito Bancario">Deposito Bancario</option>
                            </select>
                            <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Clave</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control" style="text-align: right" id="modc_clave" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Fecha</th>
                                <th>Capital</th>
                                <th>Intereses</th>
                                <th>Cobranza</th>
                                <th>Pago</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="tbodyModalc">
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Observaciones</label>
                            <textarea class="form-control" id="modc_observaciones" style="height: 120px"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12" style="text-align: right">
                                <label class="control-label">Capital:</label>
                                <input type="text" id="totc_capital" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Intereses:</label>
                                <input type="text" id="totc_intereses" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Cobranza:</label>
                                <input type="text" id="totc_cobranza" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Total:</label>
                                <input type="text" id="totc_total" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">S.A:</label>
                                <input type="text" id="totc_sa" value="0.00" style="text-align: right" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer" id="modalfooterc">
                <button data-dismiss="modal" class="btn btn-default btn-lg" type="button">Cerrar</button>
                <button class="btn btn-success btn-lg" type="button" onclick="aplicarPago('c')">Aplicar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- MODAL DE LIQUIDACION
Campos que llevara:
1.- Fecha
2.- Clave de autorizacion
3.- Foto de acuerdo
4.- Fecha
-->
<div class="modal" id="modalliquidacion" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Liquidación de crédito</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Cliente</label>
                            <input type="text" class="form-control" id="modl_nombre" readonly>
                            <input type="hidden" class="form-control" id="modl_id">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Saldo</label>
                            <input type="text" class="form-control" style="text-align: right" id="modl_saldo" readonly>
                            <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="modl_fecha" value="<?=date('d/m/Y')?>" autocomplete="off">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Forma de pago</label>
                            <select class="form-control" id="modl_formapago">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Deposito Bancario">Deposito Bancario</option>
                            </select>
                            <!--<input type="text" id="idOp" style="display:none"><select class="form-control" id="fudn"></select>-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Clave</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control" style="text-align: right" id="modl_clave" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Observaciones</label>
                            <textarea class="form-control" id="modl_observaciones" style="height: 120px"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12" style="text-align: right">
                                <label class="control-label">Capital:</label>
                                <input type="text" id="totl_capital" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Intereses:</label>
                                <input type="text" id="totl_intereses" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Cobranza:</label>
                                <input type="text" id="totl_cobranza" value="0.00" style="text-align: right" readonly><br>
                                <label class="control-label">Total:</label>
                                <input type="text" id="totl_total" value="0.00" style="text-align: right" readonly><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12" style="text-align: right">
                                <label class="control-label">PAGO:</label>
                                <input type="text" id="totl_pago" value="" style="text-align: right; background-color:#EFFFBF" autocomplete="off"><br>
                                <label class="control-label">CAMBIO:</label>
                                <input type="text" id="totl_cambio" value="0.00" style="text-align: right; background-color:#DDD" readonly><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modalfooterl">
                <button data-dismiss="modal" class="btn btn-default btn-lg" type="button">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
@endsection
