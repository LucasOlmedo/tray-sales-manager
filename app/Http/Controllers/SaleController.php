<?php

namespace App\Http\Controllers;

use App\Application\Services\SaleService;
use App\Http\Requests\SaleListRequest;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SaleController extends Controller
{
    public function __construct(private SaleService $saleService)
    {
    }

    public function index(SaleListRequest $request): AnonymousResourceCollection
    {
        /**
         * @var array<mixed> $filters
         */
        $filters = $request->validated();
        $sales = $this->saleService->listSales($filters);
        return SaleResource::collection($sales);
    }

    public function store(StoreSaleRequest $request): SaleResource|JsonResponse
    {
        try {
            /**
             * @var array<mixed> $data
             */
            $data = $request->validated();
            $sale = $this->saleService->createSale($data);
            return new SaleResource($sale);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
