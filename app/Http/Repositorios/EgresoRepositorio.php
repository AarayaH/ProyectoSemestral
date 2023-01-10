<?php

namespace App\Http\Repositories;

use App\Models\Egreso;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EgresoRepository
{
    public function registrarEgreso($request){
        $egreso = New Egreso();
        $egreso->fecha = $request->fecha;
        $egreso->cd = $request->centro_distrubucion_id;
        $egreso->farm = $request->farmacia_id;
        $egreso->save();
    
        foreach($request->medicamento as $medicamento){
            $detalle = New DetalleEgreso();
            $detalle->id_medicamento = $medicamento->id_medicamento;
            $detalle->cantidad = $medicamento->cantidad;
            $detalle->id_egreso = $egreso->id;
            $detalle->lote = $request->lote;
            $detalle->save();
    
            $stock_actual =Stock::where([
                ['id_medicamento', $medicamento->id_medicamento],
                ['centro_dist', $request->centro_distrubucion_id],
            ])->first();
    
            
            if($stock_actual = Stock::where('cantidad','>=',$detalle->cantidad)){
                $stock_actual = Stock::where([
                    ['id_medicamento', $medicamento->id_medicamento],
                    ['centro_dist', $request->centro_distrubucion_id],
                ])->decrement('cantidad',$medicamento->cantidad);
                $stock = Stock::where('cantidad','<=',0)->delete;
            }
                
            
        }
    }

}