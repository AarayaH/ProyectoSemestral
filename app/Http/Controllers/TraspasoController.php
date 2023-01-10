<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraspasoController extends Controller
{
    protected TraspasoRepository $trasRepo;
    public function __construct(TraspasoRepository $trasRepo)
    {
        $this->trasRepo = $trasRepo;
    }
    public function registrarTraspaso(TraspasoRequest $request)
    {
        return $this->trasRepo->registrarTraspaso($request);
    }
}
