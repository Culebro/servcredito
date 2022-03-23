<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        return view('productos');
    }

    public function showProductos(Request $request){
        $rows = DB::table('cre_producto')
                ->select('*')
                ->where('status','=',1)
                ->get();
        return utf8_encode(json_encode($rows));
    }

    public function getProducto(Request $request){
        $rows = DB::table('cre_producto')
                ->select('*')
                ->where('id','=',$request->id)
                ->get();
        return utf8_encode(json_encode($rows));
    }

    public function saveProducto(Request $request){
        $valores = $request->all();
        $updpro = array();
        $id = 0;
        foreach($valores as $idx => $value){
            //echo $idx."::".$value."---";
            $pos1 = strpos($idx, '_');
            if($pos1 !== false){
                $txt = explode("_",$idx);
                $pos2 = strpos($txt[1], '-');
                if($pos2 !== false){
                    $updpro[str_replace('-','_',$txt[1])] = $value;
                }else{
                    $updpro[$txt[1]] = $value;
                }
            }
        }

        DB::beginTransaction();
        try {
            $id = $updpro['id'];
            unset($updpro['id']);
            DB::table('cre_producto')->where('id','=',$id)->update($updpro);
            DB::commit();
            return 1;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function delProducto(Request $request){
        DB::table('cre_producto')->where('id','=',$request->id)->update(['status'=>99]);
    }
}
