<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function clientes(){
        $rows = DB::table('crm_persona')
                ->join('cre_credito','crm_persona.id','=','cre_credito.id')
                ->join('cat_edocivil','crm_persona.idcat_edocivil','=','cat_edocivil.id')
                ->join('cat_nacionalidad','crm_persona.idcat_nacionalidad','=','cat_nacionalidad.id')
                ->join('cat_status','crm_persona.status','=','cat_status.status')
                ->select('crm_persona.*',
                         'cat_edocivil.nombre as edocivil',
                         'cat_nacionalidad.gentilicio as nacionalidad',
                         'cat_status.nombre as status')
                ->where('crm_persona.status','=',1)
                ->where('crm_persona.idcat_tipopersona','=',1)
                ->where('cre_credito.status','<>',11)
                ->where('cat_status.tabla','=','crm_persona')
                ->get();
        //return $rows;
        foreach($rows as $row){
            $arrayResp['id'] = $row->id;
            $arrayResp['curp'] = $row->curp;
            $arrayResp['nombre'] = $row->nombre;
            $arrayResp['paterno'] = $row->paterno;
            $arrayResp['materno'] = $row->materno;
            $arrayResp['fechanac'] = $this->dateFormat($row->fechanac,'mysql2html');
            $arrayResp['edad'] = $this->calculaedad($row->fechanac);
            $arrayResp['sexo'] = $row->sexo;
            $arrayResp['edocivil'] = $row->edocivil;
            $arrayResp['nacionalidad'] = $row->nacionalidad;
            $arrayResp['telefono'] = $row->telefono;
            $arrayResp['celular'] = $row->celular;
            $arrayResp['email'] = $row->email;
            $arrayResp['ocupacion'] = $row->ocupacion;
            $arrayResp['limitecredito'] = $row->limitecredito;
            $arrayResp['plazomax'] = $row->plazomax;
            $arrayResp['status'] = $row->status;
            //Dirección
            $d1 = DB::table('crm_direccion')
                    ->join('cat_ciudad','crm_direccion.idcat_ciudad','=','cat_ciudad.id')
                    ->join('cat_estado','cat_ciudad.idcat_estado','=','cat_estado.id')
                    ->select('crm_direccion.*',
                             'cat_ciudad.nombre as ciudad',
                             'cat_estado.nombre as estado',
                             'cat_ciudad.id as idciudad',
                             'cat_estado.id as idestado')
                    ->where('crm_direccion.idcrm_persona','=',$row->id)
                    ->get();
            foreach($d1 as $d){
                if($d->idcat_tipodireccion == 1){
                    $arrayResp['dir_calle'] = $d->calle;
                    $arrayResp['dir_colonia'] = $d->colonia;
                    $arrayResp['dir_cp'] = $d->cp;
                    $arrayResp['dir_estado'] = $d->estado;
                    $arrayResp['dir_ciudad'] = $d->ciudad;
                }
                if($d->idcat_tipodireccion == 2){
                    $arrayResp['dirlab_calle'] = $d->calle;
                    $arrayResp['dirlab_colonia'] = $d->colonia;
                    $arrayResp['dirlab_cp'] = $d->cp;
                    $arrayResp['dirlab_estado'] = $d->estado;
                    $arrayResp['dirlab_ciudad'] = $d->ciudad;
                    $arrayResp['dirlab_telefono'] = $d->telefono;
                }
            }
        }
        return view('repclientes')->with(['arrayResp' => array($arrayResp)]);
    }

    public function calculaedad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
          $ano_diferencia--;
        return $ano_diferencia;
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

    public function creditos(){
        return view('repcreditos');
    }

    public function cobranza(){
        return view('repcobranza');
    }

    public function cxc(){
        return view('repcxc');
    }

    public function finanzas(){
        return view('repfinanzas');
    }
}
