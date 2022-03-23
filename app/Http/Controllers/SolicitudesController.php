<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;

class SolicitudesController extends Controller
{
    public function index()
    {
        return view('solicitudes');
    }

    public function getPersona(Request $request){
        $array = array('persona'=>array(),
                       'pareja'=>array(),
                       'socioeconomico'=>array(),
                       'ingresospropios'=>array(),
                       'ingresostrabajo'=>array(),
                       'aval'=>array(),
                       'referencias'=>array());
        $arrResp = array();
        $idcliente = 0;
        $rows = DB::table('crm_persona')->select('*')->where('curp','=',$request->curp)->get();
        foreach($rows as $row){
            $arrayResp['id'] = $row->id;
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
                if($d->idcat_tipodireccion == 2){
                    $arrayResp['dirlab_calle'] = $d->calle;
                    $arrayResp['dirlab_colonia'] = $d->colonia;
                    $arrayResp['dirlab_cp'] = $d->cp;
                    $arrayResp['dirlab_estado'] = $d->idestado;
                    $arrayResp['dirlab_ciudad'] = $d->idciudad;
                    $arrayResp['dirlab_telefono'] = $d->telefono;
                }
            }
            $idcliente = $row->id;
        }


        return utf8_encode(json_encode($arrayResp));
    }

    public function searchPersonStatus(Request $request)
    {
        $array = array('ok'=>99,'mensaje'=>'');
        $hay = 0;
        //Busca si existe cliente con esa CURP
        $datClient = DB::table('crm_persona')->where('curp', $request->curp)->get();
        foreach($datClient as $data){
            #1 Activo
            #3 Con retraso de pago
            #4 Bloqueado
            #99 Inactivo
            if($data->status == 1){ //Cliente activo
                //Validamos si tiene solicitud de crédito activa
                $solActive = DB::table('cre_credito')
                                ->where('idcrm_persona', '=', $data->id)
                                ->where('status', '=', 0)
                                ->count();
                if($solActive>0){
                    $array['ok'] = 3;
                    $array['mensaje'] = 'Cliente con solicitud de crédito activa';
                }else{
                    $creActive = DB::table('cre_credito')
                                ->where('idcrm_persona', '=', $data->id)
                                ->where('status', '=', 1)
                                ->count();
                    if($creActive>0){
                        $array['ok'] = 3;
                        $array['mensaje'] = 'Cliente con crédito vigente';
                    }else{
                        $array['ok'] = 1;
                        $array['mensaje'] = '';
                    }
                }

            }
            if($data->status == 3){
                $array['ok'] = 2;
                $array['mensaje'] = 'Cliente con status de morosidad';
            }
            if($data->status == 4){
                $array['ok'] = 2;
                $array['mensaje'] = 'Cliente bloqueado manualmente';
            }
            if($data->status == 99){
                $array['ok'] = 2;
                $array['mensaje'] = 'Cliente inactivo';
            }
            $hay++;
        }

        if($hay==0){
            $array['ok'] = 1;
            $array['mensaje'] = 'NUEVO';
        }else{
            if($array['ok']==99){
                $array['ok'] = 0;
                $array['mensaje'] = 'Cliente con problemas en sistema. Contactar con Soporte';
            }
        }
        return json_encode($array);
    }

    public function getAll(Request $request){
        if($request->idfk == 0 )
            $rows = DB::table($request->table)->get();
        else
            $rows = DB::table($request->table)->where($request->fk, $request->idfk)->get();

        return utf8_encode(json_encode($rows));
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        $valores = $request->all();
        $post = array();
        $id = 0;
        $table = '';
        foreach($valores as $idx => $value){
            //echo $idx."::".$value."---";
            $pos1 = strpos($idx, '_');
            if($pos1 !== false){
                $txt = explode("_",$idx);
                if($txt[1]=='id'){
                    $id=$txt[1];
                }else{
                    $post[$txt[1]] = $value;
                    $table = $txt[0];
                }
            }
        }

        $tables = array('per' => 'crm_persona',
                        'par' => 'crm_persona',
                        'as' => 'crm_socioeconomico',
                        'finp' => 'crm_ingresosnegocio',
                        'fitr' => 'crm_ingresostrabajo',
                        'aval' => 'crm_persona',
                        'ref1' => 'crm_persona',
                        'ref2' => 'crm_persona',
                    );

        //Primero crea el registro de la crédito en blanco

        //Ingresa los registros por cada tabla
        $camposdir = "";
        $aliasdir = "";
        $valuesdir = array();
        $campos = "";
        $alias = "";
        $values = array();
        $camposdirlab = "";
        $aliasdirlab = "";
        $valuesdirlab = array();
        foreach($post as $idx => $value){
            $pos = strpos($idx, '-');
            if($pos === false){ //Los campos son de una tabla que no es dirección o que no son FK
                $campos.= $idx.",";
                $alias.= "?,";
                $posdate = strpos($value, '/');
                if($posdate !== false && strlen($value)==10)
                    $values[$idx] = $this->dateFormat($value,'html2mysql');
                else
                    $values[$idx] = $value;
            }else{
                $exp = explode('-',$idx);
                if($table != 'par' && $table != 'aval' && $table != 'ref1' && $table != 'ref2'){
                    if($exp[0] == 'idcre'){ //los campos son de una clave foranea
                        $campos.= str_replace('-','_',$idx).",";
                        $alias.= "?,";
                        $values[str_replace('-','_',$idx)] = $value;
                    }
                }
                if($exp[0] == 'idcat'){ //los campos son de una clave foranea
                    $campos.= str_replace('-','_',$idx).",";
                    $alias.= "?,";
                    $values[str_replace('-','_',$idx)] = $value;
                }
                if($exp[0] == 'dir'){ //Los campos son de una diracción
                    if($exp[1] == 'estado' || $exp[1] == 'ciudad'){
                        $camposdir.= "idcat_".$exp[1].",";
                        $aliasdir.= "?,";
                        $valuesdir["idcat_".$exp[1]] = $value;
                    }else{
                        $camposdir.= $exp[1].",";
                        $aliasdir.= "?,";
                        $valuesdir[$exp[1]] = $value;
                    }
                }
                if($exp[0] == 'dirlab'){ //Los campos son de una diracción
                    if($exp[1] == 'estado' || $exp[1] == 'ciudad'){
                        $camposdirlab.= "idcat_".$exp[1].",";
                        $aliasdirlab.= "?,";
                        $valuesdirlab["idcat_".$exp[1]] = $value;
                    }else{
                        $camposdirlab.= $exp[1].",";
                        $aliasdirlab.= "?,";
                        $valuesdirlab[$exp[1]] = $value;
                    }
                }
            }

        }
        $campos = substr($campos,0,-1);
        $alias = substr($alias,0,-1);
        $camposdir = substr($camposdir,0,-1);
        $aliasdir = substr($aliasdir,0,-1);
        $valuesdir['idcat_tipodireccion'] = 1;
        $camposdirlab = substr($camposdirlab,0,-1);
        $aliasdirlab = substr($aliasdirlab,0,-1);
        $valuesdirlab['idcat_tipodireccion'] = 2;


        $id = DB::table($tables[$table])->insertGetId($values);
        $idpersona = $id;
        if($table == 'per'){
            $folio = DB::table('cre_credito')->where('status', 11)->where('idusers', $user->id)->max('folio');
            $valuescred = ['folio'=>$folio+1,'idcrm_persona'=>$idpersona,'idusers'=>$user->id,'status'=>11];
            $id = DB::table('cre_credito')->insertGetId($valuescred);
        }

        if($table == 'par'){
            $id = DB::table('cre_pareja')->insert(['idcrm_persona'=>$idpersona,'idcre_credito'=>$post['idcre-credito']]);
        }
        if($table == 'aval'){
            $id = DB::table('cre_aval')->insert(['idcrm_persona'=>$idpersona,'idcre_credito'=>$post['idcre-credito']]);
        }
        if($table == 'ref1' || $table == 'ref2'){
            $id = DB::table('cre_referencia')->insert(['idcrm_persona'=>$idpersona,'idcre_credito'=>$post['idcre-credito']]);
        }

        $valuesdir['idcrm_persona'] = $idpersona;
        $valuesdirlab['idcrm_persona'] = $idpersona;
        if($id>0){
            if(count($valuesdir)>2){
                DB::table('crm_direccion')->insertGetId($valuesdir);
            }
            if(count($valuesdirlab)>2){
                DB::table('crm_direccion')->insertGetId($valuesdirlab);
            }
        }

        return $id;
    }

    public function updateCredit(Request $request){
        $id = $request->cre_id;
        $valores = $request->all();
        $post = array();
        $table = 'cre_credito';
        foreach($valores as $idx => $value){
            if($idx!='cre_id'){
                $posdate = strpos($value, '/');
                if($posdate !== false && strlen($value)==10)
                    $post[str_replace('cre_','',$idx)] = $this->dateFormat($value,'html2mysql');
                else
                    $post[str_replace('cre_','',$idx)] = $value;
            }
        }
        $post['interesesbruto'] = $post['monto']*($post['interesesbruto']/100);
        $post['status'] = 0;

        $affected = DB::table('cre_credito')
                    ->where('id', $id)
                    ->update($post);
        return $affected;
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
