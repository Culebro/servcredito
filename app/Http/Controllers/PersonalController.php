<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        return view('personal');
    }

    public function showPersonal(Request $request){
        $rows = DB::table('users')
                ->join('crm_persona', 'users.idcrm_persona', '=', 'crm_persona.id')
                ->join('sys_group', 'users.idsys_group', '=', 'sys_group.id')
                ->join('cat_status', 'users.status', '=', 'cat_status.status')
                ->select('crm_persona.nombre as nombre',
                         'crm_persona.paterno as paterno',
                         'crm_persona.materno as materno',
                         'crm_persona.telefono as telefono',
                         'sys_group.nombre as tipo',
                         'cat_status.nombre as status',
                         'crm_persona.id as id')
                ->where('cat_status.tabla','=','users')
                ->where('crm_persona.idcat_tipopersona','=',9)
                ->get();
        return utf8_encode(json_encode($rows));
    }

    public function getPersonal(Request $request){
        $arrayResp = array();
        $rows = DB::table('crm_persona')->select('*')->where('id','=',$request->id)->get();

        foreach($rows as $row){
            $arrayResp['id'] = $row->id;
            $arrayResp['nombre'] = $row->nombre;
            $arrayResp['paterno'] = $row->paterno;
            $arrayResp['materno'] = $row->materno;
            $arrayResp['telefono'] = $row->telefono;
            $arrayResp['celular'] = $row->celular;
            $arrayResp['email'] = $row->email;
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
                    $arrayResp['dir_estado'] = $d->idestado;
                    $arrayResp['dir_ciudad'] = $d->idciudad;
                }
            }
            //Dirección
            $d2 = DB::table('users')->select('*')->where('idcrm_persona','=',$row->id)->get();
            foreach($d2 as $s){
                $arrayResp['usr_id'] = $s->id;
                $arrayResp['usr_username'] = $s->email;
                $arrayResp['usr_tipo'] = $s->idsys_group;
                $arrayResp['usr_status'] = $s->status;
            }
        }


        return utf8_encode(json_encode($arrayResp));
    }

    public function savePersonal(Request $request){
        $valores = $request->all();
        $updper = array();
        $upddir = array();
        $upduser = array();
        $id = 0;
        $passwd1 = '';
        $passwd2 = '1';
        $username = '1';
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
                    }else{
                        $updper[$txt[1]] = $value;
                    }
                }else{
                    //Datos de usuario
                    if($txt[1]=='id'){
                        $id=$value;
                    }else{
                        if($txt[1]!='password2'){
                            if($txt[1] == 'password'){
                                $upduser[$txt[1]] = Hash::make($value);
                                $passwd1 = $value;
                            }else{
                                $upduser[$txt[1]] = $value;
                            }
                        }else{
                            $passwd2 = $value;
                        }
                    }
                }



            }
        }

        if($passwd1 == $passwd2){
            DB::beginTransaction();
            try {
                if($id>0){

                    DB::table('crm_persona')->where('id','=',$id)->update($updper);
                    DB::table('crm_direccion')->where('idcrm_persona','=',$id)->where('idcat_tipodireccion','=',1)->update($upddir);
                    if(strlen($passwd1)>7){
                        DB::table('users')->where('idcrm_persona','=',$id)->update(['password'=>$upduser['password'],'idsys_group'=>$upduser['tipo']]);
                        DB::commit();
                        return 1;
                    }else{
                        if($passwd1==''){
                            DB::table('users')->where('idcrm_persona','=',$id)->update(['idsys_group'=>$upduser['tipo']]);
                            DB::commit();
                            return 1;
                        }else{
                            return 97;
                        }
                    }
                }else{
                    $d2 = DB::table('users')->where('email','=',$upduser['username'])->count();
                    if($d2>0){
                        return 99;
                    }else{
                        if(strlen($passwd1)>7){
                            unset($updper['id']);
                            //return json_encode($updper);
                            $updper['idcat_tipopersona'] = 9;
                            $idper = DB::table('crm_persona')->insertGetId($updper);
                            $upddir['idcrm_persona'] = $idper;
                            $upddir['idcat_tipodireccion'] = 1;
                            DB::table('crm_direccion')->insertGetId($upddir);
                            $upduser['idsys_group'] = $upduser['tipo'];
                            $upduser['email'] = $upduser['username'];
                            unset($upduser['username']);
                            unset($upduser['tipo']);
                            unset($upduser['id']);
                            $upduser['idcrm_persona'] = $idper;
                            $upduser['name'] = $updper['nombre'].' '.$updper['paterno'].' '.$updper['materno'];
                            DB::table('users')->insert($upduser);
                            DB::commit();
                            return 1;
                        }else{
                            return 97;
                        }
                    }
                }
            } catch (\Exception $e) {
                DB::rollback();
                return $e->getMessage();
            }
        }else{
            return 98;
        }
    }

    public function delPersonal(Request $request){
        try{
            DB::table('crm_persona')->where('id','=',$request->id)->update(['status'=>$request->status]);
            DB::table('users')->where('idcrm_persona','=',$request->id)->update(['status'=>$request->status]);
            return 1;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

    }
}
