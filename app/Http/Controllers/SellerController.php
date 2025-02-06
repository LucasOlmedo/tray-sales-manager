<?php

namespace App\Http\Controllers;

use App\Application\Services\SellerService;
use App\Http\Requests\SellerListRequest;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Resources\SellerResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SellerController extends Controller
{
    public function __construct(private SellerService $sellerService)
    {
    }

    public function index(SellerListRequest $request): AnonymousResourceCollection
    {
        $filters = $request->validated();
        $sellers = $this->sellerService->listSellers($filters);
        return SellerResource::collection($sellers);
    }

    public function store(StoreSellerRequest $request): SellerResource|JsonResponse
    {
        try {
            $data = $request->validated();
            $seller = $this->sellerService->createSeller($data);
            return new SellerResource($seller);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
