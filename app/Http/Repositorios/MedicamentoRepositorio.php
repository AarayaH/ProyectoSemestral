<?php

namespace App\Http\Repositories;

use App\Models\Medicamento;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class MedicamentoRepository
{
    public function guardarMedicamento($request)
    {
        $medicamentos = Medicamento::create([
            "med_nombre" => $request->nombre,
            "med_compuesto" => $request->compuesto,
        ]);

        return response()->json(["medicamentos" => $medicamentos], Response::HTTP_OK);
    }

    public function actualizarMedicamento($request)
    {
        try {
            $medicamentos = Medicamento::findorFail($request->id);
            isset($request->nombre) && $medicamentos->med_nombre = $request->nombre;
            $medicamentos->save();

            $medicamentos = Medicamento::where('id', $request->id)
                ->update([
                    'med_nombre' => $request->nombre,
                    'med_compuesto' => $request->compuesto
                ]);


            return response()->json(["medicamentos" => $medicamentos], Response::HTTP_OK);
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

    public function eliminarMedicamento($request)
    {
        try{
            $medicamento = Stock::find($request->id)->delete();

            return response()->json(["medicamentos" => $medicamentos], Response::HTTP_OK);
        }catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function listarMediacamento()
    {
        $medicamentos = Medicamentos::all();
        return response()->json(["medicamentos" => $medicamentos], Response::HTTP_OK);
    }
}