<?php

namespace App\Repositories;

use App\Models\CentroDistrubucion;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CentroDistrubucionRepository
{
    public function guardarCentroDistrubucion($request)
    {
        $centrodistrubucion = CentroDistrubucion::create([
            "cd_codigo" => $request->codigo,
            "cd_direccion" => $request->direccion,
            "cd_telefono" => $request->telefono,
        ]);

        return response()->json(["centrodistrubucion" => $centrodistrubucion], Response::HTTP_OK);
    }

    public function actualizarCentroDistrubucion($request)
    {
        try {
            $centrodistrubucion = CentroDistrubucion::findorFail($request->id);
            isset($request->codigo) && $centrodistrubucion->cd_codigo = $request->codigo;
            $centrodistrubucion->save();

            $centrodistrubucion = CentroDistrubucion::where('id', $request->id)
                ->update([
                    'cd_direccion' => $request->direccion,
                    'cd_telefono' => $request->telefono
                ]);


            return response()->json(["centrodistrubucion" => $centrodistrubucion], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::info([
                "error" => $e,
                "mensaje" => $e->getMessage(),
                "linea" => $e->getLine(),
                "archivo" => $e->getFile(),
            ]);
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function eliminarCentroDistrubucion($request)
    {
        try{
            $centrodistrubucion = Stock::find($request->id)->delete();

            return response()->json(["centrodistrubucion" => $centrodistrubucion], Response::HTTP_OK);
        }catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarMediacamento()
    {
        $centrodistrubucion = CentroDistrubucion::all();
        return response()->json(["centrodistrubucion" => $centrodistrubucion], Response::HTTP_OK);
    }
}