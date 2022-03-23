<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;

class AbonosController extends Controller
{
    public function index()
    {
        return view('abonos');
    }

    public function getAmortizacion(Request $request){
        $rows = DB::table('cre_amortizacion')
                ->join('cre_credito', 'cre_credito.id', '=', 'cre_amortizacion.idcre_credito')
                ->select(DB::Raw("cre_amortizacion.*,cre_amortizacion.id as id,cre_credito.id as idcredito,cre_credito.interesesbruto as creintereses,(cre_credito.monto + cre_credito.interesesbruto) as monto"))
                ->where('cre_amortizacion.idcre_credito','=',$request->id)
                ->get();
        return utf8_encode(json_encode($rows));
    }

    public function aplicaPago(Request $request){
        $done = array('status'=>'ERROR','error'=>'');
        $user = Auth::user();

        if($request->concepto == 'ABONO' || $request->concepto == 'LIQUIDACION')
            $status = 2;
        if($request->concepto == 'CONDONACION')
            $status = 4;

        //Hacemos la inserción de cre_pago
        $idpago = DB::table('cre_pago')->insertGetId(['folio'=>DB::raw('folio+1'),
                                                       'fecha'=>$this->dateFormat($request->fecha,'html2mysql'),
                                                       'hora'=>DB::raw('NOW()'),
                                                       'monto'=>str_replace(',','',$request->monto),
                                                       'forma_pago'=>str_replace(',','',$request->formapago),
                                                       'efectivo'=>str_replace(',','',$request->efectivo),
                                                       'cambio'=>str_replace(',','',$request->cambio),
                                                       'concepto'=>$request->concepto,
                                                       'observaciones'=>$request->observaciones,
                                                       'idcre_credito'=>$request->idcredito,
                                                       'idusers'=>$user->id]);
        //Hacemos la inserción de cre_pagodet
        $pd = 0;
        $affe = 0;
        if($idpago>0){
            foreach($request->items as $value){
                $pd = DB::table('cre_pagodet')->insertGetId(['fecha'=>$this->dateFormat($request->fecha,'html2mysql'),
                                                        'capital'=>str_replace(',','',$value['capital']),
                                                        'intereses'=>str_replace(',','',$value['intereses']),
                                                        'cargo'=>str_replace(',','',$value['cargo']),
                                                        'total'=>str_replace(',','',$value['total']),
                                                        'idcre_amortizacion'=>$value['idcre_amortizacion'],
                                                        'idcre_pago'=>$idpago]);
                if($pd>0){
                    //Actualizamos el status de cre_amortizacion
                    $affected = DB::table('cre_amortizacion')
                                ->where('id', $value['idcre_amortizacion'])
                                ->update(['status'=>$status,'fecha_aplicacion'=>date('Y-m-d')]);
                    if($affected>0)
                        $affe++;
                }else{
                    $done['status'] = 'ERROR';
                    $done['error'] = 'ERR_INS-PAGODET';
                }
            }

            if($affe>0){
                //Revisamos si todos los pagos estan realizados
                $pagados = 0;
                $nopagados = 0;
                $rows = DB::table('cre_amortizacion')
                            ->select("*")
                            ->where('idcre_credito','=',$request->idcredito)
                            ->get();
                foreach($rows as $val){
                    if($val->status == 2 || $val->status==4){
                        $pagados++;
                    }else{
                        $nopagados++;
                    }
                }
                $restantes = $pagados - $nopagados;
                if($pagados>0 && $nopagados==0){
                    //Ya terminó de pagar el crédito, actualizamos status de crédito y enviamos statis 100 para el response
                    $affected2 = DB::table('cre_credito')
                        ->where('id', $request->idcredito)
                        ->update(['status'=>2,'fecliquidacion'=>date('Y-m-d')]);
                    if($affected2>0){
                        $done['status'] = 'OK';
                        $done['error'] = 'OK_UPD-CRE';
                    }else{
                        $done['status'] = 'ERROR';
                        $done['error'] = 'ERR_UPD-CRE';
                    }
                }else{
                    if($pagados==0){
                        $done['status'] = 'ERROR';
                        $done['error'] = 'ERR_SEL-AMORT';
                    }else{
                        $done['status'] = 'OK';
                        $done['error'] = 'OK_UPD-AMORT';
                    }
                }
            }else{
                $done['status'] = 'ERROR';
                $done['error'] = 'ERR_UPD-AMORT';
            }
        }else{
            $done['status'] = 'ERROR';
            $done['error'] = 'ERR_INS-PAGO';
        }
        return json_encode($done);
    }


    public function dateFormat($fecha, $type){
        if($type == 'html2mysql'){
            $date = explode("/",$fecha);
            return $date[2]."-".$date[1]."-".$date[0];
        }
        if($type == 'mysql2html'){
            $date = explode("-",$fecha);
            return $date[2]."/".$date[1]."/".$date[0];
        }
    }
}
