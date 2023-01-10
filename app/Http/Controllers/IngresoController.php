<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngresoController extends Controller
{
    protected IngresoRepository $ingrepo;
    
    public function __construct(IngresoRepository $ingrepo)
    {
        $this->ingrepo = $ingrepo;
    }

    public function registrarIngreso(IngresoRequest $request)
    {
        return $this->ingrepo->registrarIngreso($request);
    }
}
