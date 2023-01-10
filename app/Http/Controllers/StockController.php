<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    protected StockRepository $StockRepo;
    public function __construct(StockRepository $StockRepo)
    {
        $this->StockRepo = $StockRepo;
    }

    public function listarStocks()
    {
        return $this->StockRepo->listarStocks();
    }

    public function guardarStocks(StockRequest $request)
    {
        return $this->StockRepo->guardarStocks($request);
    }
}
