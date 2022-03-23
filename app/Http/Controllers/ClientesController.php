<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        return view('clientes');
    }

    public function showClientes(Request $request){
        $rows = DB::table('crm_persona')
                ->join('cre_credito', 'cre_credito.idcrm_persona', '=', 'crm_persona.id')
                ->join('crm_direccion', 'crm_direccion.idcrm_persona', '=', 'crm_persona.id')
                ->join('cat_ciudad', 'crm_direccion.idcat_ciudad', '=', 'cat_ciudad.id')
                ->join('cat_estado', 'cat_ciudad.idcat_estado', '=', 'cat_estado.id')
                ->join('cat_status', 'crm_persona.status', '=', 'cat_status.status')
                ->select('crm_persona.*',
                         'crm_direccion.*',
                         'crm_persona.id as id',
                         'cat_ciudad.nombre as ciudad',
                         'cat_estado.nombre as estado',
                         'cat_status.nombre as status',
                         'crm_persona.telefono as telefono')
                ->where('crm_direccion.idcat_tipodireccion','=',1)
                ->where('cat_status.tabla','=','crm_persona')
                ->where('crm_persona.idcat_tipopersona','=',1)
                ->where('cre_credito.status','<>',11)
                ->get();
        return utf8_encode(json_encode($rows));
    }

    public function getCliente(Request $request){
        $arrayResp = array();
        $rows = DB::table('crm_persona')->select('*')->where('id','=',$request->id)->get();
        foreach($rows as $row){
            $arrayResp['id'] = $row->id;
            $arrayResp['curp'] = $row->curp;
            $arrayResp['nombre'] = $row->nombre;
            $arrayResp['paterno'] = $row->paterno;
            $arrayResp['materno'] = $row->materno;
            $arrayResp['fechanac'] = $this->dateFormat($row->fechanac,'mysql2html');
            $arrayResp['sexo'] = $row->sexo;
            $arrayResp['idcat_edocivil'] = $row->idcat_edocivil;
            $arrayResp['idcat_nacionalidad'] = $row->idcat_nacionalidad;
            $arrayResp['telefono'] = $row->telefono;
            $arrayResp['celular'] = $row->celular;
            $arrayResp['email'] = $row->email;
            $arrayResp['ocupacion'] = $row->ocupacion;
            $arrayResp['limitecredito'] = $row->limitecredito;
            $arrayResp['plazomax'] = $row->plazomax;
            $arrayResp['estado'] = $row->status;
            //Dirección
            $d1 = DB::table('crm_direccion')
                    ->join('cat_ciudad','crm_direccion.idcat_ciudad','=','cat_ciudad.id')
                    ->join('cat_estado','cat_ciudad.idcat_estado','=','cat_estado.id')
                    ->select('crm_direccion.*',
                             'cat_ciudad.nombre as ciudad',
                             'cat_estado.nombre as estado',
                             'cat_ciudad.id as idciudad',
                             'cat_estado.id as idestado',
                             'crm_direccion.telefono as telefonodir')
                    ->where('crm_direccion.idcrm_persona','=',$row->id)
                    ->get();
            foreach($d1 as $d){
                if($d->idcat_tipodireccion == 1){
                    $arrayResp['dir_calle'] = $d->calle;
                    $arrayResp['dir_colonia'] = $d->colonia;
                    $arrayResp['dir_cp'] = $d->cp;
                    $arrayResp['dir_estado'] = $d->idestado;
                    $arrayResp['dir_ciudad'] = $d->idciudad;
                }
                if($d->idcat_tipodireccion == 2){
                    $arrayResp['dirlab_calle'] = $d->calle;
                    $arrayResp['dirlab_colonia'] = $d->colonia;
                    $arrayResp['dirlab_cp'] = $d->cp;
                    $arrayResp['dirlab_estado'] = $d->idestado;
                    $arrayResp['dirlab_ciudad'] = $d->idciudad;
                    $arrayResp['dirlab_telefono'] = $d->telefonodir;
                }
            }
        }


        return utf8_encode(json_encode($arrayResp));
    }

    public function saveCliente(Request $request){
        $valores = $request->all();
        $updper = array();
        $upddir = array();
        $upddirlab = array();
        $id = 0;
        foreach($valores as $idx => $value){
            //echo $idx."::".$value."---";
            $pos1 = strpos($idx, '_');
            if($pos1 !== false){
                $txt = explode("_",$idx);
                //Checamos que sean datos de persona
                if($txt[0] == 'per'){
                    $pos2 = strpos($txt[1], '-');
                    if($pos2 !== false){
                        $exp = explode('-',$txt[1]);
                        if($exp[0] == 'dir'){ //Los campos son de una diracción
                            if($exp[1] == 'estado' || $exp[1] == 'ciudad'){
                                $upddir["idcat_".$exp[1]] = $value;
                            }else{
                                $upddir[$exp[1]] = $value;
                            }
                        }
                        if($exp[0] == 'dirlab'){ //Los campos son de una diracción
                            if($exp[1] == 'estado' || $exp[1] == 'ciudad'){
                                $upddirlab["idcat_".$exp[1]] = $value;
                            }else{
                                $upddirlab[$exp[1]] = $value;
                            }
                        }
                    }else{
                        $posdate = strpos($value, '/');
                        if($posdate !== false && strlen($value)==10)
                            $updper[$txt[1]] = $this->dateFormat($value,'html2mysql');
                        else
                            $updper[$txt[1]] = $value;
                    }
                }
            }
        }
        $id = $updper['id'];
        //return json_encode($upddirlab);
        DB::beginTransaction();
            try {
                unset($updper['id']);
                DB::table('crm_persona')->where('id','=',$id)->update($updper);
                DB::table('crm_direccion')->where('idcrm_persona','=',$id)->where('idcat_tipodireccion','=',1)->update($upddir);
                DB::table('crm_direccion')->where('idcrm_persona','=',$id)->where('idcat_tipodireccion','=',2)->update($upddirlab);
                DB::commit();
                return 1;
            } catch (\Exception $e) {
                DB::rollback();
                return $e->getMessage();
            }
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
