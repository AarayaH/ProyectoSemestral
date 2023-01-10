<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EgresoController extends Controller
{
    protected EgresoRepository $egrerepo;
    
    public function __construct(EgresoRepository $egrerepo)
    {
        $this->egrerepo = $egrerepo;
    }

    public function registrarEgreso(EgresoRequest $request)
    {
        return $this->egrerepo->registrarEgreso($request);
    }
}
