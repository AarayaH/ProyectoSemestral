<?php

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
            $detalle->save();
    
            $stock_actual =Stock::where([
                ['id_medicamento', $medicamento->id_medicamento],
                ['centro_dist', $request->centro_distrubucion_id],
            ])->first();
    
            if(is_null($stock_actual)){
                //creo
            }else{
                $stock_actual = Stock::where([
                    ['id_medicamento', $medicamento->id_medicamento],
                    ['centro_dist', $request->centro_distrubucion_id],
                ])->increment('cantidad',$medicamento->cantidad);
            }
        }
    }
}

