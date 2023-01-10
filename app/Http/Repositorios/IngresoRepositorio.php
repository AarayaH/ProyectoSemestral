<?php
namespace App\Http\Repositories;

use App\Models\Medicamento;
use App\Models\CentroDistrubucion;

class IngresoRepositorio
{
    public function registrarIngreso($request){
        $ingreso = New Ingreso();
        $ingreso->fecha = $request->fecha;
        $ingreso->cd = $request->centro_distrubucion_id;
        $ingreso->save();
    
        foreach($request->medicamento as $medicamento){
            $detalle = New DetalleIngreso();
            $detalle->id_medicamento = $medicamento->id_medicamento;
            $detalle->cantidad = $medicamento->cantidad;
            $detalle->id_ingreso = $ingreso->id;
            $detalle->lote = $request->lote;
            $detalle->save();
    
            $stock_actual =Stock::where([
                ['id_medicamento', $medicamento->id_medicamento],
                ['centro_dist', $request->centro_distrubucion_id],
            ])->first();
    
            if(is_null($stock_actual)){
                //todo crear stock
                $stock = new Stock();
                $stock->scd_id_medicamento = $medicamento->id_medicamento;
                $stock->scd_centro_distrubucion = $ingreso->centro_dist_id;
                $stock->scd_lote = $detalle->lote;//??
                $stock->save();
            }else{
                $stock_actual = Stock::where([
                    ['id_medicamento', $medicamento->id_medicamento],
                    ['centro_dist', $request->centro_distrubucion_id],
                ])->increment('cantidad',$medicamento->cantidad);
            }
        }
    }
}

