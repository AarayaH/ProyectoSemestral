<?php
namespace App\Http\Repositories;

use App\Models\Medicamento;
use App\Models\CentroDistrubucion;

class TraspasoRepositorio
{
    public function registrarTraspaso($request){
        $traspaso = New Traspaso();
        $traspaso->estado = $request->estado;
        $traspaso->cd_orig = $request->centro_distrubucion_id;
        $traspaso->cd_dest = $request->centro_distrubucion_id;
        $traspaso->save();
    
        foreach($request->medicamento as $medicamento){
            $detalle = New DetalleIngreso();
            $detalle->id_medicamento = $medicamento->id_medicamento;
            $detalle->cantidad = $medicamento->cantidad;
            $detalle->id_traspaso = $traspaso->id;
              

            $valor1 = Stock::where([
                ['id_medicamento', $medicamento->id_medicamento],
                ['centro_dist', $traspaso->cd_orig],
                ])->cantidad;

            if($detalle->cantidad >= $valor1){
                $stock_origen1 = Stock::where([
                    ['id_medicamento', $medicamento->id_medicamento],
                    ['centro_dist', $traspaso->cd_orig],
                ])->decrement('cantidad',$stock_origen1->cantidad);
                
                $stock_dest = Stock::where([
                    ['id_medicamento', $medicamento->id_medicamento],
                    ['centro_dist', $traspaso->cd_dest],
                ])->increment('cantidad',$valor1);
            }
            $detalle->lote = $stock_origen1->lote;
            $detalle->save();

            if($stock_origen1->cantidad == 0){
                Stock::find($stock_origen1->id)->delete();
            }
            //segundo
            $detalle2 = New DetalleIngreso();
            $detalle2->id_medicamento = $medicamento->id_medicamento;
            $detalle2->cantidad = $medicamento->cantidad;
            $detalle2->id_traspaso = $traspaso->id;
              

            $valor2 = $medicamento->cantidad - $valor1;

            if($detalle2->cantidad >= $valor2){
                $stock_origen2 = Stock::where([
                    ['id_medicamento', $medicamento->id_medicamento],
                    ['centro_dist', $traspaso->cd_orig],
                ])->decrement('cantidad',$stock_origen2->cantidad);
                
                $stock_dest = Stock::where([
                    ['id_medicamento', $medicamento->id_medicamento],
                    ['centro_dist', $traspaso->cd_dest],
                ])->increment('cantidad',$valor2);
            }
            $detalle->lote = $stock_origen1->lote;
            $detalle->save();

            if($stock_origen2->cantidad == 0){
                Stock::find($stock_origen2->id)->delete();
            }


            

        }
    }
}

