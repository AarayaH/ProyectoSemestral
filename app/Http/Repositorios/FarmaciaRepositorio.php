<?php

namespace App\Http\Repositories;

use App\Models\Farmacia;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FarmaciaRepository
{
    public function guardarFarmacia($request)
    {
        $farmacias = Farmacia::create([
            "farm_nombre" => $request->nombre,
            "farm_direccion" => $request->direccion,
            "farm_mail" => $request->mail,
        ]);

        return response()->json(["farmacias" => $farmacias], Response::HTTP_OK);
    }

    public function actualizarFarmacia($request)
    {
        try{
            $farmacias = Farmacia::finforFail($request->id);
            isset($request->nombre) && $farmacia->farm_nombre = $request->nombre;
            $farmacias->save();

            $farmacias = Farmacia::where('id',$request->id)
            ->update([
                'farm_direccion' => $request->direccion,
                'farm_mail' => $request->mail,
            ]);

            return response()->json(["farmacias" => $farmacias], Response::HTTP_OK);
        }catch (Exception $e) {
            Log::info([
                "error" => $e,
                "mensaje" =>  $e->getMessage(),
                "linea" =>  $e->getLine(),
                "archivo" =>  $e->getFile(),
            ]);
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function eliminarFarmacia($request)
    {
        try{
            $farmacias = Farmacia::find($request->id)->delete();

            return response()->json(["farmacias" => $farmacias], Response::HTTP_OK);
        }catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarFarmacia()
    {
        $farmacias = Farmacia::all();
        return response()->json(["farmacias" => $farmacias], Response::HTTP_OK);
    }
}