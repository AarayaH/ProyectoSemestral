<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    protected MedicamentoRepository $medRepo;
    public function __construct(MedicamentoRepository $medRepo)
    {
        $this->medRepo = $medRepo;
    }

    public function listarMedicamentos()
    {
        return $this->medRepo->listarMedicamentos();
    }

    public function guardarMedicamentos(MedicamentoRequest $request)
    {
        return $this->medRepo->guardarMedicamentos($request);
    }

    public function actualizarMedicamentos(MedicamentoRequest $request){
        return $this->medRepo->actualizarMedicamentos($request);
    }
}
