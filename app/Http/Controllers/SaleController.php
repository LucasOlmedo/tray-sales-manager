<?php

namespace App\Http\Controllers;

use App\Application\Services\SaleService;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleResource;
use Exception;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct(private SaleService $saleService)
    {
    }

    public function index(): void
    {
        //
    }

    public function store(StoreSaleRequest $request): SaleResource|JsonResponse
    {
        try {
            $data = $request->validated();
            $sale = $this->saleService->createSale($data);
            return new SaleResource($sale);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
