<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class ParametrosController extends Controller
{
    public function index()
    {
        return view('parametros');
    }

    public function getParametros(){
        $rows = DB::table('sys_parametro')
                ->select('*')
                ->get();
        return utf8_encode(json_encode($rows));
    }

    public function saveParametros(Request $request){
        $valores = $request->all();
        $affected = DB::table('sys_parametro')->update($valores);
        return $affected;
    }


    public function slider(){
        $array = array();
        $array['minimo'] = DB::table('cre_producto')->max('montominimo');
        $array['maximo'] = DB::table('cre_producto')->max('montomaximo');
        $array['multiplo'] = DB::table('sys_parametro')->max('multiplo_credito');
        $array['default'] = DB::table('sys_parametro')->max('monto_default');
        $rows = DB::table('cre_producto')
                ->select('*')
                ->where("status","=",1)
                ->get();
        $array['productos'] = array();
        foreach($rows as $rw){
            $array['productos'][] = $rw;
        }
        return json_encode($array);
    }

}
