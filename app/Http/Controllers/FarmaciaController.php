<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmaciaController extends Controller
{
    protected FarmaciaRepository $FarmRepo;

    public function __construct(FarmaciaRepository $FarmRepo)
    {
        $this->FarmRepo = $FarmRepo;
    }

    public function listarFarmacias()
    {
        return $this->FarmRepo->listarFarmacias();
    }

    public function guardarFarmacias(FarmaciaRequest $request)
    {
        return $this->FarmRepo->guardarFarmacias($request);
    }

    public function actualizarFarmacias(FarmaciaRequest $request){
        return $this->FarmRepo->actualizarFarmacias($request);
    }

}
