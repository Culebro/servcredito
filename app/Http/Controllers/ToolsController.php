<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function upload(Request $request){

    }

    public function getClientes(Request $request){
        $rows = DB::table('cre_credito')
                ->join('crm_persona', 'cre_credito.idcrm_persona', '=', 'crm_persona.id')
                ->select(DB::raw("CONCAT(cre_credito.id,' | ',crm_persona.nombre,' ',crm_persona.paterno,' ',crm_persona.materno) as nombre"))
                ->where('cre_credito.status','=',1)
                ->get();
        return utf8_encode(json_encode($rows));
    }
    public function getParametros(Request $request){
        $rows = DB::table('sys_parametro')
                ->select("*")
                ->get();
        return utf8_encode(json_encode($rows));
    }
}
