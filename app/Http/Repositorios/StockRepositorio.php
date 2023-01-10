<?php

namespace App\Http\Repositories;

use App\Models\Stock;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class StockRepository
{
    public function guardarStock($request)
    {
        $stocks = Stock::create([
            "scd_cantidad" => $request->cantidad,
            "scd_lote" => $request->lote,
            "scd_id_medicamento" => $request->medicamento_id,
            "scd_centro_dist_id" => $request->centro_distrubucion_id,
        ]);

        return response()->json(["stocks" => $stocks], Response::HTTP_OK);
    }

    
    public function eliminarStock($request)
    {
        try{
            $stocks = Stock::find($request->id)->delete();

            return response()->json(["stocks" => $stocks], Response::HTTP_OK);
        }catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarStock()
    {
        $stocks = Stock::all();
        return response()->json(["stocks" => $stocks], Response::HTTP_OK);
    }
}