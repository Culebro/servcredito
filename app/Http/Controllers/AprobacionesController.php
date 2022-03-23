<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use PDF;

class AprobacionesController extends Controller
{
    public function index()
    {
        return view('aprobaciones');
    }

    public function getAll(Request $request){
        $rows = DB::table('cre_credito')
                ->join('crm_persona', 'cre_credito.idcrm_persona', '=', 'crm_persona.id')
                ->select('cre_credito.*', 'crm_persona.nombre', 'crm_persona.paterno', 'crm_persona.materno')
                ->where('cre_credito.status','=',$request->status)
                ->get();
        return utf8_encode(json_encode($rows));
    }


    public function dropSolicitud(Request $request){
        $affected = DB::table('cre_credito')
                    ->where('id', '=', $request->id)
                    ->update(['status' => 99]);
        return ($affected);
    }

    public function getComisionApertura(Request $request){
        $n = 0;
        $creds = DB::table('cre_credito')
                ->join('crm_persona', 'cre_credito.idcrm_persona', '=', 'crm_persona.id')
                ->select(DB::raw('count(*) as cantidad'))
                ->where('crm_persona.id',"=",$request->idpersona)
                ->whereIn('cre_credito.status',[1,2])
                ->groupBy('cre_credito.id')
                ->get();
        foreach($creds as $rw){
            $n = $rw->cantidad;
        }
        $comision = 0;
        if($n>0){
            $ca = DB::table('sys_parametros')->select('*')->get();
            foreach($ca as $val){
                $comision = $val->comision_apertura;
            }
        }

        return $comision;
    }

    public function getSolicitud(Request $request){
        $rows = DB::table('cre_credito')
                ->join('crm_persona', 'cre_credito.idcrm_persona', '=', 'crm_persona.id')
                ->join('crm_direccion', 'crm_direccion.idcrm_persona', '=', 'crm_persona.id')
                ->join('crm_socioeconomico', 'crm_socioeconomico.idcre_credito', '=', 'cre_credito.id')
                ->join('crm_ingresosnegocio', 'crm_ingresosnegocio.idcre_credito', '=', 'cre_credito.id')
                ->join('crm_ingresostrabajo', 'crm_ingresostrabajo.idcre_credito', '=', 'cre_credito.id')
                ->join('cat_ciudad', 'crm_direccion.idcat_ciudad', '=', 'cat_ciudad.id')
                ->join('cat_estado', 'cat_ciudad.idcat_estado', '=', 'cat_estado.id')
                ->select('cre_credito.*',
                         'crm_persona.*',
                         'crm_persona.id as idpersona',
                         'crm_direccion.*',
                         'crm_socioeconomico.*',
                         'crm_ingresosnegocio.*',
                         'crm_ingresostrabajo.*',
                         'crm_direccion.colonia as colonia',
                         'cre_credito.id as id',
                         'cre_credito.idcre_producto as idproducto',
                         'cat_ciudad.nombre as ciudad',
                         'cat_estado.nombre as estado',
                         'crm_persona.nombre as nombre',
                         'cre_credito.plazo as plazo',
                         'cre_credito.interesesbruto as interesesbruto',
                         'crm_ingresosnegocio.periodicidad as periodicidad')
                ->where('cre_credito.id','=',$request->id)
                ->where('crm_direccion.idcat_tipodireccion','=',1)
                ->get();

        $n = 0;
        $creds = DB::table('cre_credito')
                ->join('crm_persona', 'cre_credito.idcrm_persona', '=', 'crm_persona.id')
                ->select(DB::raw('count(*) as cantidad'))
                ->where('crm_persona.id',"=",$rows[0]->idpersona)
                ->whereIn('cre_credito.status',[1,2])
                ->groupBy('cre_credito.id')
                ->get();
        foreach($creds as $rw){
            $n = $rw->cantidad;

        }

        $comision = 0;
        if($n==0){
            $ca = DB::table('cre_producto')->select('*')->where('id','=',$rows[0]->idproducto)->get();
            foreach($ca as $val){
                $comision = $val->comisionapertura;
            }
        }

        $rows[0]->{'comision_apertura'} = $comision;

        return utf8_encode(json_encode($rows));
    }

    public function apruebaCredito(Request $request){
        $id = $request->id;
        $valores = $request->all();

        $affected = DB::table('cre_credito')
                    ->where('id', $id)
                    ->update($valores);

        return $affected;
    }

    public function tablaAmortizacion(Request $request){
        $n = 0;
        $plazo = $request->plazo;
        $fecha = $request->fecinicio;
        $saldo = $request->monto + $request->interesesbruto;
        $porc = ($saldo / $request->monto);
        $interes = $request->montoabono - ($request->montoabono/$porc);
        $reserva = $interes * 0.2;
        $comision = $request->comision;
        
        for($i=1;$i<=$plazo;$i++){
            $nwmonto = 0;
            if($i==1){
                $nwmonto = $request->montoabono + $comision;
                $comtmp = $comision;
            }else{
                $nwmonto = $request->montoabono;
                $comtmp = 0;
            }
            DB::table('cre_amortizacion')->insert(['numpago'=>$i,'montopago'=>$nwmonto,'interes_bruto'=>$interes,'interes_reserva'=>$reserva,'comision'=>$comtmp,'fecha_pago'=>$fecha,'idcre_credito'=>$request->id]);
            $fecha = date("Y-m-d",strtotime($fecha."+ 1 days"));
            $n++;
        }

        PDF::SetTitle('Hola Mundo');
        PDF::AddPage();
        PDF::Write(0, 'Bienvenido a TCPDF-Laravel');
        PDF::Output($_SERVER['DOCUMENT_ROOT'] . '/servicredito/public/prints/hola_mundo.pdf', 'F');

        return $n;

    }

    public function uploadDocument(Request $request )
    {
        $newname = $request->idcredito."_".date('hisdmY');
        $path = '/documentos/creditos/';
        if($request->hasFile('foto')) {
            $file = $request->file('foto');

            $name = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();

            $image['filePath'] = $name;
            $upload = $file->move(public_path().$path, $newname.'.'.$extension);
            if(!$upload){
                return 0;
            }else{
                DB::table('cre_documento')->insert(['nombre'=>$newname,'extension'=>$extension,'path'=>$path,'fecha'=>date('Y-m-d'),'hora'=>date('h:i:s'),'idcat_tipodoc'=>$request->tipodoc,'idcre_credito'=>$request->idcredito]);
                return 1;
            }
         }else{
             return 2;
         }
    }

    public function getDocuments(Request $request )
    {
        $rows = DB::table('cre_documento')
                ->join('cat_tipodoc','cre_documento.idcat_tipodoc','=','cat_tipodoc.id')
                ->select('cre_documento.*',
                         'cre_documento.nombre as nombre',
                         'cat_tipodoc.nombre as tipo')
                ->where('cre_documento.idcre_credito','=',$request->id)
                ->where('cre_documento.status','=',1)
                ->get();
        return json_encode($rows);
    }

    public function dropDocument(Request $request )
    {
        $rows = DB::table('cre_documento')
                ->where('id',$request->id)
                ->update(['status'=>0]);
        $path = public_path().$request->path.$request->nombre;
        //unlink($path);
        File::delete($path);
        return $rows;
    }
}
