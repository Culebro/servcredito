@extends('layouts.app', ['menu'=> 'sistema','submenu'=>'sysparametros','title'=>'Parametros','icon'=>'cogs'])

@section('estilos')
    <link href="assets/plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" media="screen"/>
@endsection

@section('scripts')
    <script src="assets/plugins/jquery-ui/smoothness/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/parametros.js" ></script>
@endsection

@section('content')
<div class="col-md-12">
    <form id="formparam" method="POST">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">PARAMETROS DE CREDITOS</h2>
        </header>
        <div class="content-body">
            <div class='row'>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Comisión por incremento de línea ($)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="comision_incremento_linea" name="comision_incremento_linea" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Múltiplos para crédito</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="multiplo_credito" name="multiplo_credito" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Monto default inicial</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="monto_default" name="monto_default" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2"><button type="button" id="btnsave" class="btn btn-primary btn-block" onclick="saveParametros()">Guardar</button></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left">PARAMETROS DE CREDITO Y COBRANZA</h2>
        </header>
        <div class="content-body">
            <div class='row'>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Gasto de cobranza ($)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="gasto_cobranza" name="gasto_cobranza" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Comisión por prorroga ($)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="comision_prorroga" name="comision_prorroga" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Intereses post-prorroga ($)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="interes_posprorroga" name="interes_posprorroga" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Máximo de pagos seguidos omitidos</label>
                                <input type="number" class="form-control" id="maximo_pagos_seguidos" name="maximo_pagos_seguidos" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Comision reposición de tarjeta ($)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="comision_reposicion_tarjeta" name="comision_reposicion_tarjeta" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2"><button type="button" id="btnsave" class="btn btn-primary btn-block" onclick="saveParametros()">Guardar</button></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
</div>
<div class="clearfix"><br></div>
@endsection
